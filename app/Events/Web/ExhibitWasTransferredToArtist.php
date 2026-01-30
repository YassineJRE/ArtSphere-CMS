<?php

namespace App\Events\Web;

use App\Models\Exhibit;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExhibitWasTransferredToArtist
{
    use SerializesModels;
    use Dispatchable;
    use InteractsWithSockets;

    /**
     * The exhibit.
     *
     * @var App\Models\Exhibit
     */
    public $exhibit;

    /**
     * Create a new event instance.
     *
     * @param App\Models\Exhibit $exhibit
     *
     * @return void
     */
    public function __construct(Exhibit $exhibit)
    {
        $this->exhibit = $exhibit;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
