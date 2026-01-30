<?php

namespace App\Models;

use App\Contracts\HasRoute;
use App\Enums\LogName;
use App\Enums\ProfileType;
use App\Enums\Status as EnumStatus;
use App\Enums\MemberType as EnumMemberType;
use App\Models\Traits\Profile\HasProfileCollections;
use App\Models\Traits\Profile\HasRemovedModelsFromDB;
use App\Models\Traits\Profile\ProfileAccessors;
use App\Models\Traits\Profile\ProfileHelpers;
use App\Models\Traits\Profile\ProfileOwnership;
use App\Models\Traits\Profile\ProfileRelations;
use App\Models\Traits\UserProfile\UserProfileAccessors;
use App\Models\Traits\UserProfile\UserProfileHelpers;
use App\Models\Traits\UserProfile\UserProfileRelations;
use App\Models\Traits\UserProfile\UserProfileScopes;
use App\Support\Contracts\ActiveProfileInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Collection;

class UserProfile extends Authenticatable implements ActiveProfileInterface, HasRoute
{
    use HasFactory, SoftDeletes, LogsActivity, HasRoles;
    use ProfileAccessors, ProfileRelations, ProfileHelpers;
    use ProfileOwnership, HasProfileCollections, HasRemovedModelsFromDB;
    use UserProfileAccessors, UserProfileRelations, UserProfileScopes, UserProfileHelpers;

    /**
     * @var string
     */
    protected $guard_name = 'profiles';

