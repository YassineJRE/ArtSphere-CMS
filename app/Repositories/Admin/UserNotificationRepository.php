<?php

namespace App\Repositories\Admin;

use App\Models\UserNotification;

class UserNotificationRepository extends BaseRepository
{
    /**
     * get instance UserNotification Model.
     *
     * @return App\Models\UserNotification
     */
    public function getModel()
    {
        return new UserNotification();
    }
}
