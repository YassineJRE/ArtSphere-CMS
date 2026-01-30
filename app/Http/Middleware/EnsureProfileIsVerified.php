<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureProfileIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedProfile()) {
            return $request->expectsJson()
                ? abort(403, 'Your profile is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'verification.profile-notice'));
        }

        return $next($request);
    }
}
