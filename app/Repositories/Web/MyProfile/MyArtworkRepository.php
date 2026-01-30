<?php

namespace App\Repositories\Web\MyProfile;

use App\Models\Artwork;
use App\Repositories\Web\BaseRepository;
use App\Exceptions\RepositoryException;
use Exception;
use Illuminate\Support\Facades\DB;

class MyArtworkRepository extends BaseRepository
{
    /**
     * get instance Artwork Model.
     *
     * @return App\Models\Artwork
     */
    public function getModel()
    {
        return new Artwork();
    }

    /**
     * Transfer to another Exhibit
     *
     * @param App\Models\Artwork $artwork
     * @param array              $data  Atributes of Artwork
     *
     * @return App\Models\Artwork
     */
    public function transferTo(Artwork $artwork, array $data): Artwork
    {
        try {
            $artwork = DB::transaction(function () use ($artwork, $data) {
                return parent::update($artwork, [
                    'exhibit_id' => $data['exhibit_id'],
                ]);
            });

            return $artwork;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Change position
     *
     * @param App\Models\Artwork $artwork
     * @param int              $position  New position
     *
     * @return App\Models\Artwork
     */
    public function changePosition(Artwork $artwork, int $position): Artwork
    {
        try {
            $artwork = DB::transaction(function () use ($artwork, $position) {
                $artworks = $artwork->exhibit->artworks()->where('id','<>',$artwork->id)->orderBy('order_column')->get();
                $order_column = 1;
                $artworksOrdered = [];
                $artworksOrdered[$position] = $artwork;
                foreach ($artworks as $currentArtwork) {
                    if ($order_column == $position) {
                        $order_column++;
                    }
                    $artworksOrdered[$order_column++] = $currentArtwork;
                }
                foreach ($artworksOrdered as $currentPosition => $currentArtwork) {
                    parent::update($currentArtwork, ['order_column' => $currentPosition]);
                }
                return $artwork;
            });

            return $artwork;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}
