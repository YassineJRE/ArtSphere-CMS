<?php

namespace App\Enums;

final class InstitutionType extends Enum
{
    public const ARTIST_RUN_CENTER = 'artist-run-center';
    public const ARTS_ORGANISATION = 'arts-organisation';
    public const ARTS_INSTITUTION = 'arts-institution';
    public const UNIVERSITY_GALLERY = 'university-gallery';

    public static function list(): array
    {
        return parent::getList(InstitutionType::class);
    }
}
