<?php

namespace App\Enums;

final class WebsiteGroupType extends Enum
{
    public const ARTIST_WEBSITES = 'artist-websites';
    public const STORE = 'store';
    public const PROJECTS_INITIATIVES = 'projects-initiatives';
    public const SOCIAL_MEDIA = 'social-media';
    public const OTHER = 'other';

    public static function list(): array
    {
        return parent::getList(WebsiteGroupType::class);
    }
}
