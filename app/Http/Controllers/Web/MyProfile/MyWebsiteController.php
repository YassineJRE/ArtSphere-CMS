<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\MediaCollection as EnumMediaCollection;
use App\Enums\Status as EnumStatus;
use App\Models\UserProfile;
use App\Models\WebsiteGroup;
use App\Models\Website;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyProfile\MyWebsite\IndexRequest;
use App\Http\Requests\Web\MyProfile\MyWebsite\CreateRequest;
use App\Http\Requests\Web\MyProfile\MyWebsite\ShowRequest;
use App\Http\Requests\Web\MyProfile\MyWebsite\StoreRequest;
use App\Http\Requests\Web\MyProfile\MyWebsite\EditRequest;
use App\Http\Requests\Web\MyProfile\MyWebsite\UpdateRequest;
use App\Http\Requests\Web\MyProfile\MyWebsite\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyWebsite\ChangePositionRequest;
use App\Services\Web\MyProfile\MyWebsiteService;

class MyWebsiteController extends BaseController
{
    public function __construct(MyWebsiteService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsite\IndexRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup)
    {
        return view('my-profile.my-website-group.my-website.index', [
            'myProfile' => $myProfile,
            'myWebsiteGroup' => $myWebsiteGroup,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsite\CreateRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup)
    {
        return view('my-profile.my-website-group.my-website.create', [
            'myProfile' => $myProfile,
            'myWebsiteGroup' => $myWebsiteGroup,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsite\StoreRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return void
     */
    public function store(StoreRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup)
    {
        try {
            $data = $request->all();
            $data['parent_id'] = $myWebsiteGroup->id;
            $myWebsite = $this->service->store($data);

            if ($request->has('media')) {
                $myWebsite->clearMediaCollection(EnumMediaCollection::DEFAULT);
                $media = $myWebsite->addMedia($request->media)
                            ->toMediaCollection(EnumMediaCollection::DEFAULT);
            }

            return redirect()
                ->route('my-profile.my-website-groups.show', [
                    'my_profile' => $myProfile->id,
                    'my_website_group' => $myWebsiteGroup->id,
                ])
                ->withSuccess(__('my-website.message.success.website-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsite\ShowRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     * @param App\Models\Website $myWebsite
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup, Website $myWebsite)
    {
        return view('my-profile.my-website-group.my-website.show', [
            'myProfile' => $myProfile,
            'myWebsiteGroup' => $myWebsiteGroup,
            'myWebsite' => $myWebsite,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsite\EditRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     * @param App\Models\Website $myWebsite
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup, Website $myWebsite)
    {
        return view('my-profile.my-website-group.my-website.edit', [
            'myProfile' => $myProfile,
            'myWebsiteGroup' => $myWebsiteGroup,
            'myWebsite' => $myWebsite,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsite\UpdateRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup                                    $myWebsiteGroup
     * @param App\Models\Website $myWebsite
     *
     * @return void
     */
    public function update(UpdateRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup, Website $myWebsite)
    {
        try {
            $myWebsite = $this->service->update($myWebsite, $request->all());

            if ($request->has('media')) {
                $myWebsite->clearMediaCollection(EnumMediaCollection::DEFAULT);
                $media = $myWebsite->addMedia($request->media)
                            ->toMediaCollection(EnumMediaCollection::DEFAULT);
            }

            return redirect()
                ->route('my-profile.my-website-groups.show', [
                    'my_profile' => $myProfile->id,
                    'my_website_group' => $myWebsiteGroup->id,
                ])
                ->withSuccess(__('my-website.message.success.website-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsite\DestroyRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     * @param App\Models\Website $myWebsite
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup, Website $myWebsite)
    {
        try {
            $this->service->destroy($myWebsite);

            return redirect()
                ->route('my-profile.my-website-groups.show', [
                    'my_profile' => $myProfile->id,
                    'my_website_group' => $myWebsiteGroup->id,
                ])
                ->withSuccess(__('my-website.message.success.website-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Website
     *
     * @param App\Http\Requests\Web\MyProfile\MyWebsite\ChangePositionRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     * @param App\Models\Website $myWebsite
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, UserProfile $myProfile, WebsiteGroup $myWebsiteGroup, Website $myWebsite, int $position)
    {
        try {
            $this->service->changePosition($myWebsite, $position);

            return back();

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }  
}
