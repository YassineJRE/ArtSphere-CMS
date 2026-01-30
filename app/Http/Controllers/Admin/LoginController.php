<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LogEvent;
use App\Enums\LogName;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Login\AuthenticateRequest;
use App\Services\Admin\LoginService;

class LoginController extends BaseController
{
    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login.index');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(AuthenticateRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = $this->service->findUserByEmail($request->email);

        if (
            $user instanceof MustVerifyEmail &&
            $user->hasVerifiedEmail() &&
            Auth::attempt($credentials)
        ) {
            activity(LogName::ADMIN)
                ->causedBy($user)
                ->event(LogEvent::LOGIN)
                ->withProperties([
                    'ip' => $request->ip(),
                    'guard' => 'web',
                ])
                ->log(LogName::ADMIN.'.'.LogEvent::LOGIN);

            return redirect()->route('admin.dashboard')
                    ->withSuccess(__('admin-login.message.success.signed-in'));
        }

        return redirect()->route('admin.login')
            ->withErrors(__('admin-login.message.errors.not-valid'));
    }
}
