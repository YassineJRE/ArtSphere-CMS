<?php

namespace App\Models\Traits\UserProfile;

use App\Enums\MemberType as EnumMemberType;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\UserProfile;

/**
 * Trait UserProfileHelpers
 *
 * Contains helper methods for UserProfile model.
 */
trait UserProfileHelpers
{
    /**
     * Check if this profile is the only profile of the account.
     *
     * @return bool
     */
    public function isTheOnlyProfile(): bool
    {
        return $this->user->profiles()->count() === 1;
    }

    /**
     * Determine if the profile is a member of the given group.
     *
     * @param Group|int $group The group instance or ID to check.
     * @return bool True if the profile belongs to the group, false otherwise.
     */
    public function isInGroup(Group | int $group): bool
    {
        $groupId = $group instanceof Group ? $group->id : $group;

        return $this->groups()
            ->where('groups.id', $groupId)
            ->exists();
    }

    /**
     * Determine if the profile is associated with the given exhibit.
     *
     * @param Exhibit|int $exhibit The exhibit instance or ID to check.
     * @return bool True if the profile has the exhibit, false otherwise.
     */
    public function hasExhibit(Exhibit | int $exhibit): bool
    {
        $exhibitId = $exhibit instanceof Exhibit ? $exhibit->id : $exhibit;

        return $this->exhibits->pluck('id')->contains($exhibitId);
    }

    /**
     * Determine if the Profile is a member of the given Group.
     *
     * @param Group|UserProfile|int $group
     *
     * @return bool
     */
    public function isMemberOfThisGroup(Group | UserProfile | int $group): bool
    {
        if ($group instanceof UserProfile) {
            return false;
        }

        $groupId = is_numeric($group) ? (int) $group : $group->id ?? null;

        if (!$groupId) {
            return false;
        }

        return $this->memberships()
            ->where('group_id', $groupId)
            ->where('role', EnumMemberType::MEMBER)
            ->exists();
    }

    /**
     * Verify if this Profile is Administrator of this Group.
     *
     * @param Group|UserProfile|int $group Group instance, UserProfile instance or ID
     *
     * @return bool True if this profile is an administrator of the group, false otherwise
     */
    public function isAdministratorOfThisGroup(Group | UserProfile | int $group): bool
    {
        if ($group instanceof UserProfile) {
            return false;
        }

        $groupId = is_numeric($group) ? (int) $group : $group->id ?? null;

        if (!$groupId) {
            return false;
        }

        return $this->memberships()
            ->where('group_id', $groupId)
            ->where('role', EnumMemberType::ADMINISTRATOR)
            ->exists();
    }
}
