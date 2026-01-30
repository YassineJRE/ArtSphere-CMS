<?php

namespace App\Http\Controllers\Web\MyAccount;

use App\Enums\ArtPracticeType as EnumArtPracticeType;
use App\Enums\ArtistType as EnumArtistType;
use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\MyAccount\MyPublicCollectorProfile\ShowRequest;
use App\Http\Requests\Web\MyAccount\MyPublicCollectorProfile\StoreRequest;
use App\Http\Requests\Web\MyAccount\MyPublicCollectorProfile\DestroyRequest;
use App\Http\Requests\Web\MyAccount\MyPublicCollectorProfile\ToggleEnableRequest;
use App\Services\Web\MyAccount\MyPublicCollectorProfileService;

class MyPublicCollectorProfileController extends BaseController
{
    public function __construct(MyPublicCollectorProfileService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a text for create account.
     *
     * @return Renderable
     */
    public function index()
    {
        if (auth()->user()->hasProfilePublicCollector()) {
            return redirect()
                ->route('my-account.public-collector-profile.show',[
                    'public_collector_profile' => auth()->user()->profilePublicCollector()->id
                ]);
        }

        return view('my-account.my-public-collector-profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('my-account.my-public-collector-profile.create',[
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyPublicCollectorProfile\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {
            $publicCollectorProfile = $this->service->store($request->all());

            return redirect()
                ->route('my-account.public-collector-profile.show',['public_collector_profile' => $publicCollectorProfile->id ])
                ->withSuccess(__('my-public-collector-profile.message.success.public-collector-profile-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyAccount\MyPublicCollectorProfile\ShowRequest $request
     * @param App\Models\UserProfile $publicCollectorProfile
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $publicCollectorProfile)
    {
        return view('my-account.my-public-collector-profile.show', [
            'profile' => $publicCollectorProfile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyPublicCollectorProfile\DestroyRequest $request
     * @param App\Models\UserProfile $publicCollectorProfile
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $publicCollectorProfile)
    {
        try {
            $this->service->destroy($publicCollectorProfile);

            return redirect()
                ->route('my-account.index')
                ->withSuccess(__('my-public-collector-profile.message.success.public-collector-profile-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyPublicCollectorProfile\ToggleEnableRequest $request
     * @param App\Models\UserProfile $publicCollectorProfile
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $publicCollectorProfile)
    {
        try {
            $publicCollectorProfile = $this->service->toggleEnable($publicCollectorProfile);

            return redirect()
                ->route('my-account.public-collector-profile.show', [
                    'public_collector_profile' => $publicCollectorProfile->id
                ])
                ->withSuccess(
                    $publicCollectorProfile->isEnabled() ?
                    __('my-public-collector-profile.message.success.public-collector-profile-enabled') :
                    __('my-public-collector-profile.message.success.public-collector-profile-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
	
	//GALLERY INVITATION FEATURE
	//Create public_collector profile
	
	public function createPublicCollectorProfileForGallery(StoreRequest $request)
    {
        try {

			//print_r($request->gallery_name);
				
            $publicCollectorProfile = $this->service->store($request->all());
			
			$publicCollectorProfile->update(['user_id' => 0]);

			return redirect("/invite-gallery/".$publicCollectorProfile->id."/".$request->gallery_name."/".$publicCollectorProfile->first_name."/".$publicCollectorProfile->last_name."/".$publicCollectorProfile->email);

			//return redirect()->route('invitegallery', ['public_collector_id' => $publicCollectorProfile->id]);		

            /*return redirect()
                ->route('my-account.public-collector-profile.show',['public_collector_profile' => $publicCollectorProfile->id ])
                ->withSuccess(__('my-public-collector-profile.message.success.public-collector-profile-created'));*/
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
