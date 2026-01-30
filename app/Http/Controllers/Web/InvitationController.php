<?php

namespace App\Http\Controllers\Web;
use App\Enums\Status;
use Illuminate\Support\Facades\Log;
use App\Enums\LogEvent;
use App\Enums\LogName;
use App\Enums\ProfileType;
use App\Enums\GroupType;
use App\Exceptions\ServiceException;
use App\Models\UserInvitation;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Invitation\RegisterRequest;
use App\Http\Requests\Web\Invitation\RegisterProcessRequest;
use App\Http\Requests\Web\Invitation\GalleryInviteRequest;
use App\Services\Web\InvitationService;
use App\Services\Web\MyGroup\MemberService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\UserHasGroup;


class InvitationController extends BaseController
{
    public function __construct(InvitationService $service, MemberService $memberService)
    {
        $this->service = $service;
        $this->memberService = $memberService;
    }

    /**
     * Show the form for registering a new Member.
     *
     * @param App\Http\Requests\Web\Invitation\RegisterRequest $request
     * @param App\Models\UserInvitation $userInvitation
     * @param int $subjectId
     * @param string $token
     *
     * @return Renderable
     */
    public function registration(RegisterRequest $request, UserInvitation $userInvitation, int $subjectId, string $token)
    {
        $invitation = $this->service->findByToken($token);

        if (
            null == $invitation ||
            $invitation->id != $userInvitation->id ||
            $invitation->subject_id != $subjectId ||
            $invitation->email != $request->email
        ) {
            return response()->view('errors.link-expired', [], 403);
        }

        return view('invitation.registration', [
            'invitation' => $invitation
        ]);
    }

    /**
     * Handling The Form Submission for register new Member.
     *
     * @param App\Http\Requests\Web\Invitation\RegisterProcessRequest $request
     * @param App\Models\UserInvitation $userInvitation
     * @param int $subjectId
     * @param string $token
     *
     * @return void
     */
    public function register(RegisterProcessRequest $request, UserInvitation $userInvitation, int $subjectId, string $token)
    {
        $invitation = $this->service->findByToken($token);

        if (
            null == $invitation ||
            $invitation->id != $userInvitation->id ||
            $invitation->subject_id != $subjectId ||
            $invitation->email != $request->email
        ) {
            return response()->view('errors.link-expired', [], 403);
        }

        try {
            $user = $this->service->register($request->validated(), $invitation);
            Auth::login($user);
            activity(LogName::USER)
                ->causedBy($user)
                ->event(LogEvent::REGISTERED)
                ->withProperties([
                    'ip' => $request->ip(),
                    'guard' => 'web',
                ])
                ->log(LogName::USER.'.'.LogEvent::REGISTERED);

			
            //Check if invite was done by creating a Gallery, redirect doesn't seem to happen after creation of user
			if($userInvitation->is_admin){			
				return redirect()->route('my-group.edit',['my_group'=>$subjectId]);
			}			
						
            return redirect()->route('app.home')
                ->withSuccess(__('invitation.message.success.registered-successfully'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
    public function galleryInvite(GalleryInviteRequest $request, User $inviter){
        $requestData = $request->validated();
        $galleryData = [
			'name' => $requestData["gallery_name"],
			'email' => $requestData["email"],
			'type' => GroupType::ARTIST_RUN_CENTER_ORG,
            'status' => Status::DRAFT
		];
							
        $myArtistRunCenterGallery = $this->service->createGallery($galleryData);

        $inviteData = [
            'guest_id' => null,
            'inviter_id' => $inviter->id,
            'subject_type' => 'App\Models\Group',
            'subject_id' => $myArtistRunCenterGallery->id,
            "first_name" => $requestData["first_name"],
            "last_name"=> $requestData["last_name"],
            'email' => $requestData["email"],
            'sent_at' => now(),
            'send_copy' => 0, 
            'isAdmin' => true,
        ];

        $invite = $this->memberService->processInvite($inviteData);
        $returnData = ['gallery-id'=>$myArtistRunCenterGallery->id,'gallery-name'=>$myArtistRunCenterGallery->name,'invite-id'=>$invite->id];
        return response()->json($returnData);
    }
}
