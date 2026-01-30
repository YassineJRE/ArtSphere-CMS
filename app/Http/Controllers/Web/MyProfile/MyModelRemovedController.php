<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\MyProfile\MyModelRemoved\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyModelRemoved\IndexRequest;
use App\Http\Requests\Web\MyProfile\MyModelRemoved\StoreRequest;
use App\Models\Artwork;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\RemoveFromDB;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;
use App\Services\Web\MyProfile\MyModelRemovedService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class MyModelRemovedController extends BaseController
{
    /**
     * @param MyModelRemovedService $service
     */
    public function __construct(protected MyModelRemovedService $service)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @param UserProfile $myProfile
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $myProfile): Renderable
    {
        return view('my-profile.my-model-removed.index', [
            'myProfile' => $myProfile,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param UserProfile $myProfile
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, UserProfile $myProfile): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['owner_type'] = UserProfile::class;
            $data['owner_id'] = $myProfile->id;

            $modelMappings = [
                'exhibit_id' => Exhibit::class,
                'artwork_id' => Artwork::class,
                'website_group_id' => WebsiteGroup::class,
                'website_id' => Website::class,
                'user_profile_id' => UserProfile::class,
                'group_id' => Group::class,
                'collection_item_id' => CollectionItem::class,
                'collection_id' => Collection::class,
            ];

            $matched = false;

            foreach ($modelMappings as $key => $class) {
                if ($request->has($key)) {
                    $data['model_type'] = $class;
                    $data['model_id'] = $request->input($key);
                    $matched = true;
                    break;
                }
            }

            $this->service->store($data);

            if ($matched) {
                return back()->withSuccess(__('my-model-removed.message.success.model-removed-added'));
            }

            return redirect()
                ->route('my-profile.my-model-removed.index', [
                    'my_profile' => $myProfile->id,
                ])
                ->withSuccess(__('my-model-removed.message.success.model-removed-created'));

        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param UserProfile $myProfile
     * @param RemoveFromDB $myModelRemoved
     * @return RedirectResponse
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile, RemoveFromDB $myModelRemoved): RedirectResponse
    {
        try {
            $this->service->destroy($myModelRemoved);

            return redirect()
                ->route('my-profile.my-model-removed.index', [
                    'my_profile' => $myProfile->id,
                ])
                ->withSuccess(__('my-model-removed.message.success.model-removed-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
