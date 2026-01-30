<?php

namespace App\Enums;

use App\Models\User;

final class Media extends Enum
{
    public const USER = User::class;

    public static function list(): array
    {
        return parent::getList(Media::class);
    }
}
