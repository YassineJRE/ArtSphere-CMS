<?php

namespace App\Services\Web;

use App\Repositories\Web\SidebarRepository;

class SidebarService
{
    public static function getListProfiles(): array
    {
        return SidebarRepository::getListProfiles();
    }
}
