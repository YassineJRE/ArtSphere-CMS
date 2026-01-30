<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Enums\VerifiedStatus;
use Exception;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\ExhibitType;
use App\Enums\Status as EnumStatus;
use App\Models\UserProfile;
use App\Models\Exhibit;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyProfile\MyExhibit\IndexRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\CreateRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\ShowRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\StoreRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\EditRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\UpdateRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\ToggleEnableRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\TransfertToRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\PostTransfertToRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\ChangePositionRequest;
use App\Http\Requests\Web\MyProfile\MyExhibit\InviteRequest;
use App\Services\Web\MyProfile\MyExhibitService;
use App\Models\Artwork;
use Illuminate\Http\Request;
use App\Models\CollectionItem;
use Illuminate\Support\Facades\Log;
class MyExhibitController extends BaseController
{
    public function __construct(MyExhibitService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\IndexRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-exhibit.index', [
            'myProfile' => $myProfile
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\CreateRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-exhibit.create', [
            'myProfile' => $myProfile,
            'exhibitTypes' => ExhibitType::list(),
            'statuses' => EnumStatus::longPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\StoreRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return void
     */
    public function store(StoreRequest $request, UserProfile $myProfile)
    {
        try {
            $data = $request->validated();
            $data['owner_type'] = UserProfile::class;
            $data['owner_id'] = $myProfile->id;
            $myExhibit = $this->service->store($data);

            if ($request->has('transfer')) {
                return redirect()
                    ->route('my-profile.my-exhibits.transfer-to', [
                        'my_profile' => $myProfile->id,
                        'my_exhibit' => $myExhibit->id,
                    ]);
            }

            return redirect()
                ->route('my-profile.my-exhibits.show', [
                    'my_profile' => $myProfile->id,
                    'my_exhibit' => $myExhibit->id,
                ])
                ->withSuccess(__('my-exhibit.message.success.exhibit-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\ShowRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        return view('my-profile.my-exhibit.show', [
            'myProfile' => $myProfile,
            'myExhibit' => $myExhibit,
            'exhibits' => $myProfile->exhibits()->where('id','<>',$myExhibit->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\EditRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
		
        return view('my-profile.my-exhibit.edit', [
            'myProfile' => $myProfile,
            'myExhibit' => $myExhibit,
            'exhibitTypes' => ExhibitType::list(),
            'statuses' => EnumStatus::longPublish(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\UpdateRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit                                    $myExhibit
     *
     * @return void
     */
    public function update(UpdateRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        try {
			
            $data = $request->validated();
            $changedFields = array_diff_assoc($data,$myExhibit->toArray());
            // Define an array of fields that trigger the change
            $fieldsToCheck = ['name', 'type', 'location', 'verifier_id'];

            // Check if any of the fields triggering the change exist in $changedFields
            if (!empty(array_intersect_key(array_flip($fieldsToCheck), $changedFields))) {
                $data['verified_status'] = VerifiedStatus::PENDING;
            }
			
			
            $this->service->update($myExhibit, $data);

            if ($request->has('transfer')) {
                return redirect()
                    ->route('my-profile.my-exhibits.transfer-to', [
                        'my_profile' => $myProfile->id,
                        'my_exhibit' => $myExhibit->id,
                    ]);
            }
			
            return redirect()
                ->route('my-profile.my-exhibits.index', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(__('my-exhibit.message.success.exhibit-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\DestroyRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        try {
						
            $this->service->destroy($myExhibit);

            return redirect()
                ->route('my-profile.my-exhibits.index', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(__('my-exhibit.message.success.exhibit-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\ToggleEnableRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        try {
            $myExhibit = $this->service->toggleEnable($myExhibit);

            return redirect()
                ->route('my-profile.my-exhibits.index', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(
                    $myExhibit->isEnabled() ?
                    __('my-exhibit.message.success.exhibit-enabled') :
                    __('my-exhibit.message.success.exhibit-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show form of Transfer To.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\TransfertToRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function transferTo(TransfertToRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        return view('my-profile.my-exhibit.transfer-to', [
            'myProfile' => $myProfile,
            'myExhibit' => $myExhibit,
            'profiles' => UserProfile::artists()->whereNot('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Request Transfer Exhibit To Profile
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\PostTransfertToRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function postTransferTo(PostTransfertToRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        try {

            if ( $myExhibit->canTransfer() )
            {
                $myExhibit = $this->service->transferTo($myExhibit, $request->validated());
            }

            if ( $myExhibit->isTransfered() ) {
                return redirect()
                ->route('my-profile.my-exhibits.index', [
                    'my_profile' => $myProfile->id,
                ])
                ->withSuccess(
                    __('my-exhibit.message.success.exhibit-has-been-transfered')
                );
            }

            return redirect()
            ->route('my-profile.my-exhibits.show', [
                'my_profile' => $myProfile->id,
                'my_exhibit' => $myExhibit->id,
            ])
            ->withSuccess(
                __('my-exhibit.message.success.exhibit-has-not-been-transfered')
            );
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Invite someone to artolog.
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\InviteRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return void
     */
    public function processInvite(InviteRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        try {
            $data = $request->validated();
            $data['subject_type'] = Exhibit::class;
            $data['subject_id'] = $myExhibit->id;
            $data['inviter_id'] = $request->user()->id;
            $invitation = $this->service->processInvite($data);
			
            return redirect()
                ->route('my-profile.my-exhibits.show', [
                    'my_profile' => $myProfile->id,
                    'my_exhibit' => $myExhibit->id,
                ])
                ->withSuccess(__('my-exhibit.message.success.invitation-sent'));
        } catch (MailException $e) {
            return back()->withErrors(__('my-exhibit.message.error.email-sending-failed'));
        } catch (Exception $e) {
            return back()->withErrors(__('my-exhibit.message.error.email-sending-failed'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Exhibit
     *
     * @param App\Http\Requests\Web\MyProfile\MyExhibit\ChangePositionRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, UserProfile $myProfile, Exhibit $myExhibit, int $position)
    {
        try {
            $this->service->changePosition($myExhibit, $position);

            return back();

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
	
	//GALLERY INVITATION FEATURE
	//Proccess invite for gallery member
	
	public function processInviteForGallery(InviteRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        try {
            $data = $request->validated();
            $data['subject_type'] = Exhibit::class;
            $data['subject_id'] = $myExhibit->id;
            $data['inviter_id'] = $request->user()->id;
            $invitation = $this->service->processInvite($data);

/*
            return redirect()
                ->route('my-profile.my-exhibits.show', [
                    'my_profile' => $myProfile->id,
                    'my_exhibit' => $myExhibit->id,
                ])
                ->withSuccess(__('my-exhibit.message.success.invitation-sent'));*/

        } catch (MailException $e) {
            return back()->withErrors(__('my-exhibit.message.error.email-sending-failed'));
        } catch (Exception $e) {
            return back()->withErrors(__('my-exhibit.message.error.email-sending-failed'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
	

	/**
     * Retrieve Artworks Ids
     *
     * @param Illuminate\Http\Request; $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $exhibit
     * @param int $position
     *
     * @return Renderable
     */
	public function retrieveArtworksIds(Request $request, UserProfile $myProfile, Exhibit $exhibit){
        // Get the current logged-in user
        $currentUser = auth()->user();
        Log::info('artowrks request for ', ["exhibit"=> $exhibit, "profile"=>$myProfile, "logged_in_user" => $currentUser]);
        // Check if the owner_id of the exhibit matches the current user's ID
        if ($currentUser->id !== $myProfile->user_id ||$exhibit->owner_id !== $myProfile->id) {
            // Handle case where user is not the owner of the exhibit
            return response('Unauthorized', 401);
        }

        // Get all artworks related to the exhibit
        $artworks = Artwork::where('exhibit_id', $exhibit->id)->get();
        // Initialize artworkData as an empty array
        $artworkData = [];
        
        // Loop through each artwork
        foreach ($artworks as $artwork) {
            
            // Get the first media for the artwork
            $media = $artwork->getFirstMedia();

            // Check if media exists and its type is 'image'
            if ($media && strpos($media->mime_type, 'image') !== false) {
                $image = $media->original_url; // Use the original URL for images
            } else {
                $image = '/img/grey.png'; // Use a default image for non-image media
            }

            $artworkData[] = [
                'id' => $artwork->id,
                'name' => $artwork->name,
                'location' => $artwork->location,
                'date' => $artwork->date,
                'image' => $image
            ];
        }
        
        return response()->json($artworkData);

    }

}
