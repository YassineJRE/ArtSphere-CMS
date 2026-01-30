<?php

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use App\Models\WebsiteGroup;

class WebsiteGroupController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\UserProfile $profile
     *
     * @return Renderable
     */
    public function index(Request $request, UserProfile $profile)
    {
        return view('profile.website-group.index', [
            'profile' => $profile
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\UserProfile $profile
     * @param App\Models\WebsiteGroup $websiteGroup
     *
     * @return Renderable
     */
    public function show(Request $request, UserProfile $profile, WebsiteGroup $websiteGroup)
    {
        return view('profile.website-group.show', [
            'profile' => $profile,
            'websiteGroup' => $websiteGroup,
        ]);
    }
}
