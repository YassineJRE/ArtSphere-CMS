<?php

namespace App\Models\Traits\User;

use App\Enums\MemberType as EnumMemberType;
use App\Models\Artwork;
use App\Models\Collection;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;

/**
 * Trait UserOwnership
 *
 * Provides ownership and group relationship checks for the User model
 * regarding Exhibits, Artworks, Websites, Collections, and Groups.
 */
trait UserOwnership
{
    /**
     * Check if the User is the owner of the given Exhibit.
     *
     * @param Exhibit|int|null $exhibit
     * @return bool
     */
    public function isOwnerOfThisExhibit(Exhibit | int | null $exhibit): bool
    {
        return false;
    }

    /**
     * Check if the User is the owner of the given Artwork.
     *
     * @param Artwork|int $artwork
     * @return bool
     */
    public function isOwnerOfThisArtwork(Artwork | int $artwork): bool
    {
        return false;
    }

    /**
     * Check if the User is the owner of the given WebsiteGroup.
     *
     * @param WebsiteGroup|int $websiteGroup
     * @return bool
     */
    public function isOwnerOfThisWebsiteGroup(WebsiteGroup | int $websiteGroup): bool
    {
        return false;
    }

    /**
     * Check if the User is the owner of the given Website.
     *
     * @param Website|int $website
     * @return bool
     */
    public function isOwnerOfThisWebsite(Website | int $website): bool
    {
        return false;
    }

    /**
     * Check if the User is the owner of the given Collection.
     *
     * @param Collection|int $collection
     * @return bool
     */
    public function isOwnerOfThisCollection(Collection | int $collection): bool
    {
        return false;
    }

    /**
     * Determine if the User is a member of the given Group.
     *
     * @param Group|UserProfile|int $group
     *
     * @return bool True if the user is a member of the group, false otherwise.
     */
    public function isMemberOfThisGroup(Group | UserProfile | int $group): bool
    {
        if ($group instanceof UserProfile) {
            return false;
        }

        $groupId = $group instanceof Group ? $group->id : (is_numeric($group) ? (int) $group : null);

        if (!$groupId) {
            return false;
        }

        return $this->memberships()
            ->where('group_id', $groupId)
            ->where('role', EnumMemberType::MEMBER)
            ->exists();
    }

    /**
     * Determine if the User is an administrator of the given Group.
     *
     * @param Group|UserProfile|int $group Group instance, UserProfile instance or ID
     *
     * @return bool True if the user is an administrator of the group, false otherwise
     */
    public function isAdministratorOfThisGroup(Group | UserProfile | int $group): bool
    {
        if ($group instanceof UserProfile) {
            return false;
        }

        $groupId = $group instanceof Group ? $group->id : (is_numeric($group) ? (int) $group : null);

        if (!$groupId) {
            return false;
        }

        return $this->memberships()
            ->where('group_id', $groupId)
            ->where('role', EnumMemberType::ADMINISTRATOR)
            ->exists();
    }
}
