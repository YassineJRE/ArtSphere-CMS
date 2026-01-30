<?php

namespace App\Http\Controllers\Web\MyGroup;

use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\MyGroup\MyCollection\ChangePositionRequest;
use App\Http\Requests\Web\MyGroup\MyCollection\CreateRequest;
use App\Http\Requests\Web\MyGroup\MyCollection\DestroyRequest;
use App\Http\Requests\Web\MyGroup\MyCollection\EditRequest;
use App\Http\Requests\Web\MyGroup\MyCollection\IndexRequest;
use App\Http\Requests\Web\MyGroup\MyCollection\ShowRequest;
use App\Http\Requests\Web\MyGroup\MyCollection\StoreRequest;
use App\Http\Requests\Web\MyGroup\MyCollection\ToggleEnableRequest;
use App\Http\Requests\Web\MyGroup\MyCollection\UpdateRequest;
use App\Models\Collection;
use App\Models\Group;
use App\Services\Web\MyGroup\MyCollectionService;
use Illuminate\Contracts\Support\Renderable;

class MyCollectionController extends BaseController
{
    /**
     * @param MyCollectionService $service
     */
    public function __construct(protected MyCollectionService $service)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @param Group $myGroup
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, Group $myGroup)
    {
        return view('my-group.my-collection.index', [
            'myGroup' => $myGroup,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateRequest $request
     * @param Group $myGroup
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, Group $myGroup)
    {
        return view('my-group.my-collection.create', [
            'myGroup' => $myGroup,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param Group $myGroup
     *
     * @return void
     */
    public function store(StoreRequest $request, Group $myGroup)
    {
        try {
            $data = $request->validated();
            $data['owner_type'] = Group::class;
            $data['owner_id'] = $myGroup->id;

            $collection = $this->service->store($data);

            $hasItem = collect([
                'exhibit_id',
                'artwork_id',
                'collection_id',
                'collection_item_id',
                'website_id',
                'website_group_id',
                'user_profile_id',
                'group_id',
            ])->some(fn($key) => $request->filled($key));

            if ($hasItem) {
                return back()->withSuccess(__('my-group-collection.message.success.item-added'));
            }

            return redirect()
                ->route('my-group.my-collections.show', [
                    'my_group' => $myGroup->id,
                    'my_collection' => $collection,
                ])
                ->withSuccess(__('my-group-collection.message.success.collection-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param ShowRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $myGroup, Collection $myCollection)
    {
        return view('my-group.my-collection.show', [
            'myGroup' => $myGroup,
            'myCollection' => $myCollection,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, Group $myGroup, Collection $myCollection)
    {
        return view('my-group.my-collection.edit', [
            'myGroup' => $myGroup,
            'myCollection' => $myCollection,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     *
     * @return void
     */
    public function update(UpdateRequest $request, Group $myGroup, Collection $myCollection)
    {
        try {
            $this->service->update($myCollection, $request->validated());

            return redirect()
                ->route('my-group.my-collections.index', [
                    'my_group' => $myGroup->id,
                ])
                ->withSuccess(__('my-group-collection.message.success.collection-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $myGroup, Collection $myCollection)
    {
        try {
            $this->service->destroy($myCollection);

            return redirect()
                ->route('my-group.my-collections.index', [
                    'my_group' => $myGroup->id,
                ])
                ->withSuccess(__('my-group-collection.message.success.collection-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param ToggleEnableRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, Group $myGroup, Collection $myCollection)
    {
        try {
            $myCollection = $this->service->toggleEnable($myCollection);

            return redirect()
                ->route('my-group.my-collections.index', [
                    'my_group' => $myGroup->id,
                ])
                ->withSuccess(
                    $myCollection->isEnabled() ?
                    __('my-group-collection.message.success.collection-enabled') :
                    __('my-group-collection.message.success.collection-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Collection
     *
     * @param ChangePositionRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, Group $myGroup, Collection $myCollection, int $position)
    {
        try {
            $this->service->changePosition($myCollection, $position);

            return back();

        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
