<?php

namespace App\Enums;

final class LogEvent extends Enum
{
    public const LOGIN = 'login';
    public const LOGOUT = 'logout';
    public const CREATED = 'created';
    public const UPDATED = 'updated';
    public const DELETED = 'deleted';
    public const NOTIFIED = 'notified';
    public const REGISTERED = 'registered';
    public const PROFILE_REGISTERED = 'profile-registered';

    public static function list(): array
    {
        return parent::getList(LogEvent::class);
    }
}
