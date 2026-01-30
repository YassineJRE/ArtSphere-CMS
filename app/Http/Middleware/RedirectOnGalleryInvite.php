<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Models\UserInvitation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectOnGalleryInvite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        $user = $request->user();
        if($user == null){return $next($request);}
        $invite = UserInvitation::where('guest_id', $user->id)->get()->first();
        if($invite instanceof UserInvitation && $invite->toJoinGroup()){
            $group = $invite->subject;
            if($group->isDraft() && ($request->url() != route('my-group.edit',['my_group'=>$group->id]) || $request->url() != route('verification.profile-notice'))){
                if($redirectToRoute == null){return redirect()->route('my-group.edit',['my_group'=>$group->id]);}
                else{return redirect($redirectToRoute);}
            }
        }
        
        return $next($request);
    }
}
