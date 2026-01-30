<?php

namespace App\Models;

use App\Enums\LogName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'comments';
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
        'writer_id',
        'writer_type',
        'commentable_id',
        'commentable_type',
        'text',
    ];

    /**
     * Get the writer model (group or profile).
     * 
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function writer(): MorphTo
    {
        return $this->morphTo();
    }

    public function byGroup(): bool
    {
        return $this->writer_type === Group::class;
    }

    public function byProfile(): bool
    {
        return $this->writer_type === UserProfile::class;
    }

    /**
     * Get the commentable model (Exhibit, Artwork, Collection or CollectionItem).
     * 
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function forExhibit(): bool
    {
        return $this->commentable_type === Exhibit::class;
    }

    public function forArtwork(): bool
    {
        return $this->commentable_type === Artwork::class;
    }

    public function forCollection(): bool
    {
        return $this->commentable_type === Collection::class;
    }

    public function forCollectionItem(): bool
    {
        return $this->commentable_type === CollectionItem::class;
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

        static::creating(function ($comment) 
        {

        });

        static::created(function ($comment) {

        });

        static::updated(function ($comment) 
        {

        });

        static::deleting(function ($comment) 
        {

        });

        static::deleted(function ($comment) 
        {

        });
    }
}
