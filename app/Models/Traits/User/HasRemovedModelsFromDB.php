<?php

namespace App\Models\Traits\User;

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
 * Provides stub methods to check if specific models have been marked as removed from the database by the user.
 * Currently always returns false.
 */
trait HasRemovedModelsFromDB
{
    /**
     * Check if the user has removed the given Exhibit from the database.
     *
     * @param Exhibit|int $exhibit
     * @return bool
     */
    public function hasRemovedThisExhibitFromDB(Exhibit | int $exhibit): bool
    {
        return false;
    }

    /**
     * Check if the user has removed the given Artwork from the database.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function hasRemovedThisArtworkFromDB(Artwork | int $artwork): bool
    {
        return false;
    }

    /**
     * Check if the user has removed the given Collection from the database.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function hasRemovedThisCollectionFromDB(Collection | int $collection): bool
    {
        return false;
    }

    /**
     * Check if the user has removed the given CollectionItem from the database.
     *
     * @param CollectionItem|int $item
     * @return bool
     */
    public function hasRemovedThisCollectionItemFromDB(CollectionItem | int $item): bool
    {
        return false;
    }

    /**
     * Check if the user has removed the given Website from the database.
     *
     * @param Website|int $website
     * @return bool
     */
    public function hasRemovedThisWebsiteFromDB(Website | int $website): bool
    {
        return false;
    }

    /**
     * Check if the user has removed the given WebsiteGroup from the database.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function hasRemovedThisWebsiteGroupFromDB(WebsiteGroup | int $websiteGroup): bool
    {
        return false;
    }

    /**
     * Check if the user has removed the given UserProfile from the database.
     *
     * @param UserProfile|int $profile
     * @return bool
     */
    public function hasRemovedThisProfileFromDB(UserProfile | int $profile): bool
    {
        return false;
    }

    /**
     * Check if the user has removed the given Group from the database.
     *
     * @param Group|int $group
     * @return bool
     */
    public function hasRemovedThisGroupFromDB(Group | int $group): bool
    {
        return false;
    }

    /**
     * Get all models that this user has removed from the database.
     *
     * @return SupportCollection
     */
    public function getModelsRemovedFromDB(): SupportCollection
    {
        return $this->modelsRemovedFromDB;
    }
}
