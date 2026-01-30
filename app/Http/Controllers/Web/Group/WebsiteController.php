<?php

namespace App\Http\Controllers\Web\Group;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
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
     * @param App\Models\Group $group
     * @param App\Models\WebsiteGroup $websiteGroup
     *
     * @return Renderable
     */
    public function index(Request $request, Group $group, WebsiteGroup $websiteGroup)
    {
        return view('group.website-group.website.index', [
            'group' => $group,
            'websiteGroup' => $websiteGroup,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $group
     * @param App\Models\WebsiteGroup $websiteGroup
     * @param App\Models\Website $website
     *
     * @return Renderable
     */
    public function show(Request $request, Group $group, WebsiteGroup $websiteGroup, Website $website)
    {
        $websiteIds = $websiteGroup->websites->pluck('id');
        return view('group.website-group.website.show', [
            'group' => $group,
            'websiteGroup' => $websiteGroup,
            'previousWebsiteId' => $websiteIds->get($websiteIds->search($website->id) - 1),
            'website' => $website,
            'nextWebsiteId' => $websiteIds->get($websiteIds->search($website->id) + 1),
        ]);
    }
}
