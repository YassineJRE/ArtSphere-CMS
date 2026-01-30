<?php

namespace App\Support\Traits\ActiveProfile;

use App\Models\Group;
use App\Models\User;
use App\Models\UserProfile;

/**
 * Trait ActiveProfileHelpers
 *
 * Provides helper methods to identify profile types and roles,
 * and to check permissions related to Profiles and Groups.
 */
trait ActiveProfileHelpers
{
    /**
     * Determine if the active profile is a UserProfile.
     *
     * @return bool
     */
    public function isProfile(): bool
    {
        return $this->activeProfile instanceof UserProfile;
    }

    /**
     * Determine if the active profile is a Group.
     *
     * @return bool
     */
    public function isGroup(): bool
    {
        return $this->activeProfile instanceof Group;
    }

    /**
     * Check whether the given profile is the currently active one.
     *
     * @param User|UserProfile|Group $profile
     * @return bool
     */
    public function is(User | UserProfile | Group $profile): bool
    {
        if ($this->activeProfile === null) {
            return false;
        }
        return $this->activeProfile->getKey() === $profile->getKey()
        && get_class($this->activeProfile) === get_class($profile);
    }

    /**
     * Determine if the active profile is a verified gallery group.
     *
     * @return bool
     */
    public function isVerifiedGallery(): bool
    {
        return $this->activeProfile !== null
        && method_exists($this->activeProfile, 'isVerifiedGallery')
        && $this->activeProfile->isVerifiedGallery();
    }
}
