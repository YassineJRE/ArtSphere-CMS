<?php

namespace App\Repositories\Admin;

use App\Models\Group;

class GalleryRepository extends BaseRepository
{
    /**
     * get instance Group Model.
     *
     * @return App\Models\Group
     */
    public function getModel()
    {
        return new Group();
    }
}
