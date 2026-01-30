<?php

namespace App\Listeners\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Emails\Admin\NotifyUserToActivateAccount;
use App\Events\Admin\UserWasCreated;

class SendEmailToUserToActivateAccount
{
    /**
     * Handle the event.
     *
     * @param App\Events\Admin\UserWasCreated $event
     *
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        if ($event->user instanceof User && $event->user->canAccessAdmin()) {
            Mail::to($event->user)->send(new NotifyUserToActivateAccount($event->user));
        }
    }
}
