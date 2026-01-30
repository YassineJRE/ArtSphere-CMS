<?php

namespace App\Enums;

final class MemberType extends Enum
{
    public const ADMINISTRATOR = 'administrator';
    public const MEMBER = 'member';

    public static function list(): array
    {
        return parent::getList(MemberType::class);
    }
}
