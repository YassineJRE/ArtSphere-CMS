<?php

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;

class WebsiteController extends BaseController
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
     * @param App\Models\WebsiteGroup $websiteGroup
     *
     * @return Renderable
     */
    public function index(Request $request, UserProfile $profile, WebsiteGroup $websiteGroup)
    {
        return view('profile.website-group.website.index', [
            'profile' => $profile,
            'websiteGroup' => $websiteGroup,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\UserProfile $profile
     * @param App\Models\WebsiteGroup $websiteGroup
     * @param App\Models\Website $website
     *
     * @return Renderable
     */
    public function show(Request $request, UserProfile $profile, WebsiteGroup $websiteGroup, Website $website)
    {
        $websiteIds = $websiteGroup->websites->pluck('id');
        return view('profile.website-group.website.show', [
            'profile' => $profile,
            'websiteGroup' => $websiteGroup,
            'previousWebsiteId' => $websiteIds->get($websiteIds->search($website->id) - 1),
            'website' => $website,
            'nextWebsiteId' => $websiteIds->get($websiteIds->search($website->id) + 1),
        ]);
    }
}
