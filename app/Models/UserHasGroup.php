<?php

namespace App\Models;

use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
use App\Enums\MemberType as EnumMemberType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserHasGroup extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'user_has_groups';
    public $timestamps = true;
    public string $logName = LogName::DEFAULT;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

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
        'user_profile_id',
        'group_id',
        'role',
        'status',
    ];

    /**
     * Get the group that owns the Member.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    /**
     * Get the account that owns the Member.
     *
     * @return App\Models\User|null
     */
    public function account(): User|null
    {
        return User::find($this->user_id);
    }

    /**
     * Get the profile that owns the Member.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'user_profile_id');
    }
    
    public function isAdministrator(): bool
    {
        return EnumMemberType::ADMINISTRATOR == $this->role;
    }

    public function isMember(): bool
    {
        return EnumMemberType::MEMBER == $this->role;
    }

    public function isEnabled(): bool
    {
        return EnumStatus::ENABLED == $this->status;
    }

    public function isDisabled(): bool
    {
        return EnumStatus::DISABLED == $this->status;
    }

    public function isPending(): bool
    {
        return EnumStatus::PENDING == $this->status;
    }

    public function isDeleted(): bool
    {
        return EnumStatus::DELETED == $this->status;
    }

    public function canEdit(): bool
    {
        return $this->isMember() || (
            $this->isAdministrator() && $this->group->hasMoreThanOneAdministrator()
        );
    }

    public function canRemove(): bool
    {
        return 
            (
                app('profile.session')->isAdministratorOfThisGroup($this->group) && (
                    $this->isMember() || (
                        $this->isAdministrator() && $this->group->hasMoreThanOneAdministrator()
                    )
                )
            )
            ||
            (
                $this->isOwner()
            );
    }

    public function isOwner(): bool
    {
        return auth()->user()->id == $this->account()->id;
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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($member) 
        {
            if (is_null($member->user_id)) {                
                $member->user_id = UserProfile::find($member->user_profile_id)->user_id ?? NULL;
            }
        });

        static::deleting(function ($document) {
            $document->status = EnumStatus::DELETED;
        });
    }
	
	//GALLERY INVITATION FEATURE
	//Update userId with the specified gallery and retrieve user_profile_id
	
	public static function updateUserIdByGroupId(int $subjectId, User $user): ?int
	{
		$record = static::where('group_id', $subjectId)->first();

		if ($record) {
			$currentProfileId = $record->user_profile_id;
			$record->user_id = $user->id;
			$record->save();

			return $currentProfileId;
		}

		return null;
	}
}