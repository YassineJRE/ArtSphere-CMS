<?php

namespace App\Listeners\Web;

use App\Models\UserInvitation;
use Illuminate\Support\Facades\Mail;
use App\Emails\Web\InviteToJoinGroup;
use App\Emails\Web\InviteToTransferExhibit;
use App\Events\Web\InvitationWasCreated;
use Log;
use Exception;
use App\Exceptions\MailException;

class SendInvitationMailToGuest
{
    /**
     * Handle the event.
     *
     * @param App\Events\Web\InvitationWasCreated $event
     *
     * @return void
     * 
     * @throws MailException
     */
    public function handle(InvitationWasCreated $event)
    {
        if ($event->userInvitation instanceof UserInvitation) {
            try {
                Mail::to($event->userInvitation)
                ->cc(
                    $event->userInvitation->mustSendCopy() ?
                    $event->userInvitation->inviter : null
                )
                ->send(
                    $event->userInvitation->toJoinGroup() ?
                        new InviteToJoinGroup($event->userInvitation) :
                        (
                            $event->userInvitation->toTransferExhibit() ?
                                new InviteToTransferExhibit($event->userInvitation) : NULL
                        )
                );

                $event->userInvitation->markAsSent();

            } catch (Exception $e) {
                Log::error($e->getMessage());
                throw new MailException($e->getMessage());
            }
        }
    }
}
