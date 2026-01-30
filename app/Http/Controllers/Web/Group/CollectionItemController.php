<?php

namespace App\Http\Controllers\Web\Group;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
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
     * @param App\Models\Group $group
     * @param App\Models\Collection $collection
     * @param App\Models\CollectionItem $item
     *
     * @return Renderable
     */
    public function show(Request $request, Group $group, Collection $collection, CollectionItem $item)
    {
        return view('group.collection.item.show', [
            'group' => $group,
            'collection' => $collection,
            'item' => $item,
        ]);
    }
}
