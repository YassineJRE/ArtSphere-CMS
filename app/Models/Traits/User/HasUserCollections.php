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

/**
 * Trait HasUserCollections
 *
 * Provides methods to check for existence of various models (Exhibit, Artwork, WebsiteGroup, etc.)
 * in the user's collection and to retrieve the corresponding CollectionItem.
 *
 * All methods currently return default values and should be overridden with actual logic
 * according to the application's requirements.
 *
 * @package App\Models\Traits\User
 */
trait HasUserCollections
{
    /**
     * Check if the user has the given Exhibit in their collection.
     *
     * @param Exhibit|int $exhibit
     * @return bool
     */
    public function hasThisExhibitInCollection(Exhibit | int $exhibit): bool
    {
        return false;
    }

    /**
     * Get the collection item associated with the given Exhibit for the user.
     *
     * @param Exhibit|int $exhibit
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisExhibit(Exhibit | int $exhibit): ?CollectionItem
    {
        return null;
    }

    /**
     * Check if the user has the given Artwork in their collection.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function hasThisArtworkInCollection(Artwork | int $artwork): bool
    {
        return false;
    }

    /**
     * Get the collection item associated with the given Artwork for the user.
     *
     * @param Artwork|int $artwork
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisArtwork(Artwork | int $artwork): ?CollectionItem
    {
        return null;
    }

    /**
     * Check if the user has the given WebsiteGroup in their collection.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function hasThisWebsiteGroupInCollection(WebsiteGroup | int $websiteGroup): bool
    {
        return false;
    }

    /**
     * Get the collection item associated with the given WebsiteGroup for the user.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisWebsiteGroup(WebsiteGroup | int $websiteGroup): ?CollectionItem
    {
        return null;
    }

    /**
     * Check if the user has the given Website in their collection.
     *
     * @param Website|int $website
     * @return bool
     */
    public function hasThisWebsiteInCollection(Website | int $website): bool
    {
        return false;
    }

    /**
     * Get the collection item associated with the given Website for the user.
     *
     * @param Website|int $website
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisWebsite(Website | int $website): ?CollectionItem
    {
        return null;
    }

    /**
     * Check if the user has the given Collection in their collection.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function hasThisCollectionInCollection(Collection | int $collection): bool
    {
        return false;
    }

    /**
     * Get the collection item associated with the given Collection for the user.
     *
     * @param Collection|int $collection
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisCollection(Collection | int $collection): ?CollectionItem
    {
        return null;
    }

    /**
     * Check if the user has the given CollectionItem in their collection.
     *
     * @param CollectionItem|int $item
     * @return bool
     */
    public function hasThisCollectionItemInCollection(CollectionItem | int $item): bool
    {
        return false;
    }

    /**
     * Get the collection item associated with the given CollectionItem for the user.
     *
     * @param CollectionItem|int $item
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisCollectionItem(CollectionItem | int $item): ?CollectionItem
    {
        return null;
    }

    /**
     * Check if the user has the given UserProfile in their collection.
     *
     * @param UserProfile|int $userProfile
     * @return bool
     */
    public function hasThisProfileInCollection(UserProfile | int $userProfile): bool
    {
        return false;
    }

    /**
     * Get the collection item associated with the given UserProfile for the user.
     *
     * @param UserProfile|int $userProfile
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisProfile(UserProfile | int $userProfile): ?CollectionItem
    {
        return null;
    }

    /**
     * Check if the user has the given Group in their collection.
     *
     * @param Group|int $group
     * @return bool
     */
    public function hasThisGroupInCollection(Group | int $group): bool
    {
        return false;
    }

    /**
     * Get the collection item associated with the given Group for the user.
     *
     * @param Group|int $group
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisGroup(Group | int $group): ?CollectionItem
    {
        return null;
    }
}
