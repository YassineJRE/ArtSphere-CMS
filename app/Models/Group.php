<?php

namespace App\Models;

use App\Contracts\HasRoute;
use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
use App\Models\Traits\Group\GroupAccessors;
use App\Models\Traits\Group\GroupHelpers;
use App\Models\Traits\Group\GroupRelations;
use App\Models\Traits\Group\GroupScopes;
use App\Models\Traits\Profile\HasProfileCollections;
use App\Models\Traits\Profile\HasRemovedModelsFromDB;
use App\Models\Traits\Profile\ProfileAccessors;
use App\Models\Traits\Profile\ProfileHelpers;
use App\Models\Traits\Profile\ProfileOwnership;
use App\Models\Traits\Profile\ProfileRelations;
use App\Support\Contracts\ActiveProfileInterface;
use App\Enums\GroupType as EnumGroupType;
use App\Enums\MemberType as EnumMemberType;
use App\Enums\VerifiedStatus as EnumVerifiedStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Log;

class Group extends Model implements ActiveProfileInterface, HasRoute
{
    use HasFactory, SoftDeletes, LogsActivity, Notifiable;
    use ProfileAccessors, ProfileRelations, ProfileHelpers;
    use ProfileOwnership, HasProfileCollections, HasRemovedModelsFromDB;
    use GroupScopes, GroupAccessors, GroupRelations, GroupHelpers;

