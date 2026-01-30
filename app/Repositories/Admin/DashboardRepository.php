<?php

namespace App\Repositories\Admin;

use App\Models\User;
use App\Models\UserProfile;

class DashboardRepository
{
    public static function getNumberMembers(): int
    {
        return User::count();
    }

    public static function getNumberArtistProfiles(): int
    {
        return UserProfile::artists()->count();
    }

    public static function getNumberCuratorProfiles(): int
    {
        return UserProfile::curators()->count();
    }

    public static function getNumberPublicCollectorProfiles(): int
    {
        return UserProfile::publicCollectors()->count();
    }

}
