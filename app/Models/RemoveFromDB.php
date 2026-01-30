<?php

namespace App\Models;

use App\Enums\LogName;
use App\Models\Traits\OwnerProperties;
use App\Models\Traits\ModelProperties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class RemoveFromDB extends Model
{
    use HasFactory;
    use LogsActivity;
    use OwnerProperties;
    use ModelProperties;

    protected $table = 'remove_from_db';
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
        'owner_type',
        'owner_id',
        'model_type',
        'model_id',
    ];

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
     * Get the model (Exhibit, Artwork, Collection, CollectionItem, WebsiteGroup, Website, UserProfile or Group).
     *
     * @return MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
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
}
