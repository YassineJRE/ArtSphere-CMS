<?php

namespace App\Repositories\Admin;

use Spatie\Activitylog\Models\Activity;

class UserLogRepository extends BaseRepository
{
    /**
     * get instance Activity Model.
     *
     * @return Spatie\Activitylog\Contracts\Activity
     */
    public function getModel()
    {
        return new Activity();
    }
}
