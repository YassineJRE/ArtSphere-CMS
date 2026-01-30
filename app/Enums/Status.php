<?php

namespace App\Enums;

final class Status extends Enum
{
    public const ENABLED = 'enabled';
    public const DELETED = 'deleted';
    public const CANCELED = 'canceled';
    public const DISABLED = 'disabled';
    public const PENDING = 'pending';
    public const PENDING_CONSENT = 'pending_consent';
    public const BANNED = 'banned';
    public const INVALID = 'invalid';
    public const DRAFT = 'draft';
    public const AWAITING_SUBMISSION = 'awaiting-submission';
    public const SENT = 'sent';
    public const WAITING_FOR_VALIDATION = 'waiting-for-validation';
    public const AWAITING_APPROVAL = 'awaiting-approval';
    public const ACCEPTED = 'accepted';
    public const REFUSED = 'refused';
    public const ADDED = 'added';
    public const TO_VERIFIED_GALLERIES_ONLY = 'to-verified-galleries-only';

    public static function shortPublish(): array
    {
        return [
            self::ENABLED,
            self::DISABLED
        ];
    }

    public static function longPublish(): array
    {
        return [
            self::ENABLED,
            self::DISABLED,
            self::TO_VERIFIED_GALLERIES_ONLY
        ];
    }

    public static function list(): array
    {
        return parent::getList(Status::class);
    }
}
