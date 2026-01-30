<?php

namespace App\Emails\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\UserInvitation;


class InviteToJoinGroup extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The invitation.
     *
     * @var App\Models\UserInvitation
     */
    public $invitation;

    /**
     * Create a new message instance.
     *
     * @param App\Models\UserInvitation $request
     *
     * @return void
     */
    public function __construct(UserInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('emails.app.inviteToJoinGroup.subject'))
            ->markdown('emails.inviteToJoinGroup', [
                'invitation' => $this->invitation,
                'actionText' => __('emails.app.inviteToJoinGroup.action-text'),
                'actionUrl' => URL::temporarySignedRoute(
                    'invitation.registration',
                    now()->addMinutes(300),
                    [
                        'user_invitation' => $this->invitation->id,
                        'subject' => $this->invitation->subject->id,
                        'token' => $this->invitation->token,
                        'email' => $this->invitation->email,
                    ]
                ),
            ]);
    }
}
