<?php

namespace App\Listeners\Web;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Emails\Web\WelcomeToNewMember;
use App\Events\Web\UserWasRegistered;

class SendWelcomeMailToNewMember
{
    /**
     * Handle the event.
     *
     * @param App\Events\Web\UserWasRegistered $event
     *
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        if ($event->user instanceof User) {
            Mail::to($event->user)->send(new WelcomeToNewMember($event->user));
        }
    }
}
