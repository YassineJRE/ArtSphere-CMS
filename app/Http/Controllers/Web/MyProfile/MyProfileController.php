<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Enums\ArtPracticeType;
use App\Enums\ArtistType;
use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\MyProfile\MyProfile\ShowRequest;
use App\Http\Requests\Web\MyProfile\MyProfile\StoreRequest;
use App\Http\Requests\Web\MyProfile\MyProfile\EditRequest;
use App\Http\Requests\Web\MyProfile\MyProfile\UpdateRequest;
use App\Http\Requests\Web\MyProfile\MyProfile\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyProfile\ToggleEnableRequest;
use App\Services\Web\MyProfile\MyProfileService;

class MyProfileController extends BaseController
{
    public function __construct(MyProfileService $service)
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
        if (auth()->user()->hasProfileArtist()) {
            return redirect()
                ->route('my-profile.show',[
                    'my_profile' => auth()->user()->profileArtist()->id
                ]);
        }

        return view('my-profile.index');
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyProfile\ShowRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.show', [
            'profile' => $myProfile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyProfile\EditRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.edit', [
            'profile' => $myProfile,
            'statuses' => EnumStatus::shortPublish(),
            'artistTypes' => ArtistType::list(),
            'artPracticeTypes' => ArtPracticeType::list()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyProfile\UpdateRequest $request
     * @param App\Models\UserProfile                      $myProfile
     *
     * @return void
     */
    public function update(UpdateRequest $request, UserProfile $myProfile)
    {
        try {
            $myProfile = $this->service->update($myProfile, $request->all());

            return redirect()
                ->route('my-profile.show',['my_profile' => $myProfile->id ])
                ->withSuccess(__('my-profile.message.success.profile-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyProfile\DestroyRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile)
    {
        try {
            $this->service->destroy($myProfile);

            return redirect()
                ->route('my-account.index')
                ->withSuccess(__('my-profile.message.success.profile-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyProfile\ToggleEnableRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $myProfile)
    {
        try {
            $myProfile = $this->service->toggleEnable($myProfile);

            return redirect()
                ->route('my-profile.show', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(
                    $myProfile->isEnabled() ?
                    __('my-profile.message.success.profile-enabled') :
                    __('my-profile.message.success.profile-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
	
}