    /**
     * @var string
     */
    protected $table = 'user_profiles';
    public $timestamps = true;
    public string $logName = LogName::DEFAULT;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
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
        'user_id',
        'status',
        'type',
        'artist_name',
        'other_artist_name',
        'pronoun',
        'first_name',
        'last_name',
        'username',
        'email',
        'address',
        'country',
        'ethnicity',
        'biography',
        'artist_type',
        'member_of',
        'art_practice_type',
        'additional_information_title',
        'additional_information_content',
        'specify_artist_type',
        'specify_art_practice_type',
    ];

    public function getLongName(): string
    {
        if ($this->isPublicCollector()) {
            return $this->user->getName();
        }

        return $this->user->getName().', '.$this->getName();
    }

    public function getName(): string
    {
        return $this->getFirstName();
    }

    public function getFirstName(): string
    {
        if ($this->isPublicCollector()) {
            return $this->user->getFirstName();
        }

        return $this->artist_name;
    }

    public function getLastName(): string
    {
        if ($this->isPublicCollector()) {
            return $this->user->getLastName();
        }

        return $this->other_artist_name;
    }

    public function isArtist(): bool
    {
        return ProfileType::ARTIST == $this->type;
    }

    public function isCurator(): bool
    {
        return ProfileType::CURATOR == $this->type;
    }

    public function isPublicCollector(): bool
    {
        return ProfileType::PUBLIC_COLLECTOR == $this->type;
    }

    public function hasMedia(): bool
    {
        return $this->getFirstMedia() instanceof Media;
    }

    /**
     * Get default Media for the Profile.
     *
     * @return Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function getFirstMedia(): Media|NULL
    {
        return $this->documents()->exists() ?
            $this->documents()->orderBy('order_column')->first()->getFirstMedia() : NULL;
    }

    /**
     * Get all of the comments for the Profile.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'writer')->orderBy('created_at','desc');
    }

    /**
     * Get all of the memberships for the Profile.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(UserHasGroup::class, 'user_profile_id');
    }

    /**
     * Get all of the groups for the UserProfile.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_has_groups', 'user_profile_id', 'group_id');
    }

    /**
     * Scope a query to filter profiles in Discover Section
     *
     * @param Illuminate\Database\Eloquent\Builder $filter
     * @param string|null $search
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $filter, string|null $search=''): Builder
    {
        $fields = $this->fillable;
        $filter
            ->where('user_profiles.status', EnumStatus::ENABLED)
            ->whereNotIn('user_profiles.id',
                app('profile.session')->getModelsRemovedFromDB()
                                    ->where('model_type', self::class)
                                    ->pluck('model_id')
            )
            ->where(function ($filter) use($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("user_profiles.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to research profiles in Discover Section
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
            ->where('user_profiles.status', EnumStatus::ENABLED)
            ->whereNull('user_profiles.deleted_at')
            ->whereNotIn('user_profiles.id',
                app('profile.session')->getModelsRemovedFromDB()
                                    ->where('model_type', self::class)
                                    ->pluck('model_id')
            )
            ->where(function ($filter) use($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("user_profiles.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to only include artist profiles.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtists($query): Builder
    {
        return $query->where('type', ProfileType::ARTIST);
    }

    /**
     * Scope a query to only include curator profiles.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurators($query): Builder
    {
        return $query->where('type', ProfileType::CURATOR);
    }

    /**
     * Scope a query to only include public-collector profiles.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePublicCollectors($query): Builder
    {
        return $query->where('type', ProfileType::PUBLIC_COLLECTOR);
    }

    /**
     * Get the user that owns the UserProfile.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Check if this profile is the only profile of the account
     *
     * @return bool
     */
    public function isTheOnlyProfile(): bool
    {
        return 1 == $this->user->profiles()->count();
    }

    /**
     * Verify if this Profile is in this Group.
     *
     * @param int|App\Models\Group $group
     *
     * @return bool
     */
    public function isInGroup(Group|int $group): bool
    {
        $groupId = null;

        if ($group instanceof Group) {
            $groupId = $group->id;
        }

        if (is_numeric($group)) {
            $groupId = $group;
        }

        return $this->groups->pluck('id')->contains($groupId);
    }

    /**
     * Verify if this Profile has this Exhibit.
     *
     * @param int|App\Models\Exhibit $exhibit
     *
     * @return bool
     */
    public function hasExhibit(Exhibit|int $exhibit): bool
    {
        $exhibitId = null;

        if ($exhibit instanceof Exhibit) {
            $exhibitId = $exhibit->id;
        }

        if (is_numeric($exhibit)) {
            $exhibitId = $exhibit;
        }

        return $this->exhibits->pluck('id')->contains($exhibitId);
    }
    /**
     * Obtain the exhibits per user
     */
    public function exhibits(): HasMany
    {
        return $this->hasMany(Exhibit::class, 'owner_id');
    }


    /**
     *
     * getActivitylogOptions.
     *
     * @return Spatie\Activitylog\LogOptions
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

        static::creating(function ($profile) {

        });

        static::created(function ($profile)
        {
            foreach ($profile->user->invitations as $invitation)
            {
                if (
                    $invitation->toJoinGroup() &&
                    ($profile->isArtist() || $profile->isCurator()) &&
                    !$profile->user->isInGroup($invitation->subject_id)
                ) {
                    $role = $invitation->is_admin? EnumMemberType::ADMINISTRATOR :EnumMemberType::MEMBER;
                    UserHasGroup::firstOrCreate([
                        'role' => $role,
                        'user_id' => $profile->user_id,
                        'user_profile_id' => $profile->id,
                        'group_id' => $invitation->subject_id,
                    ]);
                }
                elseif (
                    $invitation->toTransferExhibit() &&
                    $profile->isArtist() &&
                    !$profile->hasExhibit($invitation->subject_id)
                ) {
                    Exhibit::where('id', $invitation->subject_id)->update([
                        'transferor_type' => $invitation->subject->owner_type,
                        'transferor_id' => $invitation->subject->owner_id,
                        'transferred_at' => Carbon::now(),
                        'owner_id' => $profile->id,
                        'owner_type' => UserProfile::class,
                    ]);
                }
            }
        });

        static::updated(function ($profile) {

        });

        static::deleting(function ($profile) {
            $profile->status = EnumStatus::DELETED;
            $profile->save();
        });

        static::deleted(function ($profile)
        {
            $profile->exhibits()->delete();
            $profile->documents()->delete();
            $profile->websiteGroups()->delete();
            $profile->collections()->delete();
            $profile->memberships()->delete();
            $profile->modelsRemovedFromDB()->delete();
            $profile->comments()->delete();
        });
    }

	//GALLERY INVITATION FEATURE
	//Update user_id based on user_profile_id

	public static function updateUserProfileId(int $userProfileId, User $user): void
    {
        $UserProfile = UserProfile::where('id', $userProfileId)->first();

        if ($UserProfile) {
            $UserProfile->user_id = $user->id;
            $UserProfile->save();
        }

    }

	//Get all the artworks

    /**
     * Get all artworks for the UserProfile through its exhibits.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllArtworks(): Collection
    {
        $exhibits = $this->exhibits()->get();

        $artworks = collect();

        foreach ($exhibits as $exhibit) {
            $artworks = $artworks->merge($exhibit->artworks()->get());
        }

        // Cast the collection to Illuminate\Database\Eloquent\Collection
        return new Collection($artworks->all());
    }

	/**
     * Get an exhibit by exhibit_id for the UserProfile.
     *
     * @param int $exhibitId
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getExhibitById(int $exhibitId): Exhibit|null
    {
        return $this->exhibits()->where('id', $exhibitId)->first();
    }

	public function getAllExhibits(): Collection
	{
		// Retrieve all exhibits associated with the user profile
		return $this->exhibits()->get();
	}

}
