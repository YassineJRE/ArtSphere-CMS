<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\Exhibit;
use App\Models\Artwork;
use App\Services\Web\ArtworkService;

class ArtworkController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArtworkService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Exhibit $exhibit
     * @param App\Models\Artwork $artwork
     *
     * @return Renderable
     */
    public function show(Request $request, Exhibit $exhibit, Artwork $artwork)
    {
        $artworkIds = $exhibit->artworks->filter()->pluck('id');
        $artworksRemovedFromDB = app('profile.session')->getModelsRemovedFromDB()
            ->where('model_type', Artwork::class)
            ->pluck('model_id');
        $artworkIds = $artworkIds->diff($artworksRemovedFromDB)->values();
        $previousArtworkId = $artworkIds->get($artworkIds->search($artwork->id) - 1);
        $nextArtworkId = $artworkIds->get($artworkIds->search($artwork->id) + 1);

        if ($artworkIds->count() <= 0) {
            return redirect()->route('app.exhibits.show', [
                'exhibit' => $exhibit
            ]);
        }

        if ( !$artworkIds->contains($artwork->id) ) {
            return redirect()->route('app.exhibits.artworks.show', [
                'exhibit' => $exhibit,
                'artwork' => $nextArtworkId ?? $artworkIds->first()
            ]);
        }

        return view('exhibit.artwork.show', [
            'exhibit' => $exhibit,
            'artwork' => $artwork,
            'previousArtworkId' => $previousArtworkId ?? $artworkIds->last(),
            'nextArtworkId' => $nextArtworkId ?? $artworkIds->first(),
        ]);
    }
}
