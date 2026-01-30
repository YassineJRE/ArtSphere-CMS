<?php

namespace App\Repositories\Web\MyGroup;

use App\Models\UserHasGroup;
use App\Repositories\Web\BaseRepository;

class MemberRepository extends BaseRepository
{
    /**
     * get instance UserHasGroup Model.
     *
     * @return App\Models\UserHasGroup
     */
    public function getModel()
    {
        return new UserHasGroup();
    }
}
