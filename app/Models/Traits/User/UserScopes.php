<?php

namespace App\Models\Traits\User;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait UserScopes
 *
 * Provides query scopes for filtering users by their status or roles.
 */
trait UserScopes
{
    /**
     * Scope a query to only include admin users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdmin(Builder $query): Builder
    {
        return $query->where('can_access_admin', true);
    }

    /**
     * Scope a query to only include enabled users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('status', Status::ENABLED);
    }

    /**
     * Scope a query to only include disabled users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDisabled(Builder $query): Builder
    {
        return $query->where('status', Status::DISABLED);
    }

    /**
     * Scope a query to only include deleted users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeMemberDeleted(Builder $query): Builder
    {
        return $query->where('status', Status::DELETED);
    }

    /**
     * Scope a query to only include pending users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', Status::PENDING);
    }

    /**
     * Scope a query to only include banned users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeBanned(Builder $query): Builder
    {
        return $query->where('status', Status::BANNED);
    }
}
