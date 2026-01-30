<?php

namespace App\Models;

use App\Contracts\HasRoute;
use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
use App\Library\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Artwork extends Model implements HasMedia, HasRoute
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'artworks';
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
        'date',
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
        'exhibit_id',
        'name',
        'description',
        'location',
        'date',
        'photographer',
        'medium',
        'size',
        'grant_acknowledgement',
        'other_acknoledgements',
        'status',
        'size_lenght',
        'size_width',
        'size_height',
        'video_url',
        'photographer_link',
        'order_column',
    ];

    public function hasVideo(): bool
    {
        return !is_null($this->video_url);
    }

    public function getVideoThumbnail(): string
    {
        $imagePath = '';

        if ($this->hasVideo() && Helper::getYouTubeVideoIdFromUrl($this->video_url)) {
            $id = Helper::getYouTubeVideoIdFromUrl($this->video_url);
            $imagePath = "https://i.ytimg.com/vi/{$id}/hqdefault.jpg"; // thumbnail
            $imagePath = "https://i.ytimg.com/vi/{$id}/maxresdefault.jpg"; // Full image
        } else if ($this->hasVideo() && Helper::getVimeoIdFromUrl($this->video_url)) {
            $id = Helper::getVimeoIdFromUrl($this->video_url);
            $imagePath = "https://vumbnail.com/{$id}.jpg";
        }

        return $imagePath;
    }

    /**
     * @return mixed
     */
    public function getVideoPreview(): string
    {
        $src = '';

        if ($this->hasVideo() && Helper::getYouTubeVideoIdFromUrl($this->video_url)) {
            $src = Helper::generateYouTubeUrl(Helper::getYouTubeVideoIdFromUrl($this->video_url));
        } else if ($this->hasVideo() && Helper::getVimeoIdFromUrl($this->video_url)) {
            $src = Helper::generateVimeoUrl(Helper::getVimeoIdFromUrl($this->video_url));
        }

        return $src ?? '';
    }

    /**
     * Get the title of the artwork.
     *
     * @return string The name of the artwork.
     */
    public function getTitle(): string
    {
        return $this->name;
    }

    /**
     * Get the description of the artwork.
     *
     * @return string The artwork description, or an empty string if not set.
     */
    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    /**
     * Get the route URL for the artwork.
     *
     * @param array $query Optional query parameters.
     * @return string
     */
    public function getRoute(array $query = []): string
    {
        return $this->exhibit->belongsToProfile()
        ? route('app.profiles.exhibits.artworks.show', [
            'profile' => $this->exhibit->owner_id,
            'exhibit' => $this->exhibit->id,
            'artwork' => $this->id,
        ] + $query)
        : route('app.groups.exhibits.artworks.show', [
            'group' => $this->exhibit->owner_id,
            'exhibit' => $this->exhibit->id,
            'artwork' => $this->id,
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

    public function hasSize(): bool
    {
        return
        !is_null($this->size_lenght)
        &&
        !is_null($this->size_width)
        &&
        !is_null($this->size_height);
    }

    /**
     * Get the exhibit that owns the Artwork.
     *
     * @return BelongsTo
     */
    public function exhibit(): BelongsTo
    {
        return $this->belongsTo(Exhibit::class, 'exhibit_id');
    }

    /**
     * Get all of the comments for the Artwork.
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'desc');
    }

    /**
     * Get all of the collectionItems for the Artwork.
     *
     * @return MorphMany
     */
    public function collectionItems(): MorphMany
    {
        return $this->morphMany(CollectionItem::class, 'model');
    }

    /**
     * Scope a query to filter artworks in Discover Section
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
            ->whereHas('exhibit', function ($filter) use ($search) {
                $filter->filter();
            })
            ->whereNotIn('artworks.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->where(function ($filter) use ($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("artworks.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to research artworks in Discover Section
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
            ->whereNotIn('artworks.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->whereHas('exhibit', function ($filter) {
                $filter->filter();
            })
            ->where(function ($filter) use ($fields, $search) {
                $filter
                    ->where(function ($filter) use ($fields, $search) {
                        foreach ($fields as $field) {
                            $filter->orWhere("artworks.$field", 'LIKE', '%' . $search . '%');
                        }
                    })
                    ->orWhereHas('exhibit', function ($filter) use ($search) {
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

        static::creating(function ($artwork) {
            if (is_null($artwork->order_column)) {
                $artwork->order_column = $artwork->exhibit->artworks()->count() + 1;
            }
        });

        static::deleted(function ($artwork) {
            $artwork->comments()->delete();
            $artwork->collectionItems()->delete();
        });
    }
}
