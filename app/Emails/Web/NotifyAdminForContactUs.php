<?php

namespace App\Emails\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class NotifyAdminForContactUs extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The request.
     *
     * @var Illuminate\Http\Request
     */
    public $request;

    /**
     * Create a new message instance.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->request->get('email'), $this->request->get('name'))
            ->to(config('mail.from.address'), config('mail.from.name'))
            ->subject(__('emails.app.NotifyAdminForContactUs.subject.website').$this->request->get('subject'))
            ->markdown('emails.contact', [
                'request' => $this->request,
            ]);
    }
}
