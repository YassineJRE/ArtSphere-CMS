<?php

namespace App\Http\Controllers\Web\MyGroup;

use App\Enums\ArtPracticeType as EnumArtPracticeType;
use App\Enums\InstitutionType as EnumInstitutionType;
use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\MyGroup\MyGroup\ShowRequest;
use App\Http\Requests\Web\MyGroup\MyGroup\StoreRequest;
use App\Http\Requests\Web\MyGroup\MyGroup\EditRequest;
use App\Http\Requests\Web\MyGroup\MyGroup\UpdateRequest;
use App\Http\Requests\Web\MyGroup\MyGroup\DestroyRequest;
use App\Http\Requests\Web\MyGroup\MyGroup\ToggleEnableRequest;
use App\Services\Web\MyGroup\MyGroupService;
use App\Repositories\Web\MyGroup\MyGroupRepository;
use App\Models\UserProfile;
use App\Http\Controllers\Web\MyGroup\MemberController;
use App\Services\Web\MyGroup\MemberService;
use App\Repositories\Web\UserInvitationRepository;
use App\Repositories\Web\MyGroup\MemberRepository;

class MyGroupController extends BaseController
{
    public function __construct(MyGroupService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyGroup\ShowRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $myGroup)
    {
		//print_r($myGroup);
		
        return view('my-group.show', [
            'group' => $myGroup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyGroup\EditRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, Group $myGroup)
    {
        return view('my-group.edit', [
            'group' => $myGroup,
            'artPracticeTypes' => EnumArtPracticeType::list(),
            'institutionTypes' => EnumInstitutionType::list(),
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyGroup\UpdateRequest $request
     * @param App\Models\Group                      $myGroup
     *
     * @return void
     */
    public function update(UpdateRequest $request, Group $myGroup)
    {
        try {
            $myGroup = $this->service->update($myGroup, $request->validated());

            return redirect()
                ->route('my-group.show',['my_group' => $myGroup->id ])
                ->withSuccess(__('my-group.message.success.group-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyGroup\DestroyRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $myGroup)
    {
        try {
            $this->service->destroy($myGroup);

            return redirect()
                ->route('my-account.index')
                ->withSuccess(__('my-group.message.success.group-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyGroup\ToggleEnableRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, Group $myGroup)
    {
        try {
            $myGroup = $this->service->toggleEnable($myGroup);

            return redirect()
                ->route('my-group.show', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(
                    $myGroup->isEnabled() ?
                    __('my-group.message.success.group-enabled') :
                    __('my-group.message.success.group-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
	
	//GALLERY INVITATION FEATURE
	//Return list of galleries
	
	public function getGalleries(){
		
		return Group::where('institution_type', 'university-gallery')->get("name");
		
	}
	
	//GALLERY INVITATION FEATURE
	// Update user_has_groups table with invited user_profile ID
	
	public function updateInvitedUser($groupId, $userId){

		try {
			
			$userProfile = UserProfile::where("id", $userId)->first();
									
			$data = array(
    'name' => '',
    'address' => '',
    'city' => '',
    'country' => '',
    'email' => '',
    'phone' => 0000000000,
    'mandate' => '',
    'institution_type' => 'university-gallery',
    'member_of' => '',
    'additional_information_title' => '',
    'additional_information_content' => '',
    'profile' => array(
        'id' => $userId,
        'user_id' => null,
        'type' => 'public-collector',
        'artist_name' => '',
        'other_artist_name' => '',
        'pronoun' => '',
        'last_name' => '',
        'first_name' => '',
        'username' => '',
        'artist_type' => '',
        'art_practice_type' => '',
        'email' => '',
        'address' => '',
        'country' => '',
        'ethnicity' => '',
        'biography' => '',
        'member_of' => '',
        'additional_information_title' => '',
        'additional_information_content' => '',
        'created_at' => '',
        'updated_at' => '',
        'deleted_at' => '',
        'status' => 'enabled',
        'specify_artist_type' => '',
        'specify_art_practice_type' => ''
    )
);
			
			$this->service->updateUserProfileForGallery($data, $groupId, $userId);
			
			$inviteData = [
				'guest_id' => null,
				'inviter_id' => 1,
				'subject_type' => 'App\Models\Group', // or 'Exhibit' based on your application logic
				'subject_id' => $groupId,
				'first_name' => $userProfile->first_name,
				'last_name' => $userProfile->last_name,
				'email' => $userProfile->email,
				'sent_at' => now(), // assuming you want to set the current timestamp
				'send_copy' => 0, // or 0 based on your application logic
				'linked_to_user_profile_id' => $userId, // set to an integer value if needed
			];
			
			//Invite new user

			$inv = new UserInvitationRepository();
			$invMR = new MemberRepository();
			
			$memberService = new MemberService($invMR, $inv);

			//$memberController = new MemberController($memberService);

			$inviteUser = $memberService->processInvite($inviteData, $data);
						
			return redirect("/invite-gallery/success/$groupId");
						
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
		
	}
	
	public function GalleryCreatedSuccessfully(){
		
		echo str_replace('/invite-gallery/success/', '', $_SERVER['REQUEST_URI']);
		
	}
}
