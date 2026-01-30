<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserInvitation;
use App\Models\Group;
use App\Models\Exhibit;
use Illuminate\Console\Command;
use Mail;
use App\Emails\Web\WelcomeToNewMember;
use App\Emails\Web\InviteToJoinGroup;
use App\Emails\Web\InviteToTransferExhibit;

class SendEmailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to Super Admin for test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
/*        
        $userInvitation = UserInvitation::whereNotNull('token')->where('token','<>','')->where('subject_type', Group::class)->first();

        if ($userInvitation) {
            Mail::to($userInvitation)->locale('fr')->send(new InviteToJoinGroup($userInvitation));
            $this->info('Email sent!');
        } else {
            $this->error('Email not sent!');
        }
*/
        $superAdmin = User::where('email', env('SUPER_ADMIN_EMAIL'))->first();

        if ($superAdmin) {
            Mail::to($superAdmin)->locale('fr')->send(new WelcomeToNewMember($superAdmin));
            $this->info("Email sent to $superAdmin->email");
        } else {
            $this->error('Email not sent!');
        }
    }
}
