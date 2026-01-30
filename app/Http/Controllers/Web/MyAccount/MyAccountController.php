<?php

namespace App\Http\Controllers\Web\MyAccount;

use App\Enums\ArtistType;
use App\Enums\ArtPracticeType;
use App\Enums\MediaCollection as EnumMediaCollection;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\MyAccount\UpdatePasswordRequest;
use App\Http\Requests\Web\MyAccount\UpdateDetailsRequest;
use App\Services\Web\MyAccountService;
use App\Http\Controllers\Web\BaseController;

class MyAccountController extends BaseController
{
    public function __construct(MyAccountService $service)
    {
        $this->service = $service;
    }

    /**
     * Display My account page.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        return view('my-account.index',[
            'user' => Auth::user()
        ]);
    }

    /**
     * Edit My account.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Renderable
     */
    public function edit(Request $request)
    {
        return view('my-account.edit',[
            'user' => Auth::user()
        ]);
    }

    /**
     * Update details of my account.
     *
     * @param App\Http\Requests\Web\MyAccount\UpdateDetailsRequest $request
     *
     * @return Renderable
     */
    public function updateDetails(UpdateDetailsRequest $request)
    {
        try {
            $user = auth()->user();
            $this->service->updateDetails($user, $request->validated());

            if ($request->has('avatar')) {
                $user->clearMediaCollection(EnumMediaCollection::AVATAR);
                $media = $user->addMedia($request->avatar)
                            ->usingName($user->getDefaultName())
                            ->usingFileName($user->getDefaultFileName())
                            ->toMediaCollection(EnumMediaCollection::AVATAR);
            }

            return redirect()->route('my-account.index')->withSuccess(__('my-account.message.success.my-account-updated'));
        } catch (ServiceException $e) {
            return redirect()->route('my-account.index')->withErrors($e->getMessage());
        }
    }

    /**
     * Display My Change password page
     *
     * @return Renderable
     */
    public function changePassword()
    {
        return view('my-account.change-password');
    }

    /**
     * Change my password.
     *
     * @param App\Http\Requests\Web\MyAccount\UpdatePasswordRequest $request
     *
     * @return Renderable
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $this->service->changePassword(auth()->user(), $request->input('password'));

            return redirect()->route('my-account.index')
                ->withSuccess(__('my-account.message.success.password-updated'));
        } catch (ServiceException $e) {
            return redirect()->route('my-account.index')->withErrors($e->getMessage());
        }
    }
}
