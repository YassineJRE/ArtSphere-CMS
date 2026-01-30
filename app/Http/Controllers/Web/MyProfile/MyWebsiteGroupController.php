<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\Status as EnumStatus;
use App\Enums\WebsiteGroupType as EnumWebsiteGroupType;
use App\Models\UserProfile;
use App\Models\WebsiteGroup;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\IndexRequest;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\CreateRequest;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\ShowRequest;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\StoreRequest;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\EditRequest;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\UpdateRequest;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\ToggleEnableRequest;
use App\Http\Requests\Web\MyProfile\MyWebsiteGroup\ChangePositionRequest;
use App\Services\Web\MyProfile\MyWebsiteGroupService;

class MyWebsiteGroupController extends BaseController
{
    public function __construct(MyWebsiteGroupService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\IndexRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-website-group.index', [
            'myProfile' => $myProfile
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\CreateRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-website-group.create', [
            'myProfile' => $myProfile,
            'statuses' => EnumStatus::shortPublish(),
            'websiteGroupTypes' => EnumWebsiteGroupType::list(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\StoreRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return void
     */
    public function store(StoreRequest $request, UserProfile $myProfile)
    {
        try {
            $data = $request->all();
            $data['owner_type'] = UserProfile::class;
            $data['owner_id'] = $myProfile->id;
            $myWebsiteGroup = $this->service->store($data);

            return redirect()
                ->route('my-profile.my-website-groups.show', [
                    'my_profile' => $myProfile->id,
                    'my_website_group' => $myWebsiteGroup->id,
                ])
                ->withSuccess(__('my-website-group.message.success.website-group-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\ShowRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup)
    {
        return view('my-profile.my-website-group.show', [
            'myProfile' => $myProfile,
            'myWebsiteGroup' => $myWebsiteGroup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\EditRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup)
    {
        return view('my-profile.my-website-group.edit', [
            'myProfile' => $myProfile,
            'myWebsiteGroup' => $myWebsiteGroup,
            'statuses' => EnumStatus::shortPublish(),
            'websiteGroupTypes' => EnumWebsiteGroupType::list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\UpdateRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup                                    $myWebsiteGroup
     *
     * @return void
     */
    public function update(UpdateRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup)
    {
        try {
            $this->service->update($myWebsiteGroup, $request->validated());

            return redirect()
                ->route('my-profile.my-website-groups.index', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(__('my-website-group.message.success.website-group-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\DestroyRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup)
    {
        try {
            $this->service->destroy($myWebsiteGroup);

            return redirect()
                ->route('my-profile.my-website-groups.index', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(__('my-website-group.message.success.website-group-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\ToggleEnableRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup)
    {
        try {
            $myWebsiteGroup = $this->service->toggleEnable($myWebsiteGroup);

            return redirect()
                ->route('my-profile.my-website-groups.index', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(
                    $myWebsiteGroup->isEnabled() ?
                    __('my-website-group.message.success.website-group-enabled') :
                    __('my-website-group.message.success.website-group-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this WebsiteGroup
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsiteGroup\ChangePositionRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup, int $position)
    {
        try {
            $this->service->changePosition($myWebsiteGroup, $position);

            return back();

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }    
}
