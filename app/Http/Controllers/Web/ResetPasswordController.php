<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Requests\Web\ResetPassword\SubmitRequest;

class ResetPasswordController extends BaseController
{
    /**
     * Show the form for reset password.
     *
     * @param Illuminate\Http\Request $request
     * @param string                  $token
     *
     * @return Renderable
     */
    public function index(Request $request, $token)
    {
        return view('reset-password.index', [
            'token' => $token,
            'email' => $request->get('email'),
        ]);
    }

    /**
     * Submit form.
     *
     * @param App\Http\Requests\Web\ResetPassword\SubmitRequest $request
     *
     * @return void
     */
    public function submit(SubmitRequest $request)
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
                    ? redirect()->route('authentication.login')->withSuccess(__($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}