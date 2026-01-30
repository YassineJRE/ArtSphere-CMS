<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PrivilegeAdmin;
use App\Enums\MediaCollection as EnumMediaCollection;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Admin\MyProfile\ChangePasswordRequest;
use App\Http\Requests\Admin\MyProfile\UpdateDetailsRequest;
use App\Services\Admin\MyProfileService;

class MyProfileController extends BaseController
{
    public function __construct(MyProfileService $service)
    {
        $this->service = $service;
        $this->middleware('permission:'.implode('|', [
            PrivilegeAdmin::WEB_MY_PROFILE_READ,
            PrivilegeAdmin::WEB_MY_PROFILE_UPDATE,
        ]), ['only' => ['index']]);
        $this->middleware('permission:'.PrivilegeAdmin::WEB_MY_PROFILE_UPDATE, [
            'only' => ['updateDetails', 'changePassword'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('admin.my-profile.index');
    }

    /**
     * Update details of my profile.
     *
     * @return Renderable
     */
    public function updateDetails(UpdateDetailsRequest $request)
    {
        try {
            $data = $request->only('first_name', 'last_name', 'email');
            $user = auth()->user();
            $this->service->updateDetails($user, $data);            

            if ($request->has('avatar')) {
                $user->clearMediaCollection(EnumMediaCollection::AVATAR);
                $media = $user->addMedia($request->avatar)
                            ->usingName($user->getDefaultName())
                            ->usingFileName($user->getDefaultFileName())
                            ->toMediaCollection(EnumMediaCollection::AVATAR);
            }

            return redirect()->route('admin.my-profile')->withSuccess(__('admin-my-profile.message.success.my-profile-updated'));
        } catch (ServiceException $e) {
            return redirect()->route('admin.my-profile')->withErrors($e->getMessage());
        }
    }

    /**
     * Change my password.
     *
     * @return Renderable
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $this->service->changePassword(auth()->user(), $request->input('password'));

            return redirect()->route('admin.my-profile')
                ->withSuccess(__('admin-my-profile.message.success.password-updated'));
        } catch (ServiceException $e) {
            return redirect()->route('admin.my-profile')->withErrors($e->getMessage());
        }
    }
}
