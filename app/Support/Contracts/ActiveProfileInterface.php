<?php

namespace App\Support\Contracts;

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
 * Interface ActiveProfileInterface
 *
 * Represents the currently active actor (User, UserProfile, or Group)
 * operating on the platform. This abstraction allows the application
 * to treat different identity types uniformly across business logic.
 */
interface ActiveProfileInterface
{
    /**
     * Get the first name of the active profile.
     *
     * @return string
     */
    public function getFirstName(): string;

    /**
     * Get the display name or full name of the active profile.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the email address associated with the active profile.
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Get the active profile type as a class name.
     * Possible values: User::class, UserProfile::class, Group::class
     * @todo À implementer dans les classes
     * @return string|null
     */
    // public function getProfileType(): string | null;

    /**
     * Determine if the active profile is a UserProfile.
     *
     * @return bool
     */
    public function isProfile(): bool;

    /**
     * Determine if the active profile is a Group.
     *
     * @return bool
     */
    public function isGroup(): bool;

    /**
     * Determine if the active profile is a verified gallery group.
     * @todo À implementer dans les classes (à revoir)
     * @return bool
     */
    // public function isVerifiedGallery(): bool;

    /**
     * Get the ID of the currently active profile.
     * @todo À implementer dans les classes
     * @return int|null
     */
    // public function getProfileId(): int | null;

    /**
     * Determine if the active profile has the given Exhibit in its collection.
     *
     * @param Exhibit|int $exhibit
     * @return bool
     */
    public function hasThisExhibitInCollection(Exhibit | int $exhibit): bool;

    /**
     * Retrieve the collection item for the given Exhibit.
     *
     * @param Exhibit|int $exhibit
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisExhibit(Exhibit | int $exhibit): ?CollectionItem;

    /**
     * Determine if the active profile has the given Artwork in its collection.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function hasThisArtworkInCollection(Artwork | int $artwork): bool;

    /**
     * Retrieve the collection item for the given Artwork.
     *
     * @param Artwork|int $artwork
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisArtwork(Artwork | int $artwork): ?CollectionItem;

    /**
     * Determine if the active profile has the given WebsiteGroup in its collection.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function hasThisWebsiteGroupInCollection(WebsiteGroup | int $websiteGroup): bool;

    /**
     * Retrieve the collection item for the given WebsiteGroup.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisWebsiteGroup(WebsiteGroup | int $websiteGroup): ?CollectionItem;

    /**
     * Determine if the active profile has the given Website in its collection.
     *
     * @param Website|int $website
     * @return bool
     */
    public function hasThisWebsiteInCollection(Website | int $website): bool;

    /**
     * Retrieve the collection item for the given Website.
     *
     * @param Website|int $website
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisWebsite(Website | int $website): ?CollectionItem;

    /**
     * Determine if the active profile has the given Collection in its collection.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function hasThisCollectionInCollection(Collection | int $collection): bool;

    /**
     * Retrieve the collection item for the given Collection.
     *
     * @param Collection|int $collection
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisCollection(Collection | int $collection): ?CollectionItem;

    /**
     * Determine if the active profile has the given CollectionItem in its collection.
     *
     * @param CollectionItem|int $item
     * @return bool
     */
    public function hasThisCollectionItemInCollection(CollectionItem | int $item): bool;

    /**
     * Retrieve the collection item for the given CollectionItem.
     *
     * @param CollectionItem|int $item
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisCollectionItem(CollectionItem | int $item): ?CollectionItem;

    /**
     * Determine if the active profile has the given UserProfile in its collection.
     *
     * @param UserProfile|int $userProfile
     * @return bool
     */
    public function hasThisProfileInCollection(UserProfile | int $userProfile): bool;

    /**
     * Retrieve the collection item for the given UserProfile.
     *
     * @param UserProfile|int $userProfile
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisProfile(UserProfile | int $userProfile): ?CollectionItem;

    /**
     * Determine if the active profile has the given Group in its collection.
     *
     * @param Group|int $group
     * @return bool
     */
    public function hasThisGroupInCollection(Group | int $group): bool;

    /**
     * Retrieve the collection item for the given Group.
     *
     * @param Group|int $group
     * @return CollectionItem|null
     */
    public function getCollectionItemForThisGroup(Group | int $group): ?CollectionItem;

    /**
     * Get all collections for the current profile, optionally excluding one.
     *
     * @param Collection|int|null $collectionToRemove
     * @return SupportCollection
     * @todo Il faudrait renommer cette function pour l'utiliser
     */
    // public function collections(Collection | int | null $collectionToRemove = null): SupportCollection;

    /**
     * Check if this profile has removed the specified Exhibit from the database.
     *
     * @param Exhibit|int $exhibit
     * @return bool
     */
    public function hasRemovedThisExhibitFromDB(Exhibit | int $exhibit): bool;

    /**
     * Check if this profile has removed the specified Artwork from the database.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function hasRemovedThisArtworkFromDB(Artwork | int $artwork): bool;

    /**
     * Check if this profile has removed the specified WebsiteGroup from the database.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function hasRemovedThisWebsiteGroupFromDB(WebsiteGroup | int $websiteGroup): bool;

    /**
     * Check if this profile has removed the specified Website from the database.
     *
     * @param Website|int $website
     * @return bool
     */
    public function hasRemovedThisWebsiteFromDB(Website | int $website): bool;

    /**
     * Check if this profile has removed the specified Collection from the database.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function hasRemovedThisCollectionFromDB(Collection | int $collection): bool;

    /**
     * Check if this profile has removed the specified CollectionItem from the database.
     *
     * @param CollectionItem|int $collectionItem
     * @return bool
     */
    public function hasRemovedThisCollectionItemFromDB(CollectionItem | int $collectionItem): bool;

    /**
     * Check if this profile has removed the specified UserProfile from the database.
     *
     * @param UserProfile|int $profile
     * @return bool
     */
    public function hasRemovedThisProfileFromDB(UserProfile | int $profile): bool;

    /**
     * Check if this profile has removed the specified Group from the database.
     *
     * @param Group|int $group
     * @return bool
     */
    public function hasRemovedThisGroupFromDB(Group | int $group): bool;

    /**
     * Get all models that this profile has removed from the database.
     *
     * @return SupportCollection
     */
    public function getModelsRemovedFromDB(): SupportCollection;

    /**
     * Check if this profile is the owner of the given Exhibit.
     *
     * @param Exhibit|int|null $exhibit
     * @return bool
     */
    public function isOwnerOfThisExhibit(Exhibit | int | null $exhibit): bool;

    /**
     * Check if this profile is the owner of the given Artwork.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function isOwnerOfThisArtwork(Artwork | int $artwork): bool;

    /**
     * Check if this profile is the owner of the given WebsiteGroup.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function isOwnerOfThisWebsiteGroup(WebsiteGroup | int $websiteGroup): bool;

    /**
     * Check if this profile is the owner of the given Website.
     *
     * @param Website|int $website
     * @return bool
     */
    public function isOwnerOfThisWebsite(Website | int $website): bool;

    /**
     * Check if this profile is the owner of the given Collection.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function isOwnerOfThisCollection(Collection | int $collection): bool;

    /**
     * Check if the current user is a member of the given Group.
     *
     * @param Group|UserProfile|int $group
     * @return bool
     */
    public function isMemberOfThisGroup(Group | UserProfile | int $group): bool;

    /**
     * Check if the current user is an administrator of the given Group.
     *
     * @param Group|UserProfile|int $group
     * @return bool
     */
    public function isAdministratorOfThisGroup(Group | UserProfile | int $group): bool;
}
