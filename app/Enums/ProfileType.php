<?php

namespace App\Enums;

final class ProfileType extends Enum
{
    public const ARTIST = 'artist';
    public const CURATOR = 'curator';
    public const PUBLIC_COLLECTOR = 'public-collector';

    public static function list(): array
    {
        return parent::getList(ProfileType::class);
    }
}
