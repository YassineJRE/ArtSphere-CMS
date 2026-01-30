<?php

namespace App\Models;

use App\Enums\LogName as EnumLogName;
use App\Enums\MediaCollection as EnumMediaCollection;
use App\Enums\Status as EnumStatus;
use App\Models\Traits\User\HasRemovedModelsFromDB;
use App\Models\Traits\User\HasUserCollections;
use App\Models\Traits\User\UserAccessors;
use App\Models\Traits\User\UserHelpers;
use App\Models\Traits\User\UserOwnership;
use App\Models\Traits\User\UserRelations;
use App\Models\Traits\User\UserScopes;
use App\Support\Contracts\ActiveProfileInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasMedia, ActiveProfileInterface
{
    use HasApiTokens;
    use HasRoles;
    use Notifiable;

    use HasFactory;
    use SoftDeletes;

    use InteractsWithMedia;

    use LogsActivity;
    use CausesActivity;

    use UserRelations;
    use UserScopes;
    use UserAccessors;
    use UserHelpers;
    use UserOwnership;
    use HasUserCollections;
    use HasRemovedModelsFromDB;

    /**
     * @var string
     */
    protected $table = 'users';

    public string $logName = EnumLogName::DEFAULT;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Attributes considered as dates.
     *
     * @var array<string>
     */
    protected $dates = [
        'email_verified_at',
        'reset_password_sent_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Attributes hidden from array and JSON outputs.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attributes mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'can_access_admin',
        'email',
        'email_verified_at',
        'email_verification_token',
        'password',
        'first_name',
        'last_name',
        'username',
        'status',
        'locale',
        'address',
        'remember_token',
        'country',
        'city',
        'ethnicity',
        'pronoun',
    ];

    /**
     * Register media collections for user images.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(EnumMediaCollection::DEFAULT)
            ->acceptsMimeTypes(['image/jpeg'])
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('medium')
                    ->width(250)
                    ->height(250);
                $this->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);
            });
    }

    /**
     * Configure the activity log options.
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

        static::creating(function ($user) {
            $firstName = Str::slug($user->first_name, '');
            $lastName = Str::ucfirst(Str::substr($user->last_name, 0, 1));
            $username = $firstName . $lastName;
            $i = 0;
            while (User::whereUsername($username)->exists()) {
                ++$i;
                $username = $firstName . $lastName . $i;
            }

            $user->username = $username;
            $user->status = EnumStatus::PENDING;

            if ($user->email) {
                $user->email_verification_token = Str::random(32);
            }

            if (is_null($user->locale)) {
                $user->locale = App::getLocale();
            }
        });

        static::deleting(function ($user) {
            $user->status = EnumStatus::DELETED;
        });

        static::deleted(function ($user) {
            $user->user_notifications()->delete();
            $user->profiles()->delete();
            $user->invitations()->delete();
            $user->memberships()->delete();
            $user->groups()->delete();
            $user->modelsRemovedFromDB()->delete();
        });
    }
}
