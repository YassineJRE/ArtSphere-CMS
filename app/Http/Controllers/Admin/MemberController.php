<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PrivilegeAdmin;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Admin\DatatableRequest;
use App\Http\Requests\Admin\Member\StoreRequest;
use App\Http\Requests\Admin\Member\UpdateRequest;
use App\Services\Admin\MemberService;

class MemberController extends BaseController
{
    public function __construct(MemberService $service)
    {
        $this->service = $service;
        $this->middleware('permission:'.implode('|', [
            PrivilegeAdmin::WEB_MEMBER_CREATE,
            PrivilegeAdmin::WEB_MEMBER_READ,
            PrivilegeAdmin::WEB_MEMBER_UPDATE,
            PrivilegeAdmin::WEB_MEMBER_DELETE,
        ]), ['only' => ['index', 'datatable',  'show']]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_MEMBER_CREATE, [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_MEMBER_UPDATE, [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_MEMBER_DELETE, [
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
        return view('admin.member.index');
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
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Admin\Member\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->service->store($request->all());

            return redirect()->route('admin.members.index')
                ->withSuccess(__('member.message.success.member-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Models\User $member
     *
     * @return Renderable
     */
    public function show(User $member)
    {
        return view('admin.member.show', ['member' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\User $member
     *
     * @return void
     */
    public function edit(User $member)
    {
        return view('admin.member.edit', [
            'member' => $member,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Admin\Member\UpdateRequest $request
     * @param App\Models\User                                      $member
     *
     * @return void
     */
    public function update(UpdateRequest $request, User $member)
    {
        try {
            $this->service->update($member, $request->all());

            return redirect()->route('admin.members.index')
                ->withSuccess(__('member.message.success.member-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\User $member
     *
     * @return void
     */
    public function destroy(User $member)
    {
        try {
            $this->service->destroy($member);

            return redirect()->route('admin.members.index')
                ->withSuccess(__('member.message.success.member-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
