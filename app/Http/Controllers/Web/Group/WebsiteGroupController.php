<?php

namespace App\Http\Controllers\Web\Group;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
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
     * @param App\Models\Group $group
     *
     * @return Renderable
     */
    public function index(Request $request, Group $group)
    {
        return view('group.website-group.index', [
            'group' => $group
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $group
     * @param App\Models\WebsiteGroup $websiteGroup
     *
     * @return Renderable
     */
    public function show(Request $request, Group $group, WebsiteGroup $websiteGroup)
    {
        return view('group.website-group.show', [
            'group' => $group,
            'websiteGroup' => $websiteGroup,
        ]);
    }
}
