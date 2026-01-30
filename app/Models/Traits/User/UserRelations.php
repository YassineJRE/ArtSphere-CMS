<?php

namespace App\Models\Traits\User;

use App\Models\Group;
use App\Models\RemoveFromDB;
use App\Models\UserHasGroup;
use App\Models\UserInvitation;
use App\Models\UserNotification;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait UserRelations
 *
 * Defines relationships between the User model and other related models.
 */
trait UserRelations
{
    /**
     * Get all of the notifications for the User.
     *
     * @return HasMany
     */
    public function user_notifications(): HasMany
    {
        return $this->hasMany(UserNotification::class, 'user_id');
    }

    /**
     * Get all of the profiles for the User.
     *
     * @return HasMany
     */
    public function profiles(): HasMany
    {
        return $this->hasMany(UserProfile::class, 'user_id');
    }

    /**
     * Get all of the invitations for the User.
     *
     * @return HasMany
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(UserInvitation::class, 'guest_id');
    }

    /**
     * Get all of the memberships for the User.
     *
     * @return HasMany
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(UserHasGroup::class, 'user_id');
    }

    /**
     * Get all of the groups for the User.
     *
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_has_groups', 'user_id', 'group_id')
            ->whereNull('user_has_groups.deleted_at')
            ->whereNull('groups.deleted_at');
    }

    /**
     * Get all of the modelsRemovedFromDB for this User.
     *
     * @return MorphMany
     */
    public function modelsRemovedFromDB(): MorphMany
    {
        return $this->morphMany(RemoveFromDB::class, 'owner');
    }
}
