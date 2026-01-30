<?php

namespace App\Support\Traits\ActiveProfile;

use App\Models\Artwork;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Trait HasRemovedModelsFromDB
 *
 * Provides methods to check if certain models have been removed from the database
 * for the Active Profile.
 */
trait HasRemovedModelsFromDB
{
    /**
     * Check if this profile has removed the specified Exhibit from the database.
     *
     * @param Exhibit|int $exhibit
     * @return bool
     */
    public function hasRemovedThisExhibitFromDB(Exhibit | int $exhibit): bool
    {
        return $this->activeProfile?->hasRemovedThisExhibitFromDB($exhibit) ?? false;
    }

    /**
     * Check if this profile has removed the specified Artwork from the database.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function hasRemovedThisArtworkFromDB(Artwork | int $artwork): bool
    {
        return $this->activeProfile?->hasRemovedThisArtworkFromDB($artwork) ?? false;
    }

    /**
     * Check if this profile has removed the specified WebsiteGroup from the database.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function hasRemovedThisWebsiteGroupFromDB(WebsiteGroup | int $websiteGroup): bool
    {
        return $this->activeProfile?->hasRemovedThisWebsiteGroupFromDB($websiteGroup) ?? false;
    }

    /**
     * Check if this profile has removed the specified Website from the database.
     *
     * @param Website|int $website
     * @return bool
     */
    public function hasRemovedThisWebsiteFromDB(Website | int $website): bool
    {
        return $this->activeProfile?->hasRemovedThisWebsiteFromDB($website) ?? false;
    }

    /**
     * Check if this profile has removed the specified Collection from the database.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function hasRemovedThisCollectionFromDB(Collection | int $collection): bool
    {
        return $this->activeProfile?->hasRemovedThisCollectionFromDB($collection) ?? false;
    }

    /**
     * Check if this profile has removed the specified CollectionItem from the database.
     *
     * @param CollectionItem|int $collectionItem
     * @return bool
     */
    public function hasRemovedThisCollectionItemFromDB(CollectionItem | int $collectionItem): bool
    {
        return $this->activeProfile?->hasRemovedThisCollectionItemFromDB($collectionItem) ?? false;
    }

    /**
     * Check if this profile has removed the specified UserProfile from the database.
     *
     * @param UserProfile|int $profile
     * @return bool
     */
    public function hasRemovedThisProfileFromDB(UserProfile | int $profile): bool
    {
        return $this->activeProfile?->hasRemovedThisProfileFromDB($profile) ?? false;
    }

    /**
     * Check if this profile has removed the specified Group from the database.
     *
     * @param Group|int $group
     * @return bool
     */
    public function hasRemovedThisGroupFromDB(Group | int $group): bool
    {
        return $this->activeProfile?->hasRemovedThisGroupFromDB($group) ?? false;
    }

    /**
     * Get all models that this profile has removed from the database.
     *
     * @return SupportCollection
     */
    public function getModelsRemovedFromDB(): SupportCollection
    {
        return $this->activeProfile?->getModelsRemovedFromDB() ?? collect([]);
    }
}
