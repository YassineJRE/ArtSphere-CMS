<?php

namespace App\Http\Controllers\Web\Group;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Group\Artwork\ShowRequest;
use App\Models\Group;
use App\Models\Artwork;
use App\Models\Exhibit;

class ArtworkController extends BaseController
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
     * @param App\Models\Exhibit $exhibit
     *
     * @return Renderable
     */
    public function index(Request $request, Group $group, Exhibit $exhibit)
    {
        return view('group.exhibit.artwork.index', [
            'group' => $group,
            'exhibit' => $exhibit,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\Group\Artwork\ShowRequest $request
     * @param App\Models\Group $group
     * @param App\Models\Exhibit $exhibit
     * @param App\Models\Artwork $artwork
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $group, Exhibit $exhibit, Artwork $artwork)
    {
        $artworkIds = $exhibit->artworks->pluck('id');
        return view('group.exhibit.artwork.show', [
            'group' => $group,
            'exhibit' => $exhibit,
            'previousArtworkId' => $artworkIds->get($artworkIds->search($artwork->id) - 1),
            'artwork' => $artwork,
            'nextArtworkId' => $artworkIds->get($artworkIds->search($artwork->id) + 1),
        ]);
    }
}
