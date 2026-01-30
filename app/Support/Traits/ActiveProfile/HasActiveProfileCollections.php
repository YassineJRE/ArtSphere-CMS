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
 * Trait HasActiveProfileCollections
 *
 * Provides methods to check if certain models are part of the Active Profile's collections,
 * and to retrieve the associated CollectionItem for those models.
 */
trait HasActiveProfileCollections
{
    /**
     * Determine if the active profile has the given Exhibit in its collection.
     *
     * @param Exhibit|int $exhibit
     * @return bool
     */
    public function hasThisExhibitInCollection(Exhibit | int $exhibit): bool
    {
        return $this->activeProfile?->hasThisExhibitInCollection($exhibit) ?? false;
    }

    /**
     * Retrieve the collection item for the given Exhibit.
     *
     * @param Exhibit|int $exhibit
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisExhibit(Exhibit | int $exhibit): ?CollectionItem
    {
        return $this->activeProfile?->getCollectionItemForThisExhibit($exhibit);
    }

    /**
     * Determine if the active profile has the given Artwork in its collection.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function hasThisArtworkInCollection(Artwork | int $artwork): bool
    {
        return $this->activeProfile?->hasThisArtworkInCollection($artwork) ?? false;
    }

    /**
     * Retrieve the collection item for the given Artwork.
     *
     * @param Artwork|int $artwork
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisArtwork(Artwork | int $artwork): ?CollectionItem
    {
        return $this->activeProfile?->getCollectionItemForThisArtwork($artwork);
    }

    /**
     * Determine if the active profile has the given WebsiteGroup in its collection.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function hasThisWebsiteGroupInCollection(WebsiteGroup | int $websiteGroup): bool
    {
        return $this->activeProfile?->hasThisWebsiteGroupInCollection($websiteGroup) ?? false;
    }

    /**
     * Retrieve the collection item for the given WebsiteGroup.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisWebsiteGroup(WebsiteGroup | int $websiteGroup): ?CollectionItem
    {
        return $this->activeProfile?->getCollectionItemForThisWebsiteGroup($websiteGroup);
    }

    /**
     * Determine if the active profile has the given Website in its collection.
     *
     * @param Website|int $website
     * @return bool
     */
    public function hasThisWebsiteInCollection(Website | int $website): bool
    {
        return $this->activeProfile?->hasThisWebsiteInCollection($website) ?? false;
    }

    /**
     * Retrieve the collection item for the given Website.
     *
     * @param Website|int $website
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisWebsite(Website | int $website): ?CollectionItem
    {
        return $this->activeProfile?->getCollectionItemForThisWebsite($website);
    }

    /**
     * Determine if the active profile has the given Collection in its collection.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function hasThisCollectionInCollection(Collection | int $collection): bool
    {
        return $this->activeProfile?->hasThisCollectionInCollection($collection) ?? false;
    }

    /**
     * Retrieve the collection item for the given Collection.
     *
     * @param Collection|int $collection
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisCollection(Collection | int $collection): ?CollectionItem
    {
        return $this->activeProfile?->getCollectionItemForThisCollection($collection);
    }

    /**
     * Determine if the active profile has the given CollectionItem in its collection.
     *
     * @param CollectionItem|int $item
     * @return bool
     */
    public function hasThisCollectionItemInCollection(CollectionItem | int $item): bool
    {
        return $this->activeProfile?->hasThisCollectionItemInCollection($item) ?? false;
    }

    /**
     * Retrieve the collection item for the given CollectionItem.
     *
     * @param CollectionItem|int $item
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisCollectionItem(CollectionItem | int $item): ?CollectionItem
    {
        return $this->activeProfile?->getCollectionItemForThisCollectionItem($item);
    }

    /**
     * Determine if the active profile has the given UserProfile in its collection.
     *
     * @param UserProfile|int $userProfile
     * @return bool
     */
    public function hasThisProfileInCollection(UserProfile | int $userProfile): bool
    {
        return $this->activeProfile?->hasThisProfileInCollection($userProfile) ?? false;
    }

    /**
     * Retrieve the collection item for the given UserProfile.
     *
     * @param UserProfile|int $userProfile
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisProfile(UserProfile | int $userProfile): ?CollectionItem
    {
        return $this->activeProfile?->getCollectionItemForThisProfile($userProfile);
    }

    /**
     * Determine if the active profile has the given Group in its collection.
     *
     * @param Group|int $group
     * @return bool
     */
    public function hasThisGroupInCollection(Group | int $group): bool
    {
        return $this->activeProfile?->hasThisGroupInCollection($group) ?? false;
    }

    /**
     * Retrieve the collection item for the given Group.
     *
     * @param Group|int $group
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisGroup(Group | int $group): ?CollectionItem
    {
        return $this->activeProfile?->getCollectionItemForThisGroup($group);
    }

    /**
     * Get all collections for the current profile, optionally excluding one.
     *
     * @param Collection|int|null $collectionToRemove
     * @return SupportCollection
     */
    public function collections(Collection | int | null $collectionToRemove = null): SupportCollection
    {
        if ($this->activeProfile?->isGroup() || $this->activeProfile?->isProfile()) {
            return $this->activeProfile->collections->whereNotIn('id', match (true) {
                $collectionToRemove instanceof Collection => [$collectionToRemove->id],
                is_numeric($collectionToRemove) => [(int) $collectionToRemove],
                default => [],
            });
        }

        return collect();
    }
}
