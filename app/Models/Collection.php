<?php

namespace App\Models;

use App\Contracts\HasRoute;
use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
use App\Models\Traits\OwnerProperties;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Collection extends Model implements HasRoute
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use OwnerProperties;

    /**
     * @var string
     */
    protected $table = 'collections';
    /**
     * @var mixed
     */
    public $timestamps = true;
    public string $logName = LogName::DEFAULT;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'owner_type',
        'status',
        'title',
        'description',
        'additional_information_title',
        'additional_information_content',
        'order_column',
    ];

    /**
     * Get the title of the collection.
     *
     * @return string The title of the collection.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get the route URL for the collection.
     *
     * @param array $query Optional query parameters.
     * @return string
     */
    public function getRoute(array $query = []): string
    {
        return $this->belongsToProfile()
        ? route('app.profiles.collections.show', [
            'profile' => $this->owner_id,
            'collection' => $this->id,
        ] + $query)
        : route('app.groups.collections.show', [
            'group' => $this->owner_id,
            'collection' => $this->id,
        ] + $query);
    }

    public function isEnabled(): bool
    {
        return EnumStatus::ENABLED == $this->status;
    }

    public function isDisabled(): bool
    {
        return EnumStatus::DISABLED == $this->status;
    }

    public function isDeleted(): bool
    {
        return EnumStatus::DELETED == $this->status;
    }

    /**
     * Get the owner model (Group or UserProfile).
     *
     * @return MorphTo
     */
    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get all of the items for the Collection.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(CollectionItem::class, 'collection_id');
    }

    /**
     * Get all of the collectionItems for the Collection.
     *
     * @return MorphMany
     */
    public function collectionItems(): MorphMany
    {
        return $this->morphMany(CollectionItem::class, 'model');
    }

    /**
     * Get all of the comments for the Collection.
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'desc');
    }

    /**
     * Get all of the comments for the Collection and items of Collection.
     *
     * @return EloquentCollection
     */
    public function allComments(): EloquentCollection
    {
        $collection = $this;
        return Comment::where(function ($query) use ($collection) {
            $query->where('commentable_id', $collection->id)
                ->where('commentable_type', Collection::class);
        })
            ->orWhere(function ($query) use ($collection) {
                if ($collection->items()->exists()) {
                    $query->whereIn('commentable_id', $collection->items->pluck('id'))
                        ->where('commentable_type', CollectionItem::class);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get all of the exhibits for the Collection.
     *
     * @return BelongsToMany
     */
    public function exhibits(): BelongsToMany
    {
        return $this->belongsToMany(Exhibit::class, 'collection_items', 'collection_id', 'model_id')
            ->where('model_type', Exhibit::class)
            ->whereNull('collection_items.deleted_at');
    }

    /**
     * Get all of the exhibits with distinct owners for the Collection.
     *
     * @return BelongsToMany
     */
    public function exhibitsWithDistinctOwners(): BelongsToMany
    {
        return $this->exhibits()
            ->groupBy([
                'exhibits.owner_type',
                'exhibits.owner_id',
            ]);
    }

    /**
     * Get default Media for the Collection.
     *
     * @return Media
     */
    public function getFirstMedia(): Media | null
    {
        return $this->items()->exists() ?
        $this->items()->orderBy('order_column')->first()->getFirstMedia() : null;
    }

    /**
     * has default Media for the Collection.
     *
     * @return bool
     */
    public function hasMedia(): bool
    {
        return $this->getFirstMedia() instanceof Media;
    }

    /**
     * Get second default Media for the Collection.
     *
     * @return Media
     */
    public function getSecondMedia(): Media | null
    {
        $secondItem = $this->items()->orderBy('order_column')->skip(1)->first();
        return $secondItem ? $secondItem->getFirstMedia() : null;
    }

    /**
     * has second default Media for the Collection.
     *
     * @return bool
     */
    public function hasSecondMedia(): bool
    {
        return $this->getSecondMedia() instanceof Media;
    }

    /**
     * Scope a query to filter collections in Discover Section
     *
     * @param Builder $filter
     * @param string|null $search
     *
     * @return Builder
     */
    public function scopeFilter(Builder $filter, string | null $search = ''): Builder
    {
        $fields = $this->fillable;
        $filter
            ->whereHas('owner', function ($filter) use ($search) {
                $filter->filter();
            })
            ->where('collections.status', EnumStatus::ENABLED)
            ->whereNotIn('collections.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->where(function ($filter) use ($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("collections.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to research collections in Discover Section
     *
     * @param Builder $filter
     * @param string|null $search
     *
     * @return Builder
     */
    public function scopeResearch(Builder $filter, string | null $search = ''): Builder
    {
        $fields = $this->fillable;
        $filter
            ->where('collections.status', EnumStatus::ENABLED)
            ->whereNotIn('collections.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->whereHas('owner', function ($filter) {
                $filter->filter();
            })
            ->where(function ($filter) use ($fields, $search) {
                $filter
                    ->where(function ($filter) use ($fields, $search) {
                        foreach ($fields as $field) {
                            $filter->orWhere("collections.$field", 'LIKE', '%' . $search . '%');
                        }
                    })
                    ->orWhereHas('owner', function ($filter) use ($search) {
                        $filter->research($search);
                    })
                    ->orWhereHas('items', function ($filter) use ($search) {
                        $filter->research($search);
                    });
            });

        return $filter;
    }

    /**
     * getActivitylogOptions.
     *
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->useLogName($this->logName);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (is_null($collection->order_column)) {
                $collection->order_column = $collection->owner->collections()->count() + 1;
            }
        });

        static::deleting(function ($collection) {
            $collection->status = EnumStatus::DELETED;
        });

        static::deleted(function ($collection) {
            $collection->items()->delete();
            $collection->comments()->delete();
            $collection->collectionItems()->delete();
        });
    }
}
