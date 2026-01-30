<?php

namespace App\Enums;

final class MediaCollection extends Enum
{
    public const DEFAULT = 'default';
    public const AVATAR = 'avatar';

    public static function list(): array
    {
        return parent::getList(MediaCollection::class);
    }
}
