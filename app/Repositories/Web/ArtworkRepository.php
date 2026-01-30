<?php

namespace App\Repositories\Web;

use App\Models\Artwork;
use Illuminate\Support\Collection;
use Exception;

class ArtworkRepository extends BaseRepository
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
}
