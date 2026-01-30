<?php

namespace App\Http\Controllers\Web\MyAccount;

use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\MyAccount\MyCuratorProfile\ShowRequest;
use App\Http\Requests\Web\MyAccount\MyCuratorProfile\StoreRequest;
use App\Http\Requests\Web\MyAccount\MyCuratorProfile\DestroyRequest;
use App\Http\Requests\Web\MyAccount\MyCuratorProfile\ToggleEnableRequest;
use App\Services\Web\MyAccount\MyCuratorProfileService;

class MyCuratorProfileController extends BaseController
{
    public function __construct(MyCuratorProfileService $service)
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
        if (auth()->user()->hasProfileCurator()) {
            return redirect()
                ->route('my-account.curator-profile.show',[
                    'curator_profile' => auth()->user()->profileCurator()->id
                ]);
        }

        return view('my-account.my-curator-profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('my-account.my-curator-profile.create',[
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyCuratorProfile\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {
            $curatorProfile = $this->service->store($request->all());

            return redirect()
                ->route('my-account.curator-profile.show',['curator_profile' => $curatorProfile->id ])
                ->withSuccess(__('my-curator-profile.message.success.curator-profile-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyAccount\MyCuratorProfile\ShowRequest $request
     * @param App\Models\UserProfile $curatorProfile
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $curatorProfile)
    {
        return view('my-account.my-curator-profile.show', [
            'profile' => $curatorProfile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyCuratorProfile\DestroyRequest $request
     * @param App\Models\UserProfile $curatorProfile
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $curatorProfile)
    {
        try {
            $this->service->destroy($curatorProfile);

            return redirect()
                ->route('my-account.index')
                ->withSuccess(__('my-curator-profile.message.success.curator-profile-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyCuratorProfile\ToggleEnableRequest $request
     * @param App\Models\UserProfile $curatorProfile
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $curatorProfile)
    {
        try {
            $curatorProfile = $this->service->toggleEnable($curatorProfile);

            return redirect()
                ->route('my-account.curator-profile.show', [
                    'curator_profile' => $curatorProfile->id
                ])
                ->withSuccess(
                    $curatorProfile->isEnabled() ?
                    __('my-curator-profile.message.success.curator-profile-enabled') :
                    __('my-curator-profile.message.success.curator-profile-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
