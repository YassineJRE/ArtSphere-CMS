<?php

namespace App\Http\Controllers\Web\MyAccount;

use App\Enums\ArtPracticeType;
use App\Enums\ArtistType;
use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\MyAccount\MyArtistProfile\ShowRequest;
use App\Http\Requests\Web\MyAccount\MyArtistProfile\StoreRequest;
use App\Http\Requests\Web\MyAccount\MyArtistProfile\DestroyRequest;
use App\Http\Requests\Web\MyAccount\MyArtistProfile\ToggleEnableRequest;
use App\Services\Web\MyAccount\MyArtistProfileService;

class MyArtistProfileController extends BaseController
{
    public function __construct(MyArtistProfileService $service)
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
                ->route('my-account.artist-profile.show',[
                    'artist_profile' => auth()->user()->profileArtist()->id
                ]);
        }

        return view('my-account.my-artist-profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('my-account.my-artist-profile.create',[
            'artistTypes' => ArtistType::list(),
            'artPracticeTypes' => ArtPracticeType::list(),
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyArtistProfile\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {
            $artistProfile = $this->service->store($request->all());

            return redirect()
                ->route('my-account.artist-profile.show',['artist_profile' => $artistProfile->id ])
                ->withSuccess(__('my-artist-profile.message.success.artist-profile-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyAccount\MyArtistProfile\ShowRequest $request
     * @param App\Models\UserProfile $artistProfile
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $artistProfile)
    {
        return view('my-account.my-artist-profile.show', [
            'profile' => $artistProfile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyArtistProfile\DestroyRequest $request
     * @param App\Models\UserProfile $artistProfile
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $artistProfile)
    {
        try {
            $this->service->destroy($artistProfile);

            return redirect()
                ->route('my-account.index')
                ->withSuccess(__('my-artist-profile.message.success.artist-profile-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyArtistProfile\ToggleEnableRequest $request
     * @param App\Models\UserProfile $artistProfile
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $artistProfile)
    {
        try {
            $artistProfile = $this->service->toggleEnable($artistProfile);

            return redirect()
                ->route('my-account.artist-profile.show', [
                    'artist_profile' => $artistProfile->id
                ])
                ->withSuccess(
                    $artistProfile->isEnabled() ?
                    __('my-artist-profile.message.success.artist-profile-enabled') :
                    __('my-artist-profile.message.success.artist-profile-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
