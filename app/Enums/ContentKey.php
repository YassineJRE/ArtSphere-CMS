<?php

namespace App\Enums;

final class ContentKey extends Enum
{
    public const PRIVACY_POLICY = 'privacy';
    public const TERMS_CONDITIONS = 'terms-conditions';
    public const ABOUT_US = 'about-us';
    public const THANKS = 'thanks';

    public static function list(): array
    {
        return parent::getList(ContentKey::class);
    }
}
