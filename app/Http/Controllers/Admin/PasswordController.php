<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\Password\EmailRequest;
use App\Http\Requests\Admin\Password\UpdateRequest;

class PasswordController extends BaseController
{
    /**
     * The Password Reset Link Request Form.
     *
     * @return Renderable
     */
    public function request()
    {
        return view('admin.password.request');
    }

    /**
     * Handling The Form Submission.
     *
     * @param App\Http\Requests\Admin\Password\EmailRequest $request
     *
     * @return void
     */
    public function email(EmailRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return Password::RESET_LINK_SENT === $status
                    ? back()->withSuccess(__($status))
                    : back()->withErrors(['email' => __($status)]);
    }

    /**
     * The Password Reset Form.
     *
     * @param Illuminate\Http\Request $request
     * @param string                  $token
     *
     * @return Renderable
     */
    public function reset(Request $request, $token)
    {
        return view('admin.password.reset', [
            'token' => $token,
            'email' => $request->get('email'),
        ]);
    }

    /**
     * Handling The Form Submission.
     *
     * @param App\Http\Requests\Admin\Password\UpdateRequest $request
     *
     * @return void
     */
    public function update(UpdateRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return Password::PASSWORD_RESET === $status
                    ? redirect()->route('admin.login')->withSuccess(__($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
