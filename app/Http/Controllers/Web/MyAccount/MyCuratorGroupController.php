<?php

namespace App\Http\Controllers\Web\MyAccount;

use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\MyAccount\MyCuratorGroup\ShowRequest;
use App\Http\Requests\Web\MyAccount\MyCuratorGroup\StoreRequest;
use App\Http\Requests\Web\MyAccount\MyCuratorGroup\DestroyRequest;
use App\Http\Requests\Web\MyAccount\MyCuratorGroup\ToggleEnableRequest;
use App\Services\Web\MyAccount\MyCuratorGroupService;

class MyCuratorGroupController extends BaseController
{
    public function __construct(MyCuratorGroupService $service)
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
        return view('my-account.my-curator-group.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('my-account.my-curator-group.create',[
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyCuratorGroup\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {

            $curatorGroup = $this->service->store($request->validated());

            return redirect()
                ->route('my-account.curator-group.show',['curator_group' => $curatorGroup->id ])
                ->withSuccess(__('my-curator-group.message.success.curator-group-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyAccount\MyCuratorGroup\ShowRequest $request
     * @param App\Models\Group $curatorGroup
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $curatorGroup)
    {
        return view('my-account.my-curator-group.show', [
            'group' => $curatorGroup
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyCuratorGroup\DestroyRequest $request
     * @param App\Models\Group $curatorGroup
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $curatorGroup)
    {
        try {
            $this->service->destroy($curatorGroup);

            return redirect()
                ->route('my-account.index')
                ->withSuccess(__('my-curator-group.message.success.curator-group-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyCuratorGroup\ToggleEnableRequest $request
     * @param App\Models\Group $curatorGroup
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, Group $curatorGroup)
    {
        try {
            $curatorGroup = $this->service->toggleEnable($curatorGroup);

            return redirect()
                ->route('my-account.curator-group.show', [
                    'curator_group' => $curatorGroup->id
                ])
                ->withSuccess(
                    $curatorGroup->isEnabled() ?
                    __('my-curator-group.message.success.curator-group-enabled') :
                    __('my-curator-group.message.success.curator-group-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
