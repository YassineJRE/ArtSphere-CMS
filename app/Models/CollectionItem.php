<?php

namespace App\Models;

use App\Contracts\HasRoute;
use App\Enums\LogName;
use App\Models\Traits\ModelProperties;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CollectionItem extends Model implements HasRoute
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use ModelProperties;

    /**
     * @var string
     */
    protected $table = 'collection_items';
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
        'collection_id',
        'model_id',
        'model_type',
        'order_column',
    ];

    /**
     * Get the route URL for the collection item.
     *
     * @param array $query Optional query parameters.
     * @return string
     */
    public function getRoute(array $query = []): string
    {
        return $this->collection->belongsToProfile()
        ? route('app.profiles.collections.items.show', [
            'profile' => $this->collection->owner_id,
            'collection' => $this->collection->id,
            'item' => $this->id,
        ] + $query)
        : route('app.groups.collections.items.show', [
            'group' => $this->collection->owner_id,
            'collection' => $this->collection->id,
            'item' => $this->id,
        ] + $query);
    }

    /**
     * Get the model (Exhibit, Artwork, Collection, CollectionItem, WebsiteGroup, Website, UserProfile or Group).
     *
     * @return MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the collection that owns the CollectionItem.
     *
     * @return BelongsTo
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    /**
     * Get all of the collectionItems for the CollectionItem.
     *
     * @return MorphMany
     */
    public function collectionItems(): MorphMany
    {
        return $this->morphMany(CollectionItem::class, 'model');
    }

    /**
     * Get all of the comments for the CollectionItem.
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'desc');
    }

    /**
     * Get default Media for the Collection.
     *
     * @return Media
     */
    public function getFirstMedia(): Media | null
    {
        return $this->model->getFirstMedia();
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
     * Scope a query to filter collectionItems in Discover Section
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
            ->whereHas('model', function ($filter) use ($search) {
                $filter->filter();
            })
            ->whereNotIn('collection_items.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->where(function ($filter) use ($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("collection_items.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to research collectionItems in Discover Section
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
            ->whereNotIn('collection_items.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->whereHas('model', function ($filter) {
                $filter->filter();
            })
            ->where(function ($filter) use ($fields, $search) {
                $filter
                    ->where(function ($filter) use ($fields, $search) {
                        foreach ($fields as $field) {
                            $filter->orWhere("collection_items.$field", 'LIKE', '%' . $search . '%');
                        }
                    })
                    ->orWhereHas('model', function ($filter) use ($search) {
                        $filter->filter($search);
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

        static::creating(function ($item) {
            if (is_null($item->order_column)) {
                $item->order_column = $item->collection->items()->count() + 1;
            }

            /**
             * You cannot add a collection within the same collection
             */
            if (Collection::class == $item->model_type && $item->model_id == $item->collection_id) {
                return false;
            }
        });

        static::deleted(function ($item) {
            $item->comments()->delete();
            $item->collectionItems()->delete();
        });
    }
}
