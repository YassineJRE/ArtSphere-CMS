<?php

namespace App\Models\Traits\Group;

use App\Enums\MemberType as EnumMemberType;
use App\Models\Comment;
use App\Models\User;
use App\Models\UserHasGroup;
use App\Models\UserInvitation;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait GroupRelations
 *
 * Defines the Eloquent relationships for the Group model including comments,
 * members, administrators, guests, and invitations.
 */
trait GroupRelations
{
    /**
     * Get all comments written by this group (polymorphic).
     *
     * @return MorphMany<Comment>
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'writer')->orderBy('created_at', 'desc');
    }

    /**
     * Get the user profiles that are members of the group.
     *
     * @return BelongsToMany<UserProfile>
     */
    public function memberProfiles(): BelongsToMany
    {
        return $this->belongsToMany(UserProfile::class, 'user_has_groups', 'group_id', 'user_profile_id');
    }

    /**
     * Get the users that are members of the group.
     *
     * @return BelongsToMany<User>
     */
    public function memberUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_has_groups', 'group_id', 'user_id');
    }

    /**
     * Get the first user who is an administrator of the group.
     *
     * @return User|null
     */
    public function firstAdministrator(): ?User
    {
        return $this->memberUsers()->where('user_has_groups.role', EnumMemberType::ADMINISTRATOR)->first();
    }

    /**
     * Get all membership records (pivot model UserHasGroup) for the group.
     *
     * @return HasMany<UserHasGroup>
     */
    public function members(): HasMany
    {
        return $this->hasMany(UserHasGroup::class, 'group_id');
    }

    /**
     * Get all administrators of the group.
     *
     * @return HasMany<UserHasGroup>
     */
    public function administrators(): HasMany
    {
        return $this->members()->where('user_has_groups.role', EnumMemberType::ADMINISTRATOR);
    }

    /**
     * Get all guests (invitations) related to the group.
     *
     * @return MorphMany<UserInvitation>
     */
    public function guests(): MorphMany
    {
        return $this->morphMany(UserInvitation::class, 'subject');
    }

    /**
     * Get all unregistered guests (invitations with a non-empty token).
     *
     * @return MorphMany<UserInvitation>
     */
    public function unregisteredGuests(): MorphMany
    {
        return $this->guests()->whereNotNull('token')->where('token', '<>', '');
    }
}
