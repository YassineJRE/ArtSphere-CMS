<?php

namespace App\Repositories\Web;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaRepository extends BaseRepository
{
    /**
     * get instance Media Model.
     *
     * @return Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function getModel()
    {
        return new Media();
    }
}
