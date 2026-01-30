<?php

namespace App\Http\Controllers\Web\MyGroup;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\Status as EnumStatus;
use App\Enums\WebsiteGroupType as EnumWebsiteGroupType;
use App\Models\Group;
use App\Models\WebsiteGroup;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\IndexRequest;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\CreateRequest;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\ShowRequest;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\StoreRequest;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\EditRequest;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\UpdateRequest;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\DestroyRequest;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\ToggleEnableRequest;
use App\Http\Requests\Web\MyGroup\MyWebsiteGroup\ChangePositionRequest;
use App\Services\Web\MyGroup\MyWebsiteGroupService;

class MyWebsiteGroupController extends BaseController
{
    public function __construct(MyWebsiteGroupService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\IndexRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, Group $myGroup)
    {
        return view('my-group.my-website-group.index', [
            'myGroup' => $myGroup
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\CreateRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, Group $myGroup)
    {
        return view('my-group.my-website-group.create', [
            'myGroup' => $myGroup,
            'statuses' => EnumStatus::shortPublish(),
            'websiteGroupTypes' => EnumWebsiteGroupType::list(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\StoreRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return void
     */
    public function store(StoreRequest $request, Group $myGroup)
    {
        try {
            $data = $request->all();
            $data['owner_type'] = Group::class;
            $data['owner_id'] = $myGroup->id;
            $myWebsiteGroup = $this->service->store($data);

            return redirect()
                ->route('my-group.my-website-groups.show', [
                    'my_group' => $myGroup->id,
                    'my_website_group' => $myWebsiteGroup->id,
                ])
                ->withSuccess(__('my-group-website-group.message.success.website-group-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\ShowRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $myGroup, WebsiteGroup $myWebsiteGroup)
    {
        return view('my-group.my-website-group.show', [
            'myGroup' => $myGroup,
            'myWebsiteGroup' => $myWebsiteGroup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\EditRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, Group $myGroup, WebsiteGroup $myWebsiteGroup)
    {
        return view('my-group.my-website-group.edit', [
            'myGroup' => $myGroup,
            'myWebsiteGroup' => $myWebsiteGroup,
            'statuses' => EnumStatus::shortPublish(),
            'websiteGroupTypes' => EnumWebsiteGroupType::list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\UpdateRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\WebsiteGroup                                    $myWebsiteGroup
     *
     * @return void
     */
    public function update(UpdateRequest $request, Group $myGroup, WebsiteGroup $myWebsiteGroup)
    {
        try {
            $this->service->update($myWebsiteGroup, $request->validated());

            return redirect()
                ->route('my-group.my-website-groups.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-website-group.message.success.website-group-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\DestroyRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $myGroup, WebsiteGroup $myWebsiteGroup)
    {
        try {
            $this->service->destroy($myWebsiteGroup);

            return redirect()
                ->route('my-group.my-website-groups.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-website-group.message.success.website-group-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\ToggleEnableRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, Group $myGroup, WebsiteGroup $myWebsiteGroup)
    {
        try {
            $myWebsiteGroup = $this->service->toggleEnable($myWebsiteGroup);

            return redirect()
                ->route('my-group.my-website-groups.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(
                    $myWebsiteGroup->isEnabled() ?
                    __('my-group-website-group.message.success.website-group-enabled') :
                    __('my-group-website-group.message.success.website-group-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this WebsiteGroup
     *
     * @param App\Http\Requests\Web\MyGroup\MyWebsiteGroup\ChangePositionRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\WebsiteGroup $myWebsiteGroup
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, Group $myGroup, WebsiteGroup $myWebsiteGroup, int $position)
    {
        try {
            $this->service->changePosition($myWebsiteGroup, $position);

            return back();

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }        
}
