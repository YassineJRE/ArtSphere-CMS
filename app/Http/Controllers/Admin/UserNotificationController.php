<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PrivilegeAdmin;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserNotification;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Admin\DatatableRequest;
use App\Http\Requests\Admin\UserNotification\StoreRequest;
use App\Http\Requests\Admin\UserNotification\UpdateRequest;
use App\Services\Admin\UserNotificationService;

class UserNotificationController extends BaseController
{
    public function __construct(UserNotificationService $service)
    {
        $this->service = $service;
        $this->middleware('permission:'.implode('|', [
            PrivilegeAdmin::WEB_USER_NOTIFICATION_CREATE,
            PrivilegeAdmin::WEB_USER_NOTIFICATION_READ,
            PrivilegeAdmin::WEB_USER_NOTIFICATION_UPDATE,
            PrivilegeAdmin::WEB_USER_NOTIFICATION_DELETE,
        ]), ['only' => ['index', 'datatable',  'show']]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_USER_NOTIFICATION_CREATE, [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_USER_NOTIFICATION_UPDATE, [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_USER_NOTIFICATION_DELETE, [
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
        return view('admin.user-notification.index');
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
        return view('admin.user-notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Admin\UserNotification\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->service->store($request->all());

            return redirect()->route('admin.user-notifications.index')
                ->withSuccess(__('admin-user-notification.message.success.user-notification-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param int $userNotificationId
     *
     * @return Renderable
     */
    public function show($userNotificationId)
    {
        $notification = UserNotification::findOrFail($userNotificationId);

        return view('admin.user-notification.show', ['notification' => $notification]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $userNotificationId
     *
     * @return Renderable
     */
    public function edit($userNotificationId)
    {
        $notification = UserNotification::findOrFail($userNotificationId);

        return view('admin.user-notification.edit', ['notification' => $notification]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Admin\UserNotification\UpdateRequest $request
     * @param int                                                            $userNotificationId
     *
     * @return void
     */
    public function update(UpdateRequest $request, $userNotificationId)
    {
        try {
            $notification = UserNotification::findOrFail($userNotificationId);
            $this->service->update($notification, $request->all());

            return redirect()->route('admin.user-notifications.index')
                ->withSuccess(__('admin-user-notification.message.success.user-notification-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $userNotificationId
     *
     * @return void
     */
    public function destroy($userNotificationId)
    {
        try {
            $notification = UserNotification::findOrFail($userNotificationId);
            $this->service->destroy($notification);

            return redirect()->route('admin.user-notifications.index')
                ->withSuccess(__('admin-user-notification.message.success.user-notification-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
