<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Web\BaseController;
use App\Models\Collection;
use App\Models\UserProfile;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class CollectionController extends BaseController
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
        return view('profile.collection.index', [
            'profile' => $profile,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\UserProfile $profile
     * @param App\Models\Collection $collection
     *
     * @return Renderable
     */
    public function show(Request $request, UserProfile $profile, Collection $collection)
    {
        return view('profile.collection.show', [
            'profile' => $profile,
            'collection' => $collection,
        ]);
    }
}
