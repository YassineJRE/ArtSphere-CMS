<?php

namespace App\Models\Traits;

use App\Models\Group;
use App\Models\UserProfile;

trait OwnerProperties
{
    /**
     * Check if the owner is a UserProfile instance.
     *
     * @return bool True if the owner is a UserProfile, false otherwise.
     */
    public function belongsToProfile(): bool
    {
        return $this->owner_type === UserProfile::class;
    }

    /**
     * Check if the owner is a Group instance.
     *
     * @return bool True if the owner is a Group, false otherwise.
     */
    public function belongsToGroup(): bool
    {
        return $this->owner_type === Group::class;
    }

    /**
     * Check if the owner is a UserProfile and is an artist.
     *
     * @return bool True if the owner is an artist UserProfile, false otherwise.
     */
    public function belongsToArtistProfile(): bool
    {
        return $this->belongsToProfile() && $this->owner->isArtist();
    }

    /**
     * Check if the owner is a Group and is an artist group.
     *
     * @return bool True if the owner is an artist Group, false otherwise.
     */
    public function belongsToArtistGroup(): bool
    {
        return $this->belongsToGroup() && $this->owner->isArtist();
    }

    /**
     * Check if the owner is a UserProfile and is a curator.
     *
     * @return bool True if the owner is a curator UserProfile, false otherwise.
     */
    public function belongsToCuratorProfile(): bool
    {
        return $this->belongsToProfile() && $this->owner->isCurator();
    }

    /**
     * Check if the owner is a Group and is a curator group.
     *
     * @return bool True if the owner is a curator Group, false otherwise.
     */
    public function belongsToCuratorGroup(): bool
    {
        return $this->belongsToGroup() && $this->owner->isCurator();
    }

    /**
     * Check if the owner is a Group that is an artist-run center or organization.
     *
     * @return bool True if the owner is an artist-run center organisation, false otherwise.
     */
    public function belongsToGallery(): bool
    {
        return $this->belongsToGroup() && $this->owner->isArtistRunCenterOrganisation();
    }

    /**
     * Check if the owner is a UserProfile and is a public collector.
     *
     * @return bool True if the owner is a public collector UserProfile, false otherwise.
     */
    public function belongsToPublicCollector(): bool
    {
        return $this->belongsToProfile() && $this->owner->isPublicCollector();
    }
}
