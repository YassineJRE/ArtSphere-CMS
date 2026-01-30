<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PrivilegeAdmin;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Admin\DatatableRequest;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\Services\Admin\RoleService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    public function __construct(RoleService $service)
    {
        $this->service = $service;
        $this->middleware('permission:'.implode('|', [
            PrivilegeAdmin::WEB_ROLE_CREATE,
            PrivilegeAdmin::WEB_ROLE_READ,
            PrivilegeAdmin::WEB_ROLE_UPDATE,
            PrivilegeAdmin::WEB_ROLE_DELETE,
        ]), ['only' => ['index', 'datatable',  'show']]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_ROLE_CREATE, [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_ROLE_UPDATE, [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_ROLE_DELETE, [
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
        return view('admin.role.index');
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
        return view('admin.role.create', [
            'permissions' => Permission::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Admin\Role\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->service->store($request->all());

            return redirect()->route('admin.roles.index')
                ->withSuccess(__('admin-role.message.success.role-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param Spatie\Permission\Models\Role $role
     *
     * @return Renderable
     */
    public function show(Role $role)
    {
        return view('admin.role.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Spatie\Permission\Models\Role $role
     *
     * @return Renderable
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', [
            'role' => $role,
            'rolePermissionIds' => $role->permissions->pluck('id')->toArray(),
            'permissions' => Permission::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Admin\Role\UpdateRequest $request
     * @param Spatie\Permission\Models\Role                      $role
     *
     * @return void
     */
    public function update(UpdateRequest $request, Role $role)
    {
        try {
            $this->service->update($role, $request->all());

            return redirect()->route('admin.roles.index')
                ->withSuccess(__('admin-role.message.success.role-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Spatie\Permission\Models\Role $role
     *
     * @return void
     */
    public function destroy(Role $role)
    {
        try {
            $this->service->destroy($role);

            return redirect()->route('admin.roles.index')
                ->withSuccess(__('admin-role.message.success.role-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
