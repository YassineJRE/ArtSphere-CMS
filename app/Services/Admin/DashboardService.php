<?php

namespace App\Services\Admin;

use App\Repositories\Admin\DashboardRepository;

class DashboardService
{
    public static function getNumberMembers(): int
    {
        return DashboardRepository::getNumberMembers();
    }

    public static function getNumberArtistProfiles(): int
    {
        return DashboardRepository::getNumberArtistProfiles();
    }

    public static function getNumberCuratorProfiles(): int
    {
        return DashboardRepository::getNumberCuratorProfiles();
    }

    public static function getNumberPublicCollectorProfiles(): int
    {
        return DashboardRepository::getNumberPublicCollectorProfiles();
    }
}
