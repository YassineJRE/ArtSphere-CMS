<?php

namespace App\Models;

use App\Enums\LogName;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserEmail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'user_emails';
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

    protected $dates = [
        'email_verified_at',
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
        'email',
        'email_verified_at',
        'email_verification_token',
        'status',
    ];

    public function isEnabled(): bool
    {
        return Status::ENABLED == $this->status;
    }

    public function isBanned(): bool
    {
        return Status::BANNED == $this->status;
    }

    public function isDisabled(): bool
    {
        return Status::DISABLED == $this->status;
    }

    public function isDeleted(): bool
    {
        return Status::DELETED == $this->status;
    }

    public function isPending(): bool
    {
        return Status::PENDING == $this->status;
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
}
