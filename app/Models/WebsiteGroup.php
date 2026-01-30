<?php

namespace App\Models;

use App\Contracts\HasRoute;
use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
use App\Enums\WebsiteGroupType as EnumWebsiteGroupType;
use App\Models\Traits\OwnerProperties;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WebsiteGroup extends Model implements HasRoute
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use OwnerProperties;

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
        'owner_id',
        'owner_type',
        'type',
        'title',
        'description',
        'additional_information_title',
        'additional_information_content',
        'status',
        'specify_website_group_type',
        'order_column',
    ];

    /**
     * Get the title of the website group.
     *
     * @return string The title of the website group.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        if ($this->type) {
            return $this->hasTypeOther() ?
            $this->specify_website_group_type :
            __('enums.website-group-type.' . $this->type);
        }

        return '';
    }

    /**
     * Get the route URL for the website group.
     *
     * @param array $query Optional query parameters.
     * @return string
     */
    public function getRoute(array $query = []): string
    {
        return $this->belongsToProfile()
        ? route('app.profiles.website-groups.show', [
            'profile' => $this->owner_id,
            'website_group' => $this->id,
        ] + $query)
        : route('app.groups.website-groups.show', [
            'group' => $this->owner_id,
            'website_group' => $this->id,
        ] + $query);
    }

    public function hasTypeOther(): bool
    {
        return EnumWebsiteGroupType::OTHER == $this->type;
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
     * Get all of the websites for the WebsiteGroup.
     *
     * @return HasMany
     */
    public function websites(): HasMany
    {
        return $this->hasMany(Website::class, 'parent_id');
    }

    /**
     * Get default Media for the WebsiteGroup.
     *
     * @return Media
     */
    public function getFirstMedia(): Media | null
    {
        return $this->websites()->exists() ?
        $this->websites()->orderBy('order_column')->first()->getFirstMedia() : null;
    }

    /**
     * has default Media for the WebsiteGroup.
     *
     * @return bool
     */
    public function hasMedia(): bool
    {
        return $this->getFirstMedia() instanceof Media;
    }

    /**
     * Get second default Media for the WebsiteGroup.
     *
     * @return Media
     */
    public function getSecondMedia(): Media | null
    {
        $secondWebsite = $this->websites()->orderBy('order_column')->skip(1)->first();
        return $secondWebsite ? $secondWebsite->getFirstMedia() : null;
    }

    /**
     * has second default Media for the WebsiteGroup.
     *
     * @return bool
     */
    public function hasSecondMedia(): bool
    {
        return $this->getSecondMedia() instanceof Media;
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
     * Get all of the collectionItems for the WebsiteGroup
     *
     * @return MorphMany
     */
    public function collectionItems(): MorphMany
    {
        return $this->morphMany(CollectionItem::class, 'model');
    }

    /**
     * Scope a query to filter website-groups in Discover Section
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
            ->where('websites.status', EnumStatus::ENABLED)
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
     * Scope a query to research website-groups in Discover Section
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
            ->where('websites.status', EnumStatus::ENABLED)
            ->whereNotIn('websites.id',
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
                            $filter->orWhere("websites.$field", 'LIKE', '%' . $search . '%');
                        }
                    })
                    ->orWhereHas('owner', function ($filter) use ($search) {
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('website-group', function (Builder $builder) {
            $builder->whereNull('parent_id');
        });

        static::creating(function ($websiteGroup) {
            if (is_null($websiteGroup->order_column)) {
                $websiteGroup->order_column = $websiteGroup->owner->websiteGroups()->count() + 1;
            }
        });

        static::deleting(function ($websiteGroup) {
            $websiteGroup->status = EnumStatus::DELETED;
        });

        static::deleted(function ($websiteGroup) {
            $websiteGroup->websites()->delete();
            $websiteGroup->collectionItems()->delete();
        });
    }
}
