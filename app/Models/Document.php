<?php

namespace App\Models;

use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
use App\Models\Traits\OwnerProperties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Document extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use InteractsWithMedia;
    use OwnerProperties;

    protected $table = 'documents';
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
        'owner_id',
        'owner_type',
        'name',
        'description',
        'status',
        'order_column',
    ];

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
     * Get the owner model (Group or UserProfile).
     * 
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner(): MorphTo
    {
        return $this->morphTo();
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

        static::creating(function ($document) {
            if (is_null($document->order_column)) {
                $document->order_column = $document->owner->documents()->count() + 1;
            }
        });

        static::deleting(function ($document) {
            $document->status = EnumStatus::DELETED;
        });
    }
}