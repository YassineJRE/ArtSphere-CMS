<?php

namespace App\Enums;

final class PrivilegeAuthentication extends Privilege
{
    public static function list(): array
    {
        return parent::_list(PrivilegeAdmin::class);
    }

    public static function web(): array
    {
        return parent::_listWeb(PrivilegeAdmin::class);
    }
}
