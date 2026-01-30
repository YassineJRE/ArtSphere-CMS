<?php

namespace App\Models;

use App\Contracts\HasRoute;
use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
use App\Enums\VerifiedStatus;
use App\Models\Traits\OwnerProperties;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Exhibit extends Model implements HasRoute
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use OwnerProperties;

    /**
     * @var string
     */
    protected $table = 'exhibits';
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
        'locations' => 'object',
        'dates' => 'object',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'open_at',
        'verified_at'
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
        'name',
        'type',
        'status',
        'description',
        'locations',
        'dates',
        'location',
        'upcoming_date',
        'open_at',
        'special_thanks',
        'grant_acknowledgement',
        'other_acknoledgements',
        'additional_information_title',
        'additional_information_content',
        'transferor_type',
        'transferor_id',
        'transferred_at',
        'order_column',
        'token',
		'verified_at',
		'verifier_id',
		'verified_status',
    ];

    /**
     * Get the title of the exhibit.
     *
     * @return string The name of the exhibit.
     */
    public function getTitle(): string
    {
        return $this->name;
    }

    /**
     * Get the description of the exhibit.
     *
     * @return string The exhibit description, or an empty string if not set.
     */
    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    /**
     * Get the route URL for the exhibit.
     *
     * @param array $query Optional query parameters.
     * @return string
     */
    public function getRoute(array $query = []): string
    {
        return $this->belongsToProfile()
        ? route('app.profiles.exhibits.show', [
            'profile' => $this->owner_id,
            'exhibit' => $this->id,
            'token' => $this->token,
        ] + $query)
        : route('app.groups.exhibits.show', [
            'group' => $this->owner_id,
            'exhibit' => $this->id,
            'token' => $this->token,
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

    public function isToVerifiedGalleriesOnly(): bool
    {
        return EnumStatus::TO_VERIFIED_GALLERIES_ONLY == $this->status;
    }

    /**
     * @param string|null $token
     */
    public function isToken(string | null $token = null): bool
    {
        return is_string($token) && $this->token == $token;
    }

    public function isVerified(): bool{
        return VerifiedStatus::APPROVED == $this->verified_status;
    }
    public function isPendingVerification(): bool{
        return VerifiedStatus::PENDING == $this->verified_status;
    }
    public function wasDeniedVerification(): bool{
        return VerifiedStatus::DENIED == $this->verified_status;
    }
    /**
     * @return SupportCollection
     */
    public function getDatesInYear(): SupportCollection
    {
        return $this->artworks->groupBy('date')->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y');
        })->unique();
    }

    /**
     * @return SupportCollection
     */
    public function getLocations(): SupportCollection
    {
        return $this->artworks->pluck('location')->filter()->map(function ($location) {
            return $location;
        })->unique();
    }

    /**
     * @return bool
     */
    public function collectionWasCreatedForTransferor(): bool
    {
        return $this->collectionItems()
            ->whereIn('collection_id',
                Collection::where([
                    'owner_id' => $this->transferor_id,
                    'owner_type' => $this->transferor_type,
                ])->pluck('id')
            )
            ->exists();
    }

    public function isTransfered(): bool
    {
        return
            !is_null($this->transferred_at)
            &&
            is_numeric($this->transferor_id)
            &&
            is_string($this->transferor_type);
    }

    public function isNotTransfered(): bool
    {
        return !$this->isTransfered();
    }

    public function canTransfer(): bool
    {
        return
        (
            $this->belongsToGallery()
            ||
            $this->belongsToCuratorProfile()
            ||
            $this->belongsToCuratorGroup()
        )
        &&
        $this->isNotTransfered();
    }

    /**
     * @return mixed
     */
    public function canChangeStatus(): bool
    {
        return
            $this->belongsToArtistGroup()
            ||
            $this->belongsToArtistProfile();
    }

    /**
     * @return mixed
     */
    public function hasUnprocessedInvitation(): bool
    {
        return $this->invitations()->whereNotNull('token')->exists();
    }

    /**
     * @return mixed
     */
    public function unprocessedInvitation(): UserInvitation
    {
        return $this->invitations()->whereNotNull('token')->first();
    }

    /**
     * @return mixed
     */
    public function canResendInvitationMail(): bool
    {
        return $this->hasUnprocessedInvitation() &&
            $this->unprocessedInvitation()->canResendInvitationMail();
    }

    /**
     * Get the transferor model (group or profile).
     *
     * @return MorphTo
     */
    public function transferor(): MorphTo
    {
        return $this->morphTo();
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
     * Get all of the invitations for the Exhibits.
     *
     * @return MorphMany
     */
    public function invitations(): MorphMany
    {
        return $this->morphMany(UserInvitation::class, 'subject');
    }

    /**
     * Get all of the collectionItems for the Exhibit.
     *
     * @return MorphMany
     */
    public function collectionItems(): MorphMany
    {
        return $this->morphMany(CollectionItem::class, 'model');
    }
    /**
     * Get all of the artworks for the Exhibit.
     *
     * @return HasMany
     */
    public function artworks(): HasMany
    {
        return $this->hasMany(Artwork::class, 'exhibit_id');
    }

   

    /**
     * Get all of the comments for the Exhibit.
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at','desc');
    }

    /**
     * Get the gallery which verified this exhibit.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'verifier_id');
    }

    /**
     * Get all of the comments for the Exhibit and artworks of Exhibit.
     *
     * @return Collection
     */
    public function allComments(): EloquentCollection
    {
        $exhibit = $this;
        return Comment::where(function ($query) use ($exhibit) {
                $query->where('commentable_id', $exhibit->id)
                    ->where('commentable_type', Exhibit::class);
            })
            ->orWhere(function ($query) use ($exhibit) {
                if ($exhibit->artworks()->exists()) {
                    $query->whereIn('commentable_id', $exhibit->artworks->pluck('id'))
                        ->where('commentable_type', Artwork::class);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get default Media for the Exhibit.
     *
     * @return Media
     */
    public function getFirstMedia(): Media | null
    {
        return $this->artworks()->exists() ?
        $this->artworks()->orderBy('order_column')->first()->getFirstMedia() : null;
    }

    /**
     * has default Media for the Exhibit.
     *
     * @return bool
     */
    public function hasMedia(): bool
    {
        return $this->getFirstMedia() instanceof Media;
    }

    /**
     * Get second default Media for the Exhibit.
     *
     * @return Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function getSecondMedia(): Media|NULL
    {
        $secondArtwork = $this->artworks()->orderBy('order_column')->skip(1)->first();
        return  $secondArtwork ? $secondArtwork->getFirstMedia() : NULL;
    }

    /**
     * has second default Media for the Exhibit.
     *
     * @return bool
     */
    public function hasSecondMedia(): bool
    {
        return $this->getSecondMedia() instanceof Media;
    }

    /**
     * Scope a query to filter exhibits in Discover Section
     *
     * @param Illuminate\Database\Eloquent\Builder $filter
     * @param string|null $search
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $filter, string|null $search=''): Builder
    {
        $exhibitFromCurrentUrl = request()->exhibit;
        $tokenFromCurrentUrl = request()->query('token');
        $fields = $this->fillable;
        $filter
            ->whereHas('owner', function ($filter) use($search) {
                $filter->filter();
            })
            ->where(function ($filter) use($exhibitFromCurrentUrl, $tokenFromCurrentUrl) {
                if ( !app('profile.session')->isOwnerOfThisExhibit($exhibitFromCurrentUrl) ) {
                    $filter->where('exhibits.status', EnumStatus::ENABLED);

                    if (app('profile.session')->isVerifiedGallery()) {
                        $filter->orWhere('exhibits.status', EnumStatus::TO_VERIFIED_GALLERIES_ONLY);
                    }

                    if ($tokenFromCurrentUrl) {
                        $filter->orWhere(function ($filter) use($tokenFromCurrentUrl) {
                            $filter->where('exhibits.status', EnumStatus::DISABLED)
                                ->where('exhibits.token', $tokenFromCurrentUrl);
                        });
                    }
                }
            })
            ->whereNotIn('exhibits.id',
                app('profile.session')->getModelsRemovedFromDB()
                                    ->where('model_type', self::class)
                                    ->pluck('model_id')
            )
            ->where(function ($filter) use($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("exhibits.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to research exhibits in Discover Section
     *
     * @param Illuminate\Database\Eloquent\Builder $filter
     * @param string|null $search
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeResearch(Builder $filter, string|null $search=''): Builder
    {
        $fields = $this->fillable;
        $filter
            ->where(function ($filter) {
                $filter->where('exhibits.status', EnumStatus::ENABLED);

                if (app('profile.session')->isVerifiedGallery()) {
                    $filter->orWhere('exhibits.status', EnumStatus::TO_VERIFIED_GALLERIES_ONLY);
                }
            })
            ->whereNotIn('exhibits.id',
                app('profile.session')->getModelsRemovedFromDB()
                                    ->where('model_type', self::class)
                                    ->pluck('model_id')
            )
            ->whereHas('owner', function ($filter) {
                $filter->filter();
            })
            ->where(function ($filter) use($fields, $search) {
                $filter
                    ->where(function ($filter) use($fields, $search) {
                        foreach ($fields as $field) {
                            $filter->orWhere("exhibits.$field", 'LIKE', '%' . $search . '%');
                        }
                    })
                    ->orWhereHas('owner', function ($filter) use($search) {
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

        static::creating(function ($exhibit)
        {
            if (is_null($exhibit->status)) {
                $exhibit->status = EnumStatus::DISABLED;
            }

            if (is_null($exhibit->order_column)) {
                $exhibit->order_column = $exhibit->owner->exhibits()->count() + 1;
            }

            if ($exhibit->status != EnumStatus::ENABLED) {
                do {
                    $exhibit->token = Str::random(32);
                } while (Exhibit::where('token', $exhibit->token)->exists());
            }
        });

        static::updating(function ($exhibit) {
            if (is_null($exhibit->token) && $exhibit->status != EnumStatus::ENABLED) {
                do {
                    $exhibit->token = Str::random(32);
                } while (Exhibit::where('token', $exhibit->token)->exists());
            }

            if (
                $exhibit->getOriginal('status') != $exhibit->status &&
                $exhibit->status == EnumStatus::ENABLED
            ) {
                $exhibit->token = null;
            }
            //setting the verified date to null when the verification status changes from Approved.
            if(isset($exhibit->getDirty()['verified_status']) && isset($exhibit->verified_at) && $exhibit->getDirty()['verified_status']!=VerifiedStatus::APPROVED){
                $exhibit->verified_at = null;
            }
        });

        static::updated(function ($exhibit)
        {
            if (
                $exhibit->wasChanged('status') &&
                $exhibit->getOriginal('status') == EnumStatus::DISABLED &&
                $exhibit->status == EnumStatus::ENABLED &&
                $exhibit->isTransfered() &&
                !$exhibit->collectionWasCreatedForTransferor()
            ) {
                $collection = Collection::create([
                    'owner_id' => $exhibit->transferor_id,
                    'owner_type' => $exhibit->transferor_type,
                    'title' => $exhibit->name,
                ]);

                if ($collection) {
                    CollectionItem::create([
                        'collection_id' => $collection->id,
                        'model_id' => $exhibit->id,
                        'model_type' => Exhibit::class,
                    ]);
                }
            }
        });

        static::deleting(function ($exhibit)
        {
            $exhibit->status = EnumStatus::DELETED;
        });

        static::deleted(function ($exhibit) {
			$exhibit->artworks()->delete();
            $exhibit->comments()->delete();
            $exhibit->collectionItems()->delete();
		});

    }

	//Establish a relationship with copied artworks
//
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'owner_id'); // Foreign key is 'user_id'
    }
}
