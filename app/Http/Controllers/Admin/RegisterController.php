<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Admin\Register\PasswordRequest;
use App\Services\Admin\RegisterService;

class RegisterController extends BaseController
{
    public function __construct(RegisterService $service)
    {
        $this->service = $service;
    }

    /**
     * The Finalize Form.
     *
     * @param Illuminate\Http\Request $request
     * @param string                  $token
     *
     * @return Renderable
     */
    public function finalize(Request $request, $token)
    {
        $user = $this->service->findUserByEmailVerificationToken($token);

        if (null == $user) {
            return response()->view('admin.errors.link-expired', [], 403);
        }

        return view('admin.register.finalize', [
            'token' => $token,
            'email' => $user->email,
        ]);
    }

    /**
     * Handling The Form Submission for save new password by user.
     *
     * @param App\Http\Requests\Admin\Register\PasswordRequest $request
     *
     * @return void
     */
    public function password(PasswordRequest $request)
    {
        $user = $this->service->findUserByEmailVerificationToken($request->token);

        if (null == $user) {
            return response()->view('admin.errors.link-expired', [], 403);
        }

        $this->service->savePassword($user, $request->password);

        return redirect()->route('admin.login')
            ->withSuccess(__('Your account is activated, you can log in now'));
    }
}
