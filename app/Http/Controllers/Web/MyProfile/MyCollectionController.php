<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Enums\Status as EnumStatus;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\MyProfile\MyCollection\ChangePositionRequest;
use App\Http\Requests\Web\MyProfile\MyCollection\CreateRequest;
use App\Http\Requests\Web\MyProfile\MyCollection\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyCollection\EditRequest;
use App\Http\Requests\Web\MyProfile\MyCollection\IndexRequest;
use App\Http\Requests\Web\MyProfile\MyCollection\ShowRequest;
use App\Http\Requests\Web\MyProfile\MyCollection\StoreRequest;
use App\Http\Requests\Web\MyProfile\MyCollection\ToggleEnableRequest;
use App\Http\Requests\Web\MyProfile\MyCollection\UpdateRequest;
use App\Models\Collection;
use App\Models\UserProfile;
use App\Services\Web\MyProfile\MyCollectionService;
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
     * @param UserProfile $myProfile
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-collection.index', [
            'myProfile' => $myProfile,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateRequest $request
     * @param UserProfile $myProfile
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-collection.create', [
            'myProfile' => $myProfile,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param UserProfile $myProfile
     *
     * @return void
     */
    public function store(StoreRequest $request, UserProfile $myProfile)
    {
        try {
            $data = $request->validated();
            $data['owner_type'] = UserProfile::class;
            $data['owner_id'] = $myProfile->id;

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
                return back()->withSuccess(__('my-collection.message.success.item-added'));
            }

            return redirect()
                ->route('my-profile.my-collections.show', [
                    'my_profile' => $myProfile->id,
                    'my_collection' => $collection,
                ])
                ->withSuccess(__('my-collection.message.success.collection-created'));

        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param ShowRequest $request
     * @param UserProfile $myProfile
     * @param Collection $myCollection
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $myProfile, Collection $myCollection)
    {
        return view('my-profile.my-collection.show', [
            'myProfile' => $myProfile,
            'myCollection' => $myCollection,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditRequest $request
     * @param UserProfile $myProfile
     * @param Collection $myCollection
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, UserProfile $myProfile, Collection $myCollection)
    {
        return view('my-profile.my-collection.edit', [
            'myProfile' => $myProfile,
            'myCollection' => $myCollection,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param UserProfile $myProfile
     * @param Collection $myCollection
     *
     * @return void
     */
    public function update(UpdateRequest $request, UserProfile $myProfile, Collection $myCollection)
    {
        try {
            $this->service->update($myCollection, $request->validated());

            return redirect()
                ->route('my-profile.my-collections.index', [
                    'my_profile' => $myProfile->id,
                ])
                ->withSuccess(__('my-collection.message.success.collection-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param UserProfile $myProfile
     * @param Collection $myCollection
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile, Collection $myCollection)
    {
        try {
            $this->service->destroy($myCollection);

            return redirect()
                ->route('my-profile.my-collections.index', [
                    'my_profile' => $myProfile->id,
                ])
                ->withSuccess(__('my-collection.message.success.collection-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Collection
     *
     * @param ChangePositionRequest $request
     * @param UserProfile $myProfile
     * @param Collection $myCollection
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, UserProfile $myProfile, Collection $myCollection, int $position)
    {
        try {
            $this->service->changePosition($myCollection, $position);

            return back();

        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param ToggleEnableRequest $request
     * @param UserProfile $myProfile
     * @param Collection $myCollection
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $myProfile, Collection $myCollection)
    {
        try {
            $myCollection = $this->service->toggleEnable($myCollection);

            return redirect()
                ->route('my-profile.my-collections.index', [
                    'my_profile' => $myProfile->id,
                ])
                ->withSuccess(
                    $myCollection->isEnabled() ?
                    __('my-collection.message.success.collection-enabled') :
                    __('my-collection.message.success.collection-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
