<?php

namespace App\Enums;

final class VerifiedStatus extends Enum
{
    public const PENDING = 'Pending';
    public const DENIED = 'Denied';
    public const APPROVED = 'Approved';

    public static function list(): array
    {
        return parent::getList(VerifiedStatus::class);
    }
    public static function pending(): string{return 'Pending';}
}
