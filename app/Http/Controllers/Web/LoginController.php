<?php

namespace App\Http\Controllers\Web;

use App\Enums\LogEvent;
use App\Enums\LogName;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * Display a form.
     *
     * @return Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('app.home');
        }

        return view('login.index');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            activity(LogName::USER)
                ->causedBy(Auth::user())
                ->event(LogEvent::LOGIN)
                ->withProperties([
                    'ip' => $request->ip(),
                    'guard' => 'web',
                ])
                ->log(LogName::USER.'.'.LogEvent::LOGIN);

            return redirect()->route('my-account.index')
                    ->withSuccess(__('login.message.success.signed-in'));
        }

        return redirect()->route('authentication.login')
            ->withErrors(__('login.message.success.valid'));
    }
}
