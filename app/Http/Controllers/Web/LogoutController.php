<?php

namespace App\Http\Controllers\Web;

use App\Enums\LogEvent;
use App\Enums\LogName;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LogoutController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        Session::flush();
        Auth::logout();

        activity(LogName::USER)
            ->causedBy($user)
            ->event(LogEvent::LOGOUT)
            ->withProperties([
                'ip' => $request->ip(),
                'guard' => 'web',
            ])
            ->log(LogName::USER.'.'.LogEvent::LOGOUT);

        return redirect()->route('app.home')
            ->withSuccess('login.message.success.signed-out');
    }
}