    /**
     * @var string
     */
    protected $table = 'groups';
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
        'approved_at',
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
        'name',
        'type',
        'institution_type',
        'art_practice_type',
        'address',
        'city',
        'country',
        'biography',
        'mandate',
        'member_of',
        'additional_information_title',
        'additional_information_content',
        'status',
        'approved_at',
        'specify_art_practice_type',
        'email',
        'phone',
    ];

    public function isNotifiable(): bool
    {
        return 
            $this->isArtistRunCenterOrganisation() 
            &&
            !is_null($this->email);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function hasMoreThanOneAdministrator(): bool
    {
        return $this->administrators->count() > 1;
    }

    /**
     * Scope a query to filter groups in Discover Section
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
            ->where('groups.status', EnumStatus::ENABLED)
            ->whereNotIn('groups.id',
                app('profile.session')->getModelsRemovedFromDB()
                                    ->where('model_type', self::class)
                                    ->pluck('model_id')
            )
            ->where(function ($filter) use($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("groups.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to research groups in Discover Section
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
            ->where('groups.status', EnumStatus::ENABLED)
            ->whereNull('groups.deleted_at')
            ->whereNotIn('groups.id',
                app('profile.session')->getModelsRemovedFromDB()
                                    ->where('model_type', self::class)
                                    ->pluck('model_id')
            )
            ->where(function ($filter) use($fields, $search) {
                foreach ($fields as $field) {
                    $filter->orWhere("groups.$field", 'LIKE', '%' . $search . '%');
                }
            });

        return $filter;
    }

    /**
     * Scope a query to only include artist groups.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtist($query): Builder
    {
        return $query->where('type', EnumGroupType::ARTIST);
    }

    /**
     * Scope a query to only include curator groups.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurator($query): Builder
    {
        return $query->where('type', EnumGroupType::CURATOR);
    }

    /**
     * Scope a query to only include gallery groups.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeGallery($query): Builder
    {
        return $query->where('type', EnumGroupType::ARTIST_RUN_CENTER_ORG);
    }

    /**
     * Scope a query to only include enabled groups.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query): Builder
    {
        return $query->where('status', EnumStatus::ENABLED);
    }

    /**
     * Scope a query to only include disabled groups.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeDisabled($query): Builder
    {
        return $query->where('status', EnumStatus::DISABLED);
    }

    /**
     * Scope a query to only include approved groups.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query): Builder
    {
        return $query->whereNotNull('approved_at');
    }

    /**
     * Scope a query to only include awaiting approval groups.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeAwaitingApproval($query): Builder
    {
        return $query->whereNull('approved_at');
    }

    public function isArtist(): bool
    {
        return $this->type == EnumGroupType::ARTIST;
    }

    public function isCurator(): bool
    {
        return $this->type == EnumGroupType::CURATOR;
    }

    public function isArtistRunCenterOrganisation(): bool
    {
        return $this->type == EnumGroupType::ARTIST_RUN_CENTER_ORG;
    }

    public function hasMedia(): bool
    {
        return $this->getFirstMedia() instanceof Media;
    }

    /**
     * Get default Media for the Group.
     *
     * @return Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function getFirstMedia(): Media|NULL
    {
        return $this->documents()->exists() ?
            $this->documents()->orderBy('order_column')->first()->getFirstMedia() : NULL;
    }

    public function hasSecondMedia(): bool
    {
        return $this->getSecondMedia() instanceof Media;
    }

    /**
     * Get second default Media for the Group.
     *
     * @return Spatie\MediaLibrary\MediaCollections\Models\Media
     */
    public function getSecondMedia(): Media|NULL
    {
        $secondDocument = $this->documents()->orderBy('order_column')->skip(1)->first();
        return  $secondDocument ? $secondDocument->getFirstMedia() : NULL;
    }

    /**
     * Get all of the comments for the Group.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'writer')->orderBy('created_at','desc');
    }

    /**
     * Get all of the members (UserProfile) for the Group.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function memberProfiles(): BelongsToMany
    {
        return $this->belongsToMany(UserProfile::class, 'user_has_groups', 'group_id', 'user_profile_id');
    }

    /**
     * Get all of the members (User) for the Group.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function memberUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_has_groups', 'group_id', 'user_id');
    }

    /**
     * Get first Administrator of this Group.
     *
     * @return App\Models\User
     */
    public function firstAdministrator(): User
    {
        return $this->memberUsers()->where('user_has_groups.role', EnumMemberType::ADMINISTRATOR)->first();
    }

    /**
     * Get all of the members for the Group.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(UserHasGroup::class, 'group_id');
    }

    /**
     * Get all of the administrators for the Group.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function administrators(): HasMany
    {
        return $this->members()->where('user_has_groups.role', EnumMemberType::ADMINISTRATOR);
    }

    /**
     * Get all of the guests for the Group.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function guests(): MorphMany
    {
        return $this->morphMany(UserInvitation::class, 'subject');
    }

    public function unregisteredGuests(): MorphMany
    {
        return $this->guests()->whereNotNull('token')->where('token', '<>', '');
    }

    public function isAwaitingApproval(): bool
    {
        return is_null($this->approved_at);
    }

    public function isApproved(): bool
    {
        return !$this->isAwaitingApproval();
    }

    public function isVerifiedGallery(): bool
    {
        return
            $this->isArtistRunCenterOrganisation()
            &&
            $this->isApproved();
    }

    public function canChangeStatus(): bool
    {
        return !$this->isAwaitingApproval() && !$this->isDeleted();
    }

    public function isDraft(): bool{
        return $this->status == EnumStatus::DRAFT;
    }

    /**
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
    /**
     * Get all of the exhibits this group verifies.
     * 
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function verificationExhibits(): HasMany {
        return $this->hasMany(Exhibit::class, 'verifier_id');
    }
    public function pendingVerificationExhibits(): HasMany {
        return $this->verificationExhibits()->where('verified_status', EnumVerifiedStatus::PENDING);
    }
    public function filterVerificationExhibits(string $filter): HasMany{
        return $this->verificationExhibits()->where('verified_status',$filter);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($group) {

        });

        static::created(function ($group) {

        });

        static::updated(function ($group) {

        });
        static::updating(function ($group){
            Log::info('event updating');
            if($group->isDraft()){
                $group->status = EnumStatus::DISABLED; // not sure what status enabled does, noticed disabled was default for it so using that
            }
            Log::info($group->status);
        });


        static::deleting(function ($group)
        {
            $group->status = EnumStatus::DELETED;
            $group->save();
        });

        static::deleted(function ($group)
        {
            $group->members()->delete();
            $group->guests()->delete();
            $group->exhibits()->delete();
            $group->documents()->delete();
            $group->websiteGroups()->delete();
            $group->collections()->delete();
            $group->modelsRemovedFromDB()->delete();
            $group->comments()->delete();
        });
    }
}
