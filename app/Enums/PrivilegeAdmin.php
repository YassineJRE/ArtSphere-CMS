<?php

namespace App\Enums;

final class PrivilegeAdmin extends Privilege
{
    public const WEB_DASHBOARD_READ = 'admin.dashboard.read';

    public const WEB_USER_LOG_READ = 'admin.user-logs.read';

    public const WEB_ADMIN_LOG_READ = 'admin.admin-log.read';

    public const WEB_USER_CREATE = 'admin.users.create';
    public const WEB_USER_READ = 'admin.users.read';
    public const WEB_USER_UPDATE = 'admin.users.update';
    public const WEB_USER_DELETE = 'admin.users.delete';

    public const WEB_ROLE_CREATE = 'admin.roles.create';
    public const WEB_ROLE_READ = 'admin.roles.read';
    public const WEB_ROLE_UPDATE = 'admin.roles.update';
    public const WEB_ROLE_DELETE = 'admin.roles.delete';

    public const WEB_USER_NOTIFICATION_CREATE = 'admin.user-notifications.create';
    public const WEB_USER_NOTIFICATION_READ = 'admin.user-notifications.read';
    public const WEB_USER_NOTIFICATION_UPDATE = 'admin.user-notifications.update';
    public const WEB_USER_NOTIFICATION_DELETE = 'admin.user-notifications.delete';

    public const WEB_MY_PROFILE_READ = 'admin.my-profile.read';
    public const WEB_MY_PROFILE_UPDATE = 'admin.my-profile.update';

    public const WEB_MEMBER_CREATE = 'admin.members.create';
    public const WEB_MEMBER_READ = 'admin.members.read';
    public const WEB_MEMBER_UPDATE = 'admin.members.update';
    public const WEB_MEMBER_DELETE = 'admin.members.delete';

    public const WEB_CONTENT_CREATE = 'admin.content.create';
    public const WEB_CONTENT_READ = 'admin.content.read';
    public const WEB_CONTENT_UPDATE = 'admin.content.update';
    public const WEB_CONTENT_DELETE = 'admin.content.delete';
    
    public const WEB_GALLERY_READ = 'admin.galleries.read';
    public const WEB_GALLERY_DELETE = 'admin.galleries.delete';
    public const WEB_GALLERY_TOGGLE_ENABLE = 'admin.galleries.toggle-enable';
    public const WEB_GALLERY_APPROVE = 'admin.galleries.approve';

    public static function list(): array
    {
        return parent::_list(PrivilegeAdmin::class);
    }

    public static function web(): array
    {
        return parent::_listWeb(PrivilegeAdmin::class);
    }
}
