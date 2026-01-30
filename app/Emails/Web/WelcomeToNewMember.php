<?php

namespace App\Emails\Web;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeToNewMember extends Mailable
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
            ->subject(__('emails.app.WelcomeToNewMember.subject.welcome'))
            ->markdown('emails.welcome', [
                'user' => $this->user,
            ]);
    }
}
