<?php

namespace App\Repositories\Admin;

use App\Models\Content;

class ContentRepository extends BaseRepository
{
    /**
     * get instance Content Model.
     *
     * @return App\Models\Content
     */
    public function getModel()
    {
        return new Content();
    }
}
