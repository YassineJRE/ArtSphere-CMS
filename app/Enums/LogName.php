<?php

namespace App\Enums;

final class LogName extends Enum
{
    public const DEFAULT = 'default';
    public const ADMIN = 'admin';
    public const USER = 'user';
    public const SYSTEM = 'system';

    public static function list(): array
    {
        return parent::getList(LogName::class);
    }
}
