<?php

namespace App\Enums;

final class ArtPracticeType extends Enum
{
    public const CONTEMPORARY = 'contemporary';
    public const ILLUSTRATION = 'illustration';
    public const INSTALLATION = 'installation';
    public const MULTIDISCIPLINARY = 'multidisciplinary';
    public const MEDIA = 'media';
    public const DIGITAL = 'digital';
    public const PAINTING = 'painting';
    public const PERFORMANCE = 'performance';
    public const PHOTOGRAPHY = 'photography';
    public const OTHER = 'other';

    public static function list(): array
    {
        return parent::getList(ArtPracticeType::class);
    }
}
