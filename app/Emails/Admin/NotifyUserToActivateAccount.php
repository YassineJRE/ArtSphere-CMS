<?php

namespace App\Emails\Admin;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class NotifyUserToActivateAccount extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The user.
     *
     * @var App\Models\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param App\Models\User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('admin-emails.app.NotifyUserToActivateAccount.subject.activate-artolog'))
            ->markdown('admin.emails.activate-account', [
                'user' => $this->user,
                'actionText' => __('Activate your account'),
                'actionUrl' => URL::temporarySignedRoute(
                    'admin.register.finalize',
                    now()->addMinutes(60),
                    [
                        'token' => $this->user->email_verification_token,
                    ]
                ),
            ]);
    }
}
