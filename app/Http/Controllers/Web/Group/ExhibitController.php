<?php

namespace App\Http\Controllers\Web\Group;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Group\Exhibit\IndexRequest;
use App\Http\Requests\Web\Group\Exhibit\ShowRequest;
use App\Models\Group;
use App\Models\Exhibit;

class ExhibitController extends BaseController
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
     * @param App\Http\Requests\Web\Group\Exhibit\IndexRequest $request
     * @param App\Models\Group $group
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, Group $group)
    {
        return view('group.exhibit.index', [
            'group' => $group
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\Group\Exhibit\ShowRequest $request
     * @param App\Models\Group $group
     * @param App\Models\Exhibit $exhibit
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $group, Exhibit $exhibit)
    {
        return view('group.exhibit.show', [
            'group' => $group,
            'exhibit' => $exhibit,
        ]);
    }
}
