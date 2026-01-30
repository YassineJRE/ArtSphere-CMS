<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PrivilegeAdmin;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Admin\DatatableRequest;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Services\Admin\UserService;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('permission:'.implode('|', [
            PrivilegeAdmin::WEB_USER_CREATE,
            PrivilegeAdmin::WEB_USER_READ,
            PrivilegeAdmin::WEB_USER_UPDATE,
            PrivilegeAdmin::WEB_USER_DELETE,
        ]), ['only' => ['index', 'datatable',  'show']]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_USER_CREATE, [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_USER_UPDATE, [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_USER_DELETE, [
            'only' => ['destroy'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Get Datatable records.
     *
     * @param App\Http\Requests\Admin\DatatableRequest $request
     *
     * @return string JSON of Datatable
     */
    public function datatable(DatatableRequest $request): string
    {
        if ($request->ajax()) {
            return json_encode($this->service->datatable($request));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('admin.user.create', [
            'roles' => Role::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Admin\User\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->service->store($request->all());

            return redirect()->route('admin.users.index')
                ->withSuccess(__('admin-user.message.success.user-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Models\User $user
     *
     * @return Renderable
     */
    public function show(User $user)
    {
        return view('admin.user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\User $user
     *
     * @return Renderable
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => $user,
            'userRoleIds' => $user->roles->pluck('id')->toArray(),
            'roles' => Role::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Admin\User\UpdateRequest $request
     * @param App\Models\User                                    $user
     *
     * @return void
     */
    public function update(UpdateRequest $request, User $user)
    {
        try {
            $this->service->update($user, $request->all());

            return redirect()->route('admin.users.index')
                ->withSuccess(__('admin-user.message.success.user-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\User $user
     *
     * @return void
     */
    public function destroy(User $user)
    {
        try {
            $this->service->destroy($user);

            return redirect()->route('admin.users.index')
                ->withSuccess(__('admin-user.message.success.user-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
