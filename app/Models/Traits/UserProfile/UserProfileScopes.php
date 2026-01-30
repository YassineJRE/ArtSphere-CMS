<?php

namespace App\Models\Traits\UserProfile;

use App\Enums\ProfileType;
use App\Enums\Status as EnumStatus;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait UserProfileScopes
 *
 * Contains query scopes for UserProfile model.
 */
trait UserProfileScopes
{
    /**
     * Scope a query to filter profiles in Discover Section.
     *
     * @param Builder $filter
     * @param string|null $search
     *
     * @return Builder
     */
    public function scopeFilter(Builder $filter, ?string $search = ''): Builder
    {
        $fields = $this->fillable;
        $filter
            ->where('user_profiles.status', EnumStatus::ENABLED)
            ->whereNotIn('user_profiles.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->where(function ($filter) use ($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("user_profiles.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to research profiles in Discover Section.
     *
     * @param Builder $filter
     * @param string|null $search
     *
     * @return Builder
     */
    public function scopeResearch(Builder $filter, ?string $search = ''): Builder
    {
        $fields = $this->fillable;
        $filter
            ->where('user_profiles.status', EnumStatus::ENABLED)
            ->whereNull('user_profiles.deleted_at')
            ->whereNotIn('user_profiles.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->where(function ($filter) use ($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("user_profiles.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to only include artist profiles.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeArtists(Builder $query): Builder
    {
        return $query->where('type', ProfileType::ARTIST);
    }

    /**
     * Scope a query to only include curator profiles.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeCurators(Builder $query): Builder
    {
        return $query->where('type', ProfileType::CURATOR);
    }

    /**
     * Scope a query to only include public-collector profiles.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopePublicCollectors(Builder $query): Builder
    {
        return $query->where('type', ProfileType::PUBLIC_COLLECTOR);
    }
}
