<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        if (
            Auth::check() &&
            Auth::user() instanceof User &&
            Auth::user()->canAccessAdmin()
        ) {
            return $next($request);
        }

        return redirect()->route('app.home');
    }
}
