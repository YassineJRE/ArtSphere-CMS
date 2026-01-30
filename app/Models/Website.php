<?php

namespace App\Models;

use App\Contracts\HasRoute;
use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
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

class Website extends Model implements HasMedia, HasRoute
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'websites';
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
        'parent_id',
        'type',
        'title',
        'description',
        'url',
        'owner_name',
        'owner_link',
        'additional_information_title',
        'additional_information_content',
        'status',
        'order_column',
    ];

    /**
     * Get the title of the website.
     *
     * @return string The title of the website.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get the type of the website.
     *
     * @return string The type of the website.
     */
    public function getType(): string
    {
        return $this->type ?? '';
    }

    /**
     * Get the route URL for the website.
     *
     * @param array $query Optional query parameters.
     * @return string
     */
    public function getRoute(array $query = []): string
    {
        return $this->parent->belongsToProfile()
        ? route('app.profiles.website-groups.websites.show', [
            'profile' => $this->parent->owner_id,
            'website_group' => $this->parent_id,
            'website' => $this->id,
        ] + $query)
        : route('app.groups.website-groups.websites.show', [
            'group' => $this->parent->owner_id,
            'website_group' => $this->parent_id,
            'website' => $this->id,
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
     * Get the parent that owns the Website.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(WebsiteGroup::class, 'parent_id');
    }

    /**
     * Get all of the collectionItems for the Website.
     *
     * @return MorphMany
     */
    public function collectionItems(): MorphMany
    {
        return $this->morphMany(CollectionItem::class, 'model');
    }

    /**
     * Scope a query to filter websites in Discover Section
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
            ->whereHas('parent', function ($filter) use ($search) {
                $filter->whereIn('id', WebsiteGroup::filter()->pluck('id'));
            })
            ->whereNotIn('websites.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->where(function ($filter) use ($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("websites.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to research websites in Discover Section
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
            ->whereNotIn('websites.id',
                app('profile.session')->getModelsRemovedFromDB()
                    ->where('model_type', self::class)
                    ->pluck('model_id')
            )
            ->whereHas('parent', function ($filter) {
                $filter->whereIn('id', WebsiteGroup::filter()->pluck('id'));
            })
            ->where(function ($filter) use ($fields, $search) {
                $filter
                    ->where(function ($filter) use ($fields, $search) {
                        foreach ($fields as $field) {
                            $filter->orWhere("websites.$field", 'LIKE', '%' . $search . '%');
                        }
                    })
                    ->orWhereHas('parent', function ($filter) use ($search) {
                        $filter->whereIn('id', WebsiteGroup::research($search)->pluck('id'));
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('website', function (Builder $builder) {
            $builder->whereNotNull('parent_id');
        });

        static::creating(function ($website) {
            if (is_null($website->order_column)) {
                $website->order_column = $website->parent->websites()->count() + 1;
            }
        });

        static::deleted(function ($website) {
            $website->collectionItems()->delete();
        });
    }
}
