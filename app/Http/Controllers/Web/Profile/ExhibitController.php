<?php

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Profile\Exhibit\IndexRequest;
use App\Http\Requests\Web\Profile\Exhibit\ShowRequest;
use App\Models\UserProfile;
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
     * @param App\Http\Requests\Web\Profile\Exhibit\IndexRequest $request
     * @param App\Models\UserProfile $profile
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $profile)
    {
        return view('profile.exhibit.index', [
            'profile' => $profile
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\Profile\Exhibit\ShowRequest $request
     * @param App\Models\UserProfile $profile
     * @param App\Models\Exhibit $exhibit
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $profile, Exhibit $exhibit)
    {
        return view('profile.exhibit.show', [
            'profile' => $profile,
            'exhibit' => $exhibit,
        ]);
    }
}
