<?php

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Profile\Artwork\ShowRequest;
use App\Models\UserProfile;
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
     * @param App\Models\UserProfile $profile
     * @param App\Models\Exhibit $exhibit
     *
     * @return Renderable
     */
    public function index(Request $request, UserProfile $profile, Exhibit $exhibit)
    {
        return view('profile.exhibit.artwork.index', [
            'profile' => $profile,
            'exhibit' => $exhibit,
        ]);
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\Profile\Artwork\ShowRequest $request
     * @param App\Models\UserProfile $profile
     * @param App\Models\Exhibit $exhibit
     * @param App\Models\Artwork $artwork
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $profile, Exhibit $exhibit, Artwork $artwork)
    {
        $artworkIds = $exhibit->artworks->pluck('id');
        return view('profile.exhibit.artwork.show', [
            'profile' => $profile,
            'exhibit' => $exhibit,
            'previousArtworkId' => $artworkIds->get($artworkIds->search($artwork->id) - 1),
            'artwork' => $artwork,
            'nextArtworkId' => $artworkIds->get($artworkIds->search($artwork->id) + 1),
        ]);
    }
}
