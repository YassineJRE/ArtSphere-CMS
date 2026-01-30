<?php

namespace App\Models\Traits\Group;

use App\Enums\GroupType as EnumGroupType;
use App\Enums\Status as EnumStatus;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait GroupScopes
 *
 * This trait defines a set of Eloquent scopes to be used on the Group model.
 * It provides reusable query filters for common business logic, such as
 * filtering by type (artist, curator, gallery), status (enabled, disabled),
 * and approval state, as well as full-text search-like capabilities.
 *
 * Intended for use within models that represent profile-like entities
 * having similar attributes or lifecycle behaviors.
 */
trait GroupScopes
{
    /**
     * Scope a query to filter enabled groups for the Discover section.
     *
     * Excludes groups that have been marked as removed in the profile session.
     * Filters using LIKE on all fillable fields.
     *
     * @param Builder $filter The query builder instance.
     * @param string|null $search The search term to filter groups.
     * @return Builder
     */
    public function scopeFilter(Builder $filter, ?string $search = ''): Builder
    {
        $fields = $this->fillable;
        $filter
            ->where('groups.status', EnumStatus::ENABLED)
            ->whereNotIn('groups.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->where(function ($filter) use ($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("groups.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to search enabled and non-deleted groups in the Discover section.
     *
     * Similar to scopeFilter but explicitly excludes soft-deleted groups.
     *
     * @param Builder $filter The query builder instance.
     * @param string|null $search The search term to filter groups.
     * @return Builder
     */
    public function scopeResearch(Builder $filter, ?string $search = ''): Builder
    {
        $fields = $this->fillable;
        $filter
            ->where('groups.status', EnumStatus::ENABLED)
            ->whereNull('groups.deleted_at')
            ->whereNotIn('groups.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->where(function ($filter) use ($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("groups.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to include only groups of type ARTIST.
     *
     * @param Builder $query The query builder instance.
     * @return Builder
     */
    public function scopeArtist(Builder $query): Builder
    {
        return $query->where('type', EnumGroupType::ARTIST);
    }

    /**
     * Scope a query to include only groups of type CURATOR.
     *
     * @param Builder $query The query builder instance.
     * @return Builder
     */
    public function scopeCurator(Builder $query): Builder
    {
        return $query->where('type', EnumGroupType::CURATOR);
    }

    /**
     * Scope a query to include only groups of type ARTIST_RUN_CENTER_ORG (galleries).
     *
     * @param Builder $query The query builder instance.
     * @return Builder
     */
    public function scopeGallery(Builder $query): Builder
    {
        return $query->where('type', EnumGroupType::ARTIST_RUN_CENTER_ORG);
    }

    /**
     * Scope a query to include only groups with status ENABLED.
     *
     * @param Builder $query The query builder instance.
     * @return Builder
     */
    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('status', EnumStatus::ENABLED);
    }

    /**
     * Scope a query to include only groups with status DISABLED.
     *
     * @param Builder $query The query builder instance.
     * @return Builder
     */
    public function scopeDisabled(Builder $query): Builder
    {
        return $query->where('status', EnumStatus::DISABLED);
    }

    /**
     * Scope a query to include only groups that have been approved (approved_at not null).
     *
     * @param Builder $query The query builder instance.
     * @return Builder
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->whereNotNull('approved_at');
    }

    /**
     * Scope a query to include only groups that are awaiting approval (approved_at is null).
     *
     * @param Builder $query The query builder instance.
     * @return Builder
     */
    public function scopeAwaitingApproval(Builder $query): Builder
    {
        return $query->whereNull('approved_at');
    }
}
