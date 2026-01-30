<?php

namespace App\Events\Admin;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserWasCreated
{
    use SerializesModels;
    use Dispatchable;
    use InteractsWithSockets;

    /**
     * The user.
     *
     * @var App\Models\User
     */
    public $user;

    /**
     * Create a new event instance.
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
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
