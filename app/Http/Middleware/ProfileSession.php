<?php

namespace App\Http\Middleware;

use App\Models\UserProfile;
use App\Models\Group;
use Closure;
use Illuminate\Http\Request;

class ProfileSession
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('my_artist_run_center_gallery') instanceof Group) {
            app('profile.session')->setGroup($request->route('my_artist_run_center_gallery'));
        }
        elseif ($request->route('artist_profile') instanceof UserProfile) {
            app('profile.session')->setProfile($request->route('artist_profile'));
        }
        elseif ($request->route('artist_group') instanceof Group) {
            app('profile.session')->setGroup($request->route('artist_group'));
        }
        elseif ($request->route('curator_profile') instanceof UserProfile) {
            app('profile.session')->setProfile($request->route('curator_profile'));
        }
        elseif ($request->route('curator_group') instanceof Group) {
            app('profile.session')->setGroup($request->route('curator_group'));
        }
        elseif ($request->route('public_collector_profile') instanceof UserProfile) {
            app('profile.session')->setProfile($request->route('public_collector_profile'));
        }
        elseif ($request->route('my_profile') instanceof UserProfile) {
            app('profile.session')->setProfile($request->route('my_profile'));
        }
        elseif ($request->route('my_group') instanceof Group) {
            app('profile.session')->setGroup($request->route('my_group'));
        }

	    return $next($request);
    }
}
