<?php

namespace App\Support\Traits\ActiveProfile;

/**
 * Trait ActiveProfileAccessors
 *
 * Provides accessor methods to check the status of the Active Profile
 * and retrieve specific profile-related attributes.
 */
trait ActiveProfileAccessors
{
    /**
     * Get the active profile type as a class name.
     * Possible values: User::class, UserProfile::class, Group::class
     *
     * @return string|null
     */
    public function getProfileType(): string | null
    {
        return $this->activeProfile ? get_class($this->activeProfile) : null;
    }

    /**
     * Get the ID of the currently active profile.
     *
     * @return int|null
     */
    public function getProfileId(): int | null
    {
        return $this->activeProfile?->getKey();
    }

    /**
     * Get the first name of the active profile.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->activeProfile?->getFirstName() ?? '';
    }

    /**
     * Get the display name or full name of the active profile.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->activeProfile?->getName() ?? '';
    }

    /**
     * Get the email address associated with the active profile.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->activeProfile?->getEmail() ?? '';
    }
}
