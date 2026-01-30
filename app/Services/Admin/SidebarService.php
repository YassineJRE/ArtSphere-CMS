<?php

namespace App\Services\Admin;

use App\Repositories\Admin\SidebarRepository;

class SidebarService
{
    public static function getNumberGalleries(): int
    {
        return SidebarRepository::getNumberGalleries();
    }

    public static function getNumberGalleriesApproved(): int
    {
        return SidebarRepository::getNumberGalleriesApproved();
    }

    public static function getNumberGalleriesDisabled(): int
    {
        return SidebarRepository::getNumberGalleriesDisabled();
    }

    public static function getNumberGalleriesEnabled(): int
    {
        return SidebarRepository::getNumberGalleriesEnabled();
    }

    public static function getNumberGalleriesAwaitingApproval(): int
    {
        return SidebarRepository::getNumberGalleriesAwaitingApproval();
    }

    public static function getNumberUnreadNotifications(): int
    {
        return SidebarRepository::getNumberUnreadNotifications();
    }

    public static function getNumberMembers(): int
    {
        return SidebarRepository::getNumberMembers();
    }

    public static function getNumberMembersEnabled(): int
    {
        return SidebarRepository::getNumberMembersEnabled();
    }

    public static function getNumberMembersDisabled(): int
    {
        return SidebarRepository::getNumberMembersDisabled();
    }

    public static function getNumberMembersDeleted(): int
    {
        return SidebarRepository::getNumberMembersDeleted();
    }

    public static function getNumberMembersPending(): int
    {
        return SidebarRepository::getNumberMembersPending();
    }

    public static function getNumberMembersBanned(): int
    {
        return SidebarRepository::getNumberMembersBanned();
    }
}
