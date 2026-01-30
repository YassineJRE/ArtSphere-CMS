<?php

namespace App\Repositories\Admin;

use App\Models\Group;
use App\Models\User;
use App\Models\UserNotification;

class SidebarRepository
{
    public static function getNumberGalleries(): int
    {
        return Group::gallery()->count();
    }

    public static function getNumberGalleriesApproved(): int
    {
        return Group::gallery()->approved()->count();
    }

    public static function getNumberGalleriesEnabled(): int
    {
        return Group::gallery()->enabled()->count();
    }

    public static function getNumberGalleriesDisabled(): int
    {
        return Group::gallery()->disabled()->count();
    }

    public static function getNumberGalleriesAwaitingApproval(): int
    {
        return Group::gallery()->awaitingApproval()->count();
    }

    public static function getNumberUnreadNotifications(): int
    {
        return UserNotification::unread()->count();
    }

    public static function getNumberMembers(): int
    {
        return User::count();
    }

    public static function getNumberMembersEnabled(): int
    {
        return User::enabled()->count();
    }

    public static function getNumberMembersDisabled(): int
    {
        return User::disabled()->count();
    }

    public static function getNumberMembersDeleted(): int
    {
        return User::memberDeleted()->count();
    }

    public static function getNumberMembersPending(): int
    {
        return User::pending()->count();
    }

    public static function getNumberMembersBanned(): int
    {
        return User::banned()->count();
    }
}
