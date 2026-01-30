<?php

namespace App\Models\Traits\User;

use App\Enums\ProfileType;
use App\Enums\Status;
use App\Models\Group;
use App\Models\UserProfile;
use Illuminate\Support\Str;

/**
 * Trait UserAccessors
 *
 * Provides accessor methods and status checks for the User model,
 * including retrieving user names, profile types, email and password presence,
 * account status flags, and group membership verification.
 *
 * These methods facilitate easy access to common user-related data and states.
 */
trait UserAccessors
{
    /**
     * Get the email address of User.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get a default slugified name for the user based on their first name or ID.
     *
     * @return string
     */
    public function getDefaultName(): string
    {
        return Str::slug($this->first_name, '-') ?? $this->id;
    }

    /**
     * Get a default filename for the user, typically for profile images.
     *
     * @return string
     */
    public function getDefaultFileName(): string
    {
        return "{$this->getDefaultName()}.jpg";
    }

    /**
     * Determine if the user has any verified profiles.
     *
     * @return bool True if at least one profile exists.
     */
    public function hasVerifiedProfile(): bool
    {
        return $this->profiles()->exists();
    }

    /**
     * Check if the user has an email address set.
     *
     * @return bool
     */
    public function hasEmail(): bool
    {
        return !empty($this->email);
    }

    /**
     * Check if the user has both first and last names set.
     *
     * @return bool
     */
    public function hasName(): bool
    {
        return !empty($this->first_name) && !empty($this->last_name);
    }

    /**
     * Check if the user has a password set.
     *
     * @return bool
     */
    public function hasPassword(): bool
    {
        return !empty($this->password);
    }

    /**
     * Placeholder to check if the user has an attachment.
     *
     * @return bool Always returns true (override as needed).
     */
    public function hasAttachment(): bool
    {
        return true;
    }

    /**
     * Determine if the user requires an active admin account.
     *
     * @return bool True if the user can access admin but does not have a verified email.
     */
    public function needsActiveAdminAccount(): bool
    {
        return $this->canAccessAdmin() && !$this->hasVerifiedEmail();
    }

    /**
     * Check if the user has permission to access the admin panel.
     *
     * @return bool
     */
    public function canAccessAdmin(): bool
    {
        return 1 == $this->can_access_admin;
    }

    /**
     * Get the display name of the user by combining first and last name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * Get the user's first name.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * Get the user's last name.
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * Check if the user's password is empty or null.
     *
     * @return bool
     */
    public function passwordIsEmpty(): bool
    {
        return $this->password === '' || $this->password === null;
    }

    /**
     * Check if the user's status is enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return Status::ENABLED == $this->status;
    }

    /**
     * Check if the user is banned.
     *
     * @return bool
     */
    public function isBanned(): bool
    {
        return Status::BANNED == $this->status;
    }

    /**
     * Check if the user is disabled.
     *
     * @return bool
     */
    public function isDisabled(): bool
    {
        return Status::DISABLED == $this->status;
    }

    /**
     * Check if the user is deleted.
     *
     * @return bool
     */
    public function isDeleted(): bool
    {
        return Status::DELETED == $this->status;
    }

    /**
     * Check if the user is pending activation.
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return Status::PENDING == $this->status;
    }

    /**
     * Check if the user is pending consent.
     *
     * @return bool
     */
    public function isPendingConsent(): bool
    {
        return Status::PENDING_CONSENT == $this->status;
    }

    /**
     * Check if the user has any profiles.
     *
     * @return bool True if the user has at least one profile.
     */
    public function hasProfile(): bool
    {
        return $this->profiles->count() > 0;
    }

    /**
     * Get the user's profile of type Artist.
     *
     * @return UserProfile|null
     */
    public function profileArtist(): UserProfile | null
    {
        return $this->profiles()->where('type', ProfileType::ARTIST)->first();
    }

    /**
     * Check if the user has an Artist profile.
     *
     * @return bool
     */
    public function hasProfileArtist(): bool
    {
        return $this->profiles()->where('type', ProfileType::ARTIST)->exists();
    }

    /**
     * Get the user's profile of type Curator.
     *
     * @return UserProfile|null
     */
    public function profileCurator(): UserProfile | null
    {
        return $this->profiles()->where('type', ProfileType::CURATOR)->first();
    }

    /**
     * Check if the user has a Curator profile.
     *
     * @return bool
     */
    public function hasProfileCurator(): bool
    {
        return $this->profiles()->where('type', ProfileType::CURATOR)->exists();
    }

    /**
     * Get the user's profile of type Public Collector.
     *
     * @return UserProfile|null
     */
    public function profilePublicCollector(): UserProfile | null
    {
        return $this->profiles()->where('type', ProfileType::PUBLIC_COLLECTOR)->first();
    }

    /**
     * Check if the user has a Public Collector profile.
     *
     * @return bool
     */
    public function hasProfilePublicCollector(): bool
    {
        return $this->profiles()->where('type', ProfileType::PUBLIC_COLLECTOR)->exists();
    }

    /**
     * Determine if the user is in the specified group.
     *
     * @param int|Group $group The group instance or its ID.
     * @return bool True if the user belongs to the group.
     */
    public function isInGroup(Group | int $group): bool
    {
        $groupId = $group instanceof Group ? $group->id : $group;

        return $this->groups()
            ->where('groups.id', $groupId)
            ->exists();
    }

    /**
     * Determine if the user owns the specified profile.
     *
     * @param int|UserProfile $profile The profile instance or its ID.
     * @return bool True if the user owns the profile.
     */
    public function ownsProfile(UserProfile | int $profile): bool
    {
        $profileId = $profile instanceof UserProfile ? $profile->id : $profile;

        return $this->profiles()->where('id', $profileId)->exists();
    }
}
