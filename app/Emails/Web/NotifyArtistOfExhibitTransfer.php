<?php

namespace App\Emails\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\Exhibit;


class NotifyArtistOfExhibitTransfer extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The exhibit.
     *
     * @var App\Models\Exhibit
     */
    public $exhibit;

    /**
     * Create a new message instance.
     *
     * @param App\Models\Exhibit $request
     *
     * @return void
     */
    public function __construct(Exhibit $exhibit)
    {
        $this->exhibit = $exhibit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('emails.app.notifyArtistOfExhibitTransfer.subject'))
            ->markdown('emails.notifyArtistOfExhibitTransfer', [
                'exhibit' => $this->exhibit,
                'actionText' => __('emails.app.notifyArtistOfExhibitTransfer.action-text'),
                'actionUrl' => route('authentication.login'),
            ]);
    }
}
