<?php

namespace App\Models\Traits\Profile;

use App\Enums\Status as EnumStatus;

/**
 * Trait ProfileAccessors
 *
 * Provides accessor methods to check the status of the Profile
 * and retrieve specific profile-related attributes.
 */
trait ProfileAccessors
{
    /**
     * Determine if the profile is enabled.
     *
     * @return bool True if status is ENABLED, false otherwise.
     */
    public function isEnabled(): bool
    {
        return EnumStatus::ENABLED == $this->status;
    }

    /**
     * Determine if the profile is disabled.
     *
     * @return bool True if status is DISABLED, false otherwise.
     */
    public function isDisabled(): bool
    {
        return EnumStatus::DISABLED == $this->status;
    }

    /**
     * Determine if the profile is deleted.
     *
     * Checks if the status is DELETED or if the deleted_at timestamp is set.
     *
     * @return bool True if profile is deleted, false otherwise.
     */
    public function isDeleted(): bool
    {
        return EnumStatus::DELETED == $this->status || !is_null($this->deleted_at);
    }

    /**
     * Get the art practice type label for the profile.
     *
     * Returns a localized string for the art practice type or a specified custom type if applicable.
     *
     * @return string The art practice type label or an empty string if not set.
     */
    public function getArtPracticeType(): string
    {
        if ($this->art_practice_type) {
            return $this->hasArtPracticeTypeOther() ?
            ($this->specify_art_practice_type ?? '') :
            __('enums.art-practice-type.' . $this->art_practice_type);
        }

        return '';
    }
}
