<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Web\ForgotPassword\SubmitRequest;

class ForgotPasswordController extends BaseController
{
    /**
     * Show the form for reset password.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('forgot-password.index');
    }

    /**
     * submit form.
     *
     * @param App\Http\Requests\Web\ForgotPassword\SubmitRequest $request
     *
     * @return void
     */
    public function submit(SubmitRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return Password::RESET_LINK_SENT === $status
                    ? back()->withSuccess(__($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
