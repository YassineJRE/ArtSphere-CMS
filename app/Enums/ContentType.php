<?php

namespace App\Enums;

final class ContentType extends Enum
{
    public const PAGE = 'page';
    public const COMPONENT = 'component';

    public static function list(): array
    {
        return parent::getList(ContentType::class);
    }
}
