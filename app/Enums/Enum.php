<?php

namespace App\Enums;

use Illuminate\Support\Str;

abstract class Enum
{
    protected static function getList($class, $starts_with = ''): array
    {
        $refl = new \ReflectionClass($class);
        $list = [];

        foreach ($refl->getConstants() as $constant => $value) {
            if (!empty($starts_with)) {
                if (Str::startsWith($constant, $starts_with)) {
                    $list[] = $value;
                }
            } else {
                $list[] = $value;
            }
        }

        return $list;
    }
}
