<?php

namespace App\Http\Controllers\Web\MyAccount;

use App\Enums\ArtPracticeType as EnumArtPracticeType;
use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\Web\MyAccount\MyArtistGroup\ShowRequest;
use App\Http\Requests\Web\MyAccount\MyArtistGroup\StoreRequest;
use App\Http\Requests\Web\MyAccount\MyArtistGroup\DestroyRequest;
use App\Http\Requests\Web\MyAccount\MyArtistGroup\ToggleEnableRequest;
use App\Services\Web\MyAccount\MyArtistGroupService;

class MyArtistGroupController extends BaseController
{
    public function __construct(MyArtistGroupService $service)
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
        return view('my-account.my-artist-group.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('my-account.my-artist-group.create',[
            'artPracticeTypes' => EnumArtPracticeType::list(),
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyArtistGroup\StoreRequest $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        try {

            $artistGroup = $this->service->store($request->validated());

            return redirect()
                ->route('my-account.artist-group.show',['artist_group' => $artistGroup->id ])
                ->withSuccess(__('my-artist-group.message.success.artist-group-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyAccount\MyArtistGroup\ShowRequest $request
     * @param App\Models\Group $artistGroup
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $artistGroup)
    {
        return view('my-account.my-artist-group.show', [
            'group' => $artistGroup
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyArtistGroup\DestroyRequest $request
     * @param App\Models\Group $artistGroup
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $artistGroup)
    {
        try {
            $this->service->destroy($artistGroup);

            return redirect()
                ->route('my-account.index')
                ->withSuccess(__('my-artist-group.message.success.artist-group-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyAccount\MyArtistGroup\ToggleEnableRequest $request
     * @param App\Models\Group $artistGroup
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, Group $artistGroup)
    {
        try {
            $artistGroup = $this->service->toggleEnable($artistGroup);

            return redirect()
                ->route('my-account.artist-group.show', [
                    'artist_group' => $artistGroup->id
                ])
                ->withSuccess(
                    $artistGroup->isEnabled() ?
                    __('my-artist-group.message.success.artist-group-enabled') :
                    __('my-artist-group.message.success.artist-group-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
