<?php

namespace App\Models;

use App\Enums\LogName;
use App\Emails\Web\InviteToJoinGroup;
use App\Emails\Web\InviteToTransferExhibit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Carbon\Carbon;


class UserInvitation extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use Notifiable;

    protected $table = 'user_invitations';
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
        'sent_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guest_id',
        'inviter_id',
        'subject_type',
        'subject_id',
        'first_name',
        'last_name',
        'email',
        'sent_at',
        'send_copy',
		'linked_to_user_profile_id',
        'is_admin'
    ];

    public function markAsSent(): bool
    {
        return $this->fill([
            'sent_at' => Carbon::now(),
        ])->save();
    }

    /**
     * Resend invitation mail.
     *
     * @return bool
     * 
     * @throws MailException
     */
    public function resendInvitationMail(): bool
    {
        if ( $this->canResendInvitationMail() ) {
            try {
                Mail::to($this)
                ->cc($this->mustSendCopy() ? $this->inviter : null)
                ->send(
                    $this->toJoinGroup() ?
                        new InviteToJoinGroup($this) :
                        (
                            $this->toTransferExhibit() ?
                                new InviteToTransferExhibit($this) : NULL
                        )
                );
                return $this->markAsSent();
            } catch (Exception $e) {
                Log::error($e->getMessage());
                throw new MailException($e->getMessage());
                return false;
            }
        }

        return false;
    }

    public function canDelete(): bool
    {
        return !$this->isRegistered();
    }

    public function canResendInvitationMail(): bool
    {
        return !$this->isRegistered();
    }

    public function isRegistered(): bool
    {
        return '' == $this->token && !is_null($this->guest_id);
    }

    public function mustSendCopy(): bool
    {
        return 1 == $this->send_copy;
    }

    public function getName(): string
    {
        return $this->getFirstName().' '.$this->getLastName();
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * Get the inviter that owns the UserInvitation.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inviter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    /**
     * Get the subject model (group or exhibit).
     * 
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function toJoinGroup(): bool
    {
        return $this->subject_type == Group::class;
    }

    public function toTransferExhibit(): bool
    {
        return $this->subject_type == Exhibit::class;
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

        static::creating(function ($invitation) {
            do {
                $token = Str::random(32);
            } while (UserInvitation::where('token', $token)->first());

            $invitation->token = $token;
        });
    }
}
