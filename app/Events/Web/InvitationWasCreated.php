<?php

namespace App\Events\Web;

use App\Models\UserInvitation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvitationWasCreated
{
    use SerializesModels;
    use Dispatchable;
    use InteractsWithSockets;

    /**
     * The userInvitation.
     *
     * @var App\Models\UserInvitation
     */
    public $userInvitation;

    /**
     * Create a new event instance.
     *
     * @param App\Models\UserInvitation $userInvitation
     *
     * @return void
     */
    public function __construct(UserInvitation $userInvitation)
    {
        $this->userInvitation = $userInvitation;
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
