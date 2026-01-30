<?php

namespace App\Enums;

final class GroupType extends Enum
{
    public const ARTIST_RUN_CENTER_ORG = 'artist-run-center-organisation';
    public const ARTIST = 'artist';
    public const CURATOR = 'curator';

    public static function list(): array
    {
        return parent::getList(GroupType::class);
    }
}
