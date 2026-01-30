<?php

namespace App\Support\Traits\ActiveProfile;

use App\Models\Artwork;
use App\Models\Collection;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;

/**
 * Trait ActiveProfileOwnership
 *
 * Provides methods to verify if the Active Profile owns certain models
 * or has specific roles (Member, Administrator) within groups.
 */
trait ActiveProfileOwnership
{
    /**
     * Check if the active profile is the owner of the given Exhibit.
     *
     * @param Exhibit|int|null $exhibit
     * @return bool
     */
    public function isOwnerOfThisExhibit(Exhibit | int | null $exhibit): bool
    {
        return $this->activeProfile?->isOwnerOfThisExhibit($exhibit) ?? false;
    }

    /**
     * Check if the active profile is the owner of the given Artwork.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function isOwnerOfThisArtwork(Artwork | int $artwork): bool
    {
        return $this->activeProfile?->isOwnerOfThisArtwork($artwork) ?? false;
    }

    /**
     * Check if the active profile is the owner of the given WebsiteGroup.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function isOwnerOfThisWebsiteGroup(WebsiteGroup | int $websiteGroup): bool
    {
        return $this->activeProfile?->isOwnerOfThisWebsiteGroup($websiteGroup) ?? false;
    }

    /**
     * Check if the active profile is the owner of the given Website.
     *
     * @param Website|int $website
     * @return bool
     */
    public function isOwnerOfThisWebsite(Website | int $website): bool
    {
        return $this->activeProfile?->isOwnerOfThisWebsite($website) ?? false;
    }

    /**
     * Check if the active profile is the owner of the given Collection.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function isOwnerOfThisCollection(Collection | int $collection): bool
    {
        return $this->activeProfile?->isOwnerOfThisCollection($collection) ?? false;
    }

    /**
     * Check if the active profile is a member of the given Group.
     *
     * @param Group|UserProfile|int $group
     * @return bool
     */
    public function isMemberOfThisGroup(Group | UserProfile | int $group): bool
    {
        return $this->activeProfile?->isMemberOfThisGroup($group) ?? false;
    }

    /**
     * Check if the active profile is an administrator of the given Group.
     *
     * @param Group|UserProfile|int $group
     * @return bool
     */
    public function isAdministratorOfThisGroup(Group | UserProfile | int $group): bool
    {
        return $this->activeProfile?->isAdministratorOfThisGroup($group) ?? false;
    }
}
