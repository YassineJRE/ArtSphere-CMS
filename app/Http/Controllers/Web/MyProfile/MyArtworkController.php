<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\MediaCollection as EnumMediaCollection;
use App\Enums\Status as EnumStatus;
use App\Models\UserProfile;
use App\Models\Exhibit;
use App\Models\Artwork;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyProfile\MyArtwork\IndexRequest;
use App\Http\Requests\Web\MyProfile\MyArtwork\CreateRequest;
use App\Http\Requests\Web\MyProfile\MyArtwork\ShowRequest;
use App\Http\Requests\Web\MyProfile\MyArtwork\StoreRequest;
use App\Http\Requests\Web\MyProfile\MyArtwork\EditRequest;
use App\Http\Requests\Web\MyProfile\MyArtwork\UpdateRequest;
use App\Http\Requests\Web\MyProfile\MyArtwork\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyArtwork\PostTransfertToRequest;
use App\Http\Requests\Web\MyProfile\MyArtwork\ChangePositionRequest;
use App\Services\Web\MyProfile\MyArtworkService;

class MyArtworkController extends BaseController
{
    public function __construct(MyArtworkService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\IndexRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        return view('my-profile.my-exhibit.my-artwork.index', [
            'myProfile' => $myProfile,
            'myExhibit' => $myExhibit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\CreateRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        return view('my-profile.my-exhibit.my-artwork.create', [
            'myProfile' => $myProfile,
            'myExhibit' => $myExhibit,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\StoreRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     *
     * @return void
     */
    public function store(StoreRequest $request, UserProfile $myProfile, Exhibit $myExhibit)
    {
        try {
            $data = $request->all();
            $data['exhibit_id'] = $myExhibit->id;
            $myArtwork = $this->service->store($data);

            if ($request->has('media')) {
                $myArtwork->clearMediaCollection(EnumMediaCollection::DEFAULT);
                $media = $myArtwork->addMedia($request->media)
                            ->toMediaCollection(EnumMediaCollection::DEFAULT);
            }

            return redirect()
                ->route('my-profile.my-exhibits.show', [
                    'my_profile' => $myProfile->id,
                    'my_exhibit' => $myExhibit->id,
                ])
                ->withSuccess(__('my-artwork.message.success.artwork-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\ShowRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     * @param App\Models\Artwork $myArtwork
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $myProfile, Exhibit $myExhibit, Artwork $myArtwork)
    {
        return view('my-profile.my-exhibit.my-artwork.show', [
            'myProfile' => $myProfile,
            'myExhibit' => $myExhibit,
            'myArtwork' => $myArtwork,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\EditRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     * @param App\Models\Artwork $myArtwork
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, UserProfile $myProfile, Exhibit $myExhibit, Artwork $myArtwork)
    {
        return view('my-profile.my-exhibit.my-artwork.edit', [
            'myProfile' => $myProfile,
            'myExhibit' => $myExhibit,
            'myArtwork' => $myArtwork,
            'statuses' => EnumStatus::shortPublish(),
            'exhibits' => $myProfile->exhibits()->where('id','<>',$myExhibit->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\UpdateRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit                                    $myExhibit
     * @param App\Models\Artwork $myArtwork
     *
     * @return void
     */
    public function update(UpdateRequest $request, UserProfile $myProfile, Exhibit $myExhibit, Artwork $myArtwork)
    {
        try {
            $myArtwork = $this->service->update($myArtwork, $request->all());

            if ($request->has('media')) {
                $myArtwork->clearMediaCollection(EnumMediaCollection::DEFAULT);
                $media = $myArtwork->addMedia($request->media)
                            ->toMediaCollection(EnumMediaCollection::DEFAULT);
            }

            return redirect()
                ->route('my-profile.my-exhibits.show', [
                    'my_profile' => $myProfile->id,
                    'my_exhibit' => $myExhibit->id,
                ])
                ->withSuccess(__('my-artwork.message.success.artwork-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Transfer Artwork To another Exhibit
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\PostTransfertToRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit                                    $myExhibit
     * @param App\Models\Artwork $myArtwork
     *
     * @return Renderable
     */
    public function postTransferTo(PostTransfertToRequest $request, UserProfile $myProfile, Exhibit $myExhibit, Artwork $myArtwork)
    {
        try {
            $myArtwork = $this->service->transferTo($myArtwork, $request->validated());

            if ($myArtwork->exhibit->belongsToProfile()) {
                return redirect()
                    ->route('my-profile.my-exhibits.my-artworks.show', [
                        'my_profile' => $myArtwork->exhibit->owner_id,
                        'my_exhibit' => $myArtwork->exhibit->id,
                        'my_artwork' => $myArtwork->id
                    ])
                    ->withSuccess(__('my-artwork.message.success.artwork-has-been-transfered'));
            } elseif ($myArtwork->exhibit->belongsToGroup()) {
                return redirect()
                    ->route('my-group.my-exhibits.my-artworks.show', [
                        'my_group' => $myArtwork->exhibit->owner_id,
                        'my_exhibit' => $myArtwork->exhibit->id,
                        'my_artwork' => $myArtwork->id
                    ])
                    ->withSuccess(__('my-artwork.message.success.artwork-has-been-transfered'));
            }

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Artwork
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\ChangePositionRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit                                    $myExhibit
     * @param App\Models\Artwork $myArtwork
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, UserProfile $myProfile, Exhibit $myExhibit, Artwork $myArtwork, int $position)
    {
        try {
            $myArtwork = $this->service->changePosition($myArtwork, $position);

            return back()
                ->withSuccess(__('my-artwork.message.success.artwork-has-been-changed'));

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyArtwork\DestroyRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Exhibit $myExhibit
     * @param App\Models\Artwork $myArtwork
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile, Exhibit $myExhibit, Artwork $myArtwork)
    {
        try {
            $this->service->destroy($myArtwork);

            return redirect()
                ->route('my-profile.my-exhibits.show', [
                    'my_profile' => $myProfile->id,
                    'my_exhibit' => $myExhibit->id,
                ])
                ->withSuccess(__('my-artwork.message.success.artwork-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
