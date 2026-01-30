<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\InstitutionType as EnumInstitutionType;
use App\Enums\Status as EnumStatus;
use App\Models\UserProfile;
use App\Models\Group;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\IndexRequest;
use App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\CreateRequest;
use App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\ShowRequest;
use App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\StoreRequest;
use App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\ToggleEnableRequest;
use App\Services\Web\MyProfile\MyArtistRunCenterGalleryService;

class MyArtistRunCenterGalleryController extends BaseController
{
    public function __construct(MyArtistRunCenterGalleryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\IndexRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param string $profileType
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $myProfile, string $profileType)
    {
        return view('my-profile.my-artist-run-center-gallery.index', [
            'myProfile' => $myProfile
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\CreateRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-artist-run-center-gallery.create', [
            'myProfile' => $myProfile,
            'institutionTypes' => EnumInstitutionType::list(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\StoreRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return void
     */
    public function store(StoreRequest $request, UserProfile $myProfile)
    {
        try {
            $data = $request->validated();
            $data['profile'] = $myProfile;
            $myArtistRunCenterGallery = $this->service->store($data);

            return redirect()
                ->route('my-profile.my-artist-run-center-gallery.show', [
                    'my_profile' => $myProfile->id,
                    'my_artist_run_center_gallery' => $myArtistRunCenterGallery->id
                ])
                ->withSuccess(__('my-artist-run-center-gallery.message.success.artist-run-center-galleries-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\ShowRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Group $myArtistRunCenterGallery
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $myProfile, Group $myArtistRunCenterGallery)
    {
        return view('my-profile.my-artist-run-center-gallery.show', [
            'myProfile' => $myProfile,
            'myArtistRunCenterGallery' => $myArtistRunCenterGallery
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\DestroyRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Group $myArtistRunCenterGallery
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile, Group $myArtistRunCenterGallery)
    {
        try {
            $this->service->destroy($myArtistRunCenterGallery);

            return redirect()->route('my-account.index')
                ->withSuccess(__('my-artist-run-center-gallery.message.success.artist-run-center-galleries-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtistRunCenterGallery\ToggleEnableRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Group $myArtistRunCenterGallery
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $myProfile, Group $myArtistRunCenterGallery)
    {
        try {
            $myArtistRunCenterGallery = $this->service->toggleEnable($myArtistRunCenterGallery);

            return redirect()
                ->route('my-profile.my-artist-run-center-gallery.show', [
                    'my_profile' => $myProfile->id,
                    'my_artist_run_center_gallery' => $myArtistRunCenterGallery->id
                ])
                ->withSuccess(
                    $myArtistRunCenterGallery->isEnabled() ?
                    __('my-artist-run-center-gallery.message.success.artist-run-center-gallery-enabled') :
                    __('my-artist-run-center-gallery.message.success.artist-run-center-gallery-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
	
	//GALLERY INVITATION FEATURE
	//Create user_profile to make the new gallery work
	
	public function createUserProfileForGallery(UserProfile $myProfile, $public_collector_id, $galleryname, $fname, $lname, $email)
    {
        try {
			            						
			$data = array(
			'name' => $galleryname,
			'address' => 'NA',
			'city' => 'NA',
			'country' => 'Canada',
			'email' => $email,
			'phone' => '000-000-0000',
			'mandate' => 'NA',
			'institution_type' => 4,
			'member_of' => '',
			'additional_information_title' => '',
			'additional_information_content' => '',
			'user_profile_id' => $public_collector_id,
		);

            $data['profile'] = $myProfile;
			//print_r($data['profile']);
							
            $myArtistRunCenterGallery = $this->service->store($data);
			
			return redirect('/invite-gallery/cuf/'.$myArtistRunCenterGallery->id.'/'.$public_collector_id);
						
            /*return redirect()
                ->route('my-profile.my-artist-run-center-gallery.show', [
                    'my_profile' => $myProfile->id,
                    'my_artist_run_center_gallery' => $myArtistRunCenterGallery->id
                ])
                ->withSuccess(__('my-artist-run-center-gallery.message.success.artist-run-center-galleries-created'));*/
        }
		
		catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
