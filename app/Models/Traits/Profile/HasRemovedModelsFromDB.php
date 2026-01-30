<?php

namespace App\Models\Traits\Profile;

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
 * for the Profile.
 */
trait HasRemovedModelsFromDB
{
    /**
     * Verify if this Profile has removed this Exhibit from Database.
     *
     * @param int|Exhibit $exhibit
     *
     * @return bool
     */
    public function hasRemovedThisExhibitFromDB(Exhibit | int $exhibit): bool
    {
        $exhibitId = is_object($exhibit) ? $exhibit->id : $exhibit;

        return $this->modelsRemovedFromDB()
            ->where('model_type', Exhibit::class)
            ->where('model_id', $exhibitId)
            ->exists();
    }

    /**
     * Verify if this Profile has removed this Artwork from Database.
     *
     * @param int|Artwork $artwork
     *
     * @return bool
     */
    public function hasRemovedThisArtworkFromDB(Artwork | int $artwork): bool
    {
        $artworkId = is_object($artwork) ? $artwork->id : $artwork;

        return $this->modelsRemovedFromDB()
            ->where('model_type', Artwork::class)
            ->where('model_id', $artworkId)
            ->exists();
    }

    /**
     * Verify if this Profile has removed this WebsiteGroup from Database.
     *
     * @param int|WebsiteGroup $websiteGroup
     *
     * @return bool
     */
    public function hasRemovedThisWebsiteGroupFromDB(WebsiteGroup | int $websiteGroup): bool
    {
        $websiteGroupId = is_object($websiteGroup) ? $websiteGroup->id : $websiteGroup;

        return $this->modelsRemovedFromDB()
            ->where('model_type', WebsiteGroup::class)
            ->where('model_id', $websiteGroupId)
            ->exists();
    }

    /**
     * Verify if this Profile has removed this Website from Database.
     *
     * @param int|Website $website
     *
     * @return bool
     */
    public function hasRemovedThisWebsiteFromDB(Website | int $website): bool
    {
        $websiteId = is_object($website) ? $website->id : $website;

        return $this->modelsRemovedFromDB()
            ->where('model_type', Website::class)
            ->where('model_id', $websiteId)
            ->exists();
    }

    /**
     * Verify if this Profile has removed this Collection from Database.
     *
     * @param int|Collection $collection
     *
     * @return bool
     */
    public function hasRemovedThisCollectionFromDB(Collection | int $collection): bool
    {
        $collectionId = is_object($collection) ? $collection->id : $collection;

        return $this->modelsRemovedFromDB()
            ->where('model_type', Collection::class)
            ->where('model_id', $collectionId)
            ->exists();
    }

    /**
     * Verify if this Profile has removed this CollectionItem from Database.
     *
     * @param int|CollectionItem $collectionItem
     *
     * @return bool
     */
    public function hasRemovedThisCollectionItemFromDB(CollectionItem | int $collectionItem): bool
    {
        $collectionItemId = is_object($collectionItem) ? $collectionItem->id : $collectionItem;

        return $this->modelsRemovedFromDB()
            ->where('model_type', CollectionItem::class)
            ->where('model_id', $collectionItemId)
            ->exists();
    }

    /**
     * Verify if this Profile has removed this UserProfile from Database.
     *
     * @param int|UserProfile $profile
     *
     * @return bool
     */
    public function hasRemovedThisProfileFromDB(UserProfile | int $profile): bool
    {
        $profileId = is_object($profile) ? $profile->id : $profile;

        return $this->modelsRemovedFromDB()
            ->where('model_type', UserProfile::class)
            ->where('model_id', $profileId)
            ->exists();
    }

    /**
     * Verify if this Profile has removed this Group from Database.
     *
     * @param int|Group $group
     *
     * @return bool
     */
    public function hasRemovedThisGroupFromDB(Group | int $group): bool
    {
        $groupId = is_object($group) ? $group->id : $group;

        return $this->modelsRemovedFromDB()
            ->where('model_type', Group::class)
            ->where('model_id', $groupId)
            ->exists();
    }

    /**
     * Get all models that this profile has removed from the database.
     *
     * @return SupportCollection
     */
    public function getModelsRemovedFromDB(): SupportCollection
    {
        return $this->modelsRemovedFromDB;
    }
}
