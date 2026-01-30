<?php

namespace App\Models\Traits\Group;

use App\Models\Group;
use App\Models\UserProfile;

/**
 * Trait GroupHelpers
 *
 * Provides helper methods for the Group model to check notification capability,
 * administrator count, and status change permissions.
 */
trait GroupHelpers
{
    /**
     * Determine if the group is notifiable.
     *
     * A group is notifiable if it is an Artist Run Center Organisation and has an email address.
     *
     * @return bool True if notifiable, false otherwise.
     */
    public function isNotifiable(): bool
    {
        return $this->isArtistRunCenterOrganisation() && !is_null($this->email);
    }

    /**
     * Check if the group has more than one administrator.
     *
     * @return bool True if more than one administrator exists, false otherwise.
     */
    public function hasMoreThanOneAdministrator(): bool
    {
        return $this->administrators->count() > 1;
    }

    /**
     * Determine if the status of the group can be changed.
     *
     * The status can be changed only if the group is not awaiting approval and not deleted.
     *
     * @return bool True if the status can be changed, false otherwise.
     */
    public function canChangeStatus(): bool
    {
        return !$this->isAwaitingApproval() && !$this->isDeleted();
    }

    /**
     * Determine if the Group is a member of the given Group.
     *
     * @param Group|UserProfile|int $group
     *
     * @return bool
     */
    public function isMemberOfThisGroup(Group | UserProfile | int $group): bool
    {
        return false;
    }

    /**
     * Verify if this Group is Administrator of this Group.
     *
     * @param Group|UserProfile|int $group
     *
     * @return bool
     */
    public function isAdministratorOfThisGroup(Group | UserProfile | int $group): bool
    {
        return false;
    }
}
