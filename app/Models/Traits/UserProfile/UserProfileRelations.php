<?php

namespace App\Models\Traits\UserProfile;

use App\Models\Comment;
use App\Models\Group;
use App\Models\User;
use App\Models\UserHasGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait UserProfileRelations
 *
 * Contains Eloquent relationship methods for UserProfile model.
 */
trait UserProfileRelations
{
    /**
     * Get all of the comments for the profile.
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'writer')->orderBy('created_at', 'desc');
    }

    /**
     * Get all of the memberships for the profile.
     *
     * @return HasMany
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(UserHasGroup::class, 'user_profile_id');
    }

    /**
     * Get all of the groups for the user profile.
     *
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_has_groups', 'user_profile_id', 'group_id');
    }

    /**
     * Get the user that owns the UserProfile.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
