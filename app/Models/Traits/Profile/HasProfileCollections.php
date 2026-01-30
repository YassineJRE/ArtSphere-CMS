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

/**
 * Trait HasProfileCollections
 *
 * Provides methods to check if certain models are part of the Profile's collections,
 * and to retrieve the associated CollectionItem for those models.
 */
trait HasProfileCollections
{
    /**
     * Check if this Profile has the specified Exhibit in their collections.
     *
     * @param int|Exhibit $exhibit Exhibit instance or ID
     *
     * @return bool True if present in collections, false otherwise
     */
    public function hasThisExhibitInCollection(Exhibit | int $exhibit): bool
    {
        $exhibitId = is_object($exhibit) ? $exhibit->id : $exhibit;

        return $this->collectionItems()
            ->where('model_type', Exhibit::class)
            ->where('model_id', $exhibitId)
            ->exists();
    }

    /**
     * Get the CollectionItem associated with the specified Exhibit.
     *
     * @param int|Exhibit $exhibit Exhibit instance or ID
     *
     * @return CollectionItem|null The matching CollectionItem or null if none found
     */
    public function getCollectionItemForThisExhibit(Exhibit | int $exhibit): ?CollectionItem
    {
        $exhibitId = is_object($exhibit) ? $exhibit->id : $exhibit;

        return $this->collectionItems()
            ->where('model_type', Exhibit::class)
            ->where('model_id', $exhibitId)
            ->first();
    }

    /**
     * Check if this Profile has the specified Artwork in their collections.
     *
     * @param int|Artwork $artwork Artwork instance or ID
     *
     * @return bool True if present in collections, false otherwise
     */
    public function hasThisArtworkInCollection(Artwork | int $artwork): bool
    {
        $artworkId = is_object($artwork) ? $artwork->id : $artwork;

        return $this->collectionItems()
            ->where('model_type', Artwork::class)
            ->where('model_id', $artworkId)
            ->exists();
    }

    /**
     * Get the CollectionItem associated with the specified Artwork.
     *
     * @param int|Artwork $artwork Artwork instance or ID
     *
     * @return CollectionItem|null The matching CollectionItem or null if none found
     */
    public function getCollectionItemForThisArtwork(Artwork | int $artwork): ?CollectionItem
    {
        $artworkId = is_object($artwork) ? $artwork->id : $artwork;

        return $this->collectionItems()
            ->where('model_type', Artwork::class)
            ->where('model_id', $artworkId)
            ->first();
    }

    /**
     * Check if this Profile has the specified WebsiteGroup in their collections.
     *
     * @param int|WebsiteGroup $websiteGroup WebsiteGroup instance or ID
     *
     * @return bool True if present in collections, false otherwise
     */
    public function hasThisWebsiteGroupInCollection(WebsiteGroup | int $websiteGroup): bool
    {
        $websiteGroupId = is_object($websiteGroup) ? $websiteGroup->id : $websiteGroup;

        return $this->collectionItems()
            ->where('model_type', WebsiteGroup::class)
            ->where('model_id', $websiteGroupId)
            ->exists();
    }

    /**
     * Get the CollectionItem associated with the specified WebsiteGroup.
     *
     * @param int|WebsiteGroup $websiteGroup WebsiteGroup instance or ID
     *
     * @return CollectionItem|null The matching CollectionItem or null if none found
     */
    public function getCollectionItemForThisWebsiteGroup(WebsiteGroup | int $websiteGroup): ?CollectionItem
    {
        $websiteGroupId = is_object($websiteGroup) ? $websiteGroup->id : $websiteGroup;

        return $this->collectionItems()
            ->where('model_type', WebsiteGroup::class)
            ->where('model_id', $websiteGroupId)
            ->first();
    }

    /**
     * Check if this Profile has the specified Website in their collections.
     *
     * @param int|Website $website Website instance or ID
     *
     * @return bool True if present in collections, false otherwise
     */
    public function hasThisWebsiteInCollection(Website | int $website): bool
    {
        $websiteId = is_object($website) ? $website->id : $website;

        return $this->collectionItems()
            ->where('model_type', Website::class)
            ->where('model_id', $websiteId)
            ->exists();
    }

