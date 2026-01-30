<?php

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use App\Models\CollectionItem;
use App\Models\Collection;

class CollectionItemController extends BaseController
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
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\UserProfile $profile
     * @param App\Models\Collection $collection
     * @param App\Models\CollectionItem $item
     *
     * @return Renderable
     */
    public function show(Request $request, UserProfile $profile, Collection $collection, CollectionItem $item)
    {
        return view('profile.collection.item.show', [
            'profile' => $profile,
            'collection' => $collection,
            'item' => $item,
        ]);
    }
}
