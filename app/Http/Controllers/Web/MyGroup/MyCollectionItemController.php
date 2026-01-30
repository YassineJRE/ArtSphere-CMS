<?php

namespace App\Http\Controllers\Web\MyGroup;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\MyGroup\MyCollectionItem\ChangePositionRequest;
use App\Http\Requests\Web\MyGroup\MyCollectionItem\DestroyRequest;
use App\Http\Requests\Web\MyGroup\MyCollectionItem\ShowRequest;
use App\Http\Requests\Web\MyGroup\MyCollectionItem\StoreRequest;
use App\Models\Artwork;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;
use App\Services\Web\MyGroup\MyCollectionItemService;
use Illuminate\Contracts\Support\Renderable;

class MyCollectionItemController extends BaseController
{
    /**
     * @param MyCollectionItemService $service
     */
    public function __construct(protected MyCollectionItemService $service)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     *
     * @return void
     */
    public function store(StoreRequest $request, Group $myGroup, Collection $myCollection)
    {
        try {
            $data = $request->validated();

            $modelMap = [
                'exhibit_id' => Exhibit::class,
                'artwork_id' => Artwork::class,
                'collection_id' => Collection::class,
                'collection_item_id' => CollectionItem::class,
                'website_group_id' => WebsiteGroup::class,
                'website_id' => Website::class,
                'user_profile_id' => UserProfile::class,
                'group_id' => Group::class,
            ];

            foreach ($modelMap as $key => $modelClass) {
                if ($request->filled($key)) {
                    $data['model_type'] = $modelClass;
                    $data['model_id'] = $request->input($key);
                    break;
                }
            }

            $data['collection_id'] = $myCollection->id;

            $this->service->store($data);

            return back()->withSuccess(__('my-collection-item.message.success.item-added'));
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
    public function show(ShowRequest $request, Group $myGroup, Collection $myCollection, CollectionItem $item)
    {
        return view('my-group.my-collection.item.show', [
            'myGroup' => $myGroup,
            'myCollection' => $myCollection,
            'item' => $item,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     * @param CollectionItem $item
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $myGroup, Collection $myCollection, CollectionItem $item)
    {
        try {
            $this->service->destroy($item);

            $itemKeys = [
                'exhibit_id',
                'artwork_id',
                'website_id',
                'website_group_id',
                'collection_item_id',
                'collection_id',
                'user_profile_id',
                'group_id',
            ];

            $hasItemKey = collect($itemKeys)->contains(fn($key) => $request->has($key));

            if ($hasItemKey) {
                return back()->withSuccess(__('my-collection-item.message.success.item-deleted'));
            }

            return redirect()
                ->route('my-group.my-collections.show', [
                    'my_group' => $myGroup->id,
                    'my_collection' => $myCollection->id,
                ])
                ->withSuccess(__('my-collection-item.message.success.item-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Item
     *
     * @param ChangePositionRequest $request
     * @param Group $myGroup
     * @param Collection $myCollection
     * @param CollectionItem $item
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, Group $myGroup, Collection $myCollection, CollectionItem $item, int $position)
    {
        try {
            $item = $this->service->changePosition($item, $position);

            return back();

        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