    /**
     * Get the CollectionItem associated with the specified Website.
     *
     * @param int|Website $website Website instance or ID
     *
     * @return CollectionItem|null The matching CollectionItem or null if none found
     */
    public function getCollectionItemForThisWebsite(Website | int $website): ?CollectionItem
    {
        $websiteId = is_object($website) ? $website->id : $website;

        return $this->collectionItems()
            ->where('model_type', Website::class)
            ->where('model_id', $websiteId)
            ->first();
    }

    /**
     * Check if this Profile has the specified Collection in their collections.
     *
     * @param int|Collection $collection Collection instance or ID
     *
     * @return bool True if present in collections, false otherwise
     */
    public function hasThisCollectionInCollection(Collection | int $collection): bool
    {
        $collectionId = is_object($collection) ? $collection->id : $collection;

        return $this->collectionItems()
            ->where('model_type', Collection::class)
            ->where('model_id', $collectionId)
            ->exists();
    }

    /**
     * Get the CollectionItem associated with the specified Collection.
     *
     * @param int|Collection $collection Collection instance or ID
     *
     * @return CollectionItem|null The matching CollectionItem or null if none found
     */
    public function getCollectionItemForThisCollection(Collection | int $collection): ?CollectionItem
    {
        $collectionId = is_object($collection) ? $collection->id : $collection;

        return $this->collectionItems()
            ->where('model_type', Collection::class)
            ->where('model_id', $collectionId)
            ->first();
    }

    /**
     * Check if this Profile has the specified CollectionItem in their collections.
     *
     * @param int|CollectionItem $item CollectionItem instance or ID
     *
     * @return bool True if present in collections, false otherwise
     */
    public function hasThisCollectionItemInCollection(CollectionItem | int $item): bool
    {
        $itemId = is_object($item) ? $item->id : $item;

        return $this->collectionItems()
            ->where('model_type', CollectionItem::class)
            ->where('model_id', $itemId)
            ->exists();
    }

    /**
     * Get the CollectionItem associated with the specified CollectionItem.
     *
     * @param int|CollectionItem $item CollectionItem instance or ID
     *
     * @return CollectionItem|null The matching CollectionItem or null if none found
     */
    public function getCollectionItemForThisCollectionItem(CollectionItem | int $item): ?CollectionItem
    {
        $itemId = is_object($item) ? $item->id : $item;

        return $this->collectionItems()
            ->where('model_type', CollectionItem::class)
            ->where('model_id', $itemId)
            ->first();
    }

    /**
     * Check if this Profile has the specified UserProfile in their collections.
     *
     * @param int|UserProfile $userProfile UserProfile instance or ID
     *
     * @return bool True if present in collections, false otherwise
     */
    public function hasThisProfileInCollection(UserProfile | int $userProfile): bool
    {
        $profileId = is_object($userProfile) ? $userProfile->id : $userProfile;

        return $this->collectionItems()
            ->where('model_type', UserProfile::class)
            ->where('model_id', $profileId)
            ->exists();
    }

    /**
     * Get the CollectionItem associated with the specified UserProfile.
     *
     * @param int|UserProfile $userProfile UserProfile instance or ID
     *
     * @return CollectionItem|null The matching CollectionItem or null if none found
     */
    public function getCollectionItemForThisProfile(UserProfile | int $userProfile): ?CollectionItem
    {
        $profileId = is_object($userProfile) ? $userProfile->id : $userProfile;

        return $this->collectionItems()
            ->where('model_type', UserProfile::class)
            ->where('model_id', $profileId)
            ->first();
    }

    /**
     * Check if this Profile has the specified Group in their collections.
     *
     * @param int|Group $group Group instance or ID
     *
     * @return bool True if present in collections, false otherwise
     */
    public function hasThisGroupInCollection(Group | int $group): bool
    {
        $groupId = is_object($group) ? $group->id : $group;

        return $this->collectionItems()
            ->where('model_type', Group::class)
            ->where('model_id', $groupId)
            ->exists();
    }

    /**
     * Get the CollectionItem associated with the specified Group.
     *
     * @param int|Group $group Group instance or ID
     *
     * @return CollectionItem|null The matching CollectionItem or null if none found
     */
    public function getCollectionItemForThisGroup(Group | int $group): ?CollectionItem
    {
        $groupId = is_object($group) ? $group->id : $group;

        return $this->collectionItems()
            ->where('model_type', Group::class)
            ->where('model_id', $groupId)
            ->first();
    }
}
