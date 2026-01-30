<?php

namespace App\Models\Traits\Profile;

use App\Models\Artwork;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\Document;
use App\Models\Exhibit;
use App\Models\RemoveFromDB;
use App\Models\Website;
use App\Models\WebsiteGroup;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Relation;

trait ProfileRelations
{

    /**
     * Get all of the documents for this Profile.
     *
     * @return MorphMany
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'owner');
    }

    /**
     * Get all of the Website Groups for this Profile.
     *
     * @return MorphMany
     */
    public function websiteGroups(): MorphMany
    {
        return $this->morphMany(WebsiteGroup::class, 'owner');
    }

    /**
     * Get all of the websites for this Profile.
     *
     * @return MorphMany
     */
    public function websites(): MorphMany
    {
        return $this->morphMany(Website::class, 'owner');
    }

    /**
     * Get all of the collections for this Profile.
     *
     * @return MorphMany
     */
    public function collections(): MorphMany
    {
        return $this->morphMany(Collection::class, 'owner');
    }

    /**
     * Get all of the modelsRemovedFromDB for this Profile.
     *
     * @return MorphMany
     */
    public function modelsRemovedFromDB(): MorphMany
    {
        return $this->morphMany(RemoveFromDB::class, 'owner');
    }

    /**
     * Get all of the exhibits for this Profile.
     *
     * @return MorphMany
     */
    public function exhibits(): MorphMany
    {
        return $this->morphMany(Exhibit::class, 'owner');
    }

    /**
     * Get all of the artworks for this Profile.
     *
     * @return HasManyThrough
     */
    public function artworks(): HasManyThrough
    {
        return $this->hasManyThrough(Artwork::class, Exhibit::class, 'owner_id')
            ->where(
                'owner_type',
                array_search(static::class, Relation::morphMap()) ?: static::class
            );
    }

    /**
     * Get all of the collection items for this Profile.
     *
     * @return HasManyThrough
     */
    public function collectionItems(): HasManyThrough
    {
        return $this->hasManyThrough(CollectionItem::class, Collection::class, 'owner_id')
            ->where(
                'owner_type',
                array_search(static::class, Relation::morphMap()) ?: static::class
            );
    }

    /**
     * Get all of the profile's exhibits transfered.
     *
     * @return MorphMany
     */
    public function exhibitsTransferred(): MorphMany
    {
        return $this->morphMany(Exhibit::class, 'transferor');
    }

}
