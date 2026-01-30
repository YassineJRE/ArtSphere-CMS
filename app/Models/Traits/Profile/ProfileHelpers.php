<?php

namespace App\Models\Traits\Profile;

use App\Enums\ArtPracticeType as EnumArtPracticeType;
use App\Models\Group;
use App\Models\UserProfile;

/**
 * Trait ProfileHelpers
 *
 * Provides helper methods to identify profile types and roles,
 * and to check permissions related to Profiles and Groups.
 */
trait ProfileHelpers
{
    /**
     * Determine if the current instance is a Group.
     *
     * @return bool True if instance is a Group, false otherwise.
     */
    public function isGroup(): bool
    {
        return self::class == Group::class;
    }

    /**
     * Determine if the current instance is a UserProfile.
     *
     * @return bool True if instance is a UserProfile, false otherwise.
     */
    public function isProfile(): bool
    {
        return self::class == UserProfile::class;
    }

    /**
     * Determine if this Group is a gallery (Artist-Run Center Organisation).
     *
     * @return bool True if this is a gallery, false otherwise.
     */
    public function isGallery(): bool
    {
        return $this->isGroup() && $this->isArtistRunCenterOrganisation();
    }

    /**
     * Determine if this Profile is a curator profile.
     *
     * @return bool True if this is a curator profile, false otherwise.
     */
    public function isCuratorProfile(): bool
    {
        return $this->isProfile() && $this->isCurator();
    }

    /**
     * Determine if this Group is a curator group.
     *
     * @return bool True if this is a curator group, false otherwise.
     */
    public function isCuratorGroup(): bool
    {
        return $this->isGroup() && $this->isCurator();
    }

    /**
     * Check if the profile or group can transfer exhibits.
     *
     * @return bool True if can transfer, false otherwise.
     */
    public function canTransferExhibit(): bool
    {
        return
        $this->isGallery()
        ||
        $this->isCuratorProfile()
        ||
        $this->isCuratorGroup();
    }

    /**
     * Check if the art practice type is 'Other'.
     *
     * @return bool True if art practice type is OTHER, false otherwise.
     */
    public function hasArtPracticeTypeOther(): bool
    {
        return EnumArtPracticeType::OTHER == $this->art_practice_type;
    }
}
