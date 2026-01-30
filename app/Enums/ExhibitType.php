<?php

namespace App\Enums;

final class ExhibitType extends Enum
{
    public const SOLO = 'solo';
    public const DUO = 'duo';
    public const GROUP = 'group';
    public const RESIDENCY = 'residency';

    public static function list(): array
    {
        return parent::getList(ExhibitType::class);
    }
}
