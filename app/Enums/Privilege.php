<?php

namespace App\Enums;

/**
 * Privileges System is a list of Permissions.
 */
class Privilege extends Enum
{
    protected static function _list($class): array
    {
        return parent::getList($class);
    }

    protected static function _listWeb($class): array
    {
        return parent::getList($class, 'WEB_');
    }
}
