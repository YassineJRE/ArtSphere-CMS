<?php

namespace App\Repositories\Web\MyGroup;

use App\Models\RemoveFromDB;
use App\Repositories\Web\BaseRepository;

class MyModelRemovedRepository extends BaseRepository
{
    /**
     * get instance RemoveFromDB Model.
     *
     * @return App\Models\RemoveFromDB
     */
    public function getModel()
    {
        return new RemoveFromDB();
    }
}
