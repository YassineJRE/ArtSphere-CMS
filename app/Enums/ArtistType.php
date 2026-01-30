<?php

namespace App\Enums;

final class ArtistType extends Enum
{
    public const AMATEUR = 'amateur';
    public const STUDENT = 'student';
    public const EMERGING = 'emerging';
    public const PROFESSIONAL_ARTIST = 'professional-artist';
    public const OTHER = 'other';

    public static function list(): array
    {
        return parent::getList(ArtistType::class);
    }
}
