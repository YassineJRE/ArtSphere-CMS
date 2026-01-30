<?php

namespace App\Listeners\Web;

use App\Models\Exhibit;
use Illuminate\Support\Facades\Mail;
use App\Emails\Web\NotifyArtistOfExhibitTransfer;
use App\Events\Web\ExhibitWasTransferredToArtist;
use Log;
use Exception;
use App\Exceptions\MailException;

class SendExhibitTransferMailToArtist
{
    /**
     * Handle the event.
     *
     * @param App\Events\Web\ExhibitWasTransferredToArtist $event
     *
     * @return void
     * 
     * @throws MailException
     */
    public function handle(ExhibitWasTransferredToArtist $event)
    {
        if ($event->exhibit instanceof Exhibit && $event->exhibit->belongsToProfile()) {
            try {
                Mail::to($event->exhibit->owner->user)
                ->cc(
                    $event->exhibit->isTransfered() ?
                        $event->exhibit->transferor->user : null
                )
                ->send(new NotifyArtistOfExhibitTransfer($event->exhibit));

            } catch (Exception $e) {
                Log::error($e->getMessage());
                throw new MailException($e->getMessage());
            }
        }
    }
}
