<?php

namespace App\Repositories\Web;

use App\Enums\ProfileType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SidebarRepository
{
    public static function getListProfiles(): array
    {
        $profileTypes = [];

        foreach (Auth::user()->profiles as $userProfile) {
            $profileTypes[$userProfile->id] = $userProfile->type;
        }

        $remainingProfileTypes = array_diff(ProfileType::list(), $profileTypes);

        return array_merge(array_flip($profileTypes), array_fill_keys($remainingProfileTypes, NULL));
    }
}
