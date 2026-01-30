<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\Admin\UserWasCreated;
use App\Listeners\Admin\SendEmailToUserToActivateAccount;
use App\Events\Web\UserWasRegistered;
use App\Listeners\Web\SendWelcomeMailToNewMember;
use App\Events\Web\InvitationWasCreated;
use App\Events\Web\ExhibitWasTransferredToArtist;
use App\Listeners\Web\SendInvitationMailToGuest;
use App\Listeners\Web\SendExhibitTransferMailToArtist;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserWasCreated::class => [
            SendEmailToUserToActivateAccount::class,
        ],
        UserWasRegistered::class => [
            SendWelcomeMailToNewMember::class,
        ],     
        InvitationWasCreated::class => [
            SendInvitationMailToGuest::class,
        ],
        ExhibitWasTransferredToArtist::class => [
            SendExhibitTransferMailToArtist::class,
        ],        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
