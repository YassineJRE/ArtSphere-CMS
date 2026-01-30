<?php

namespace App\Http\Controllers\Web\MyProfile;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\MediaCollection as EnumMediaCollection;
use App\Enums\Status as EnumStatus;
use App\Models\UserProfile;
use App\Models\Document;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyProfile\MyDocument\IndexRequest;
use App\Http\Requests\Web\MyProfile\MyDocument\CreateRequest;
use App\Http\Requests\Web\MyProfile\MyDocument\ShowRequest;
use App\Http\Requests\Web\MyProfile\MyDocument\StoreRequest;
use App\Http\Requests\Web\MyProfile\MyDocument\EditRequest;
use App\Http\Requests\Web\MyProfile\MyDocument\UpdateRequest;
use App\Http\Requests\Web\MyProfile\MyDocument\DestroyRequest;
use App\Http\Requests\Web\MyProfile\MyDocument\ToggleEnableRequest;
use App\Http\Requests\Web\MyProfile\MyDocument\ChangePositionRequest;
use App\Services\Web\MyProfile\MyDocumentService;

class MyDocumentController extends BaseController
{
    public function __construct(MyDocumentService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\IndexRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-document.index', [
            'myProfile' => $myProfile
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\CreateRequest $request
     * @param App\Models\UserProfile $myProfile
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, UserProfile $myProfile)
    {
        return view('my-profile.my-document.create', [
            'myProfile' => $myProfile,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\StoreRequest $request
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
            $myDocument = $this->service->store($data);

            if ($request->has('media')) {
                $myDocument->clearMediaCollection(EnumMediaCollection::DEFAULT);
                $media = $myDocument->addMedia($request->media)
                            ->toMediaCollection(EnumMediaCollection::DEFAULT);
            }

            return redirect()
                ->route('my-profile.show', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(__('my-document.message.success.document-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\ShowRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Document $myDocument
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, UserProfile $myProfile, Document $myDocument)
    {
        return view('my-profile.my-document.show', [
            'myProfile' => $myProfile,
            'myDocument' => $myDocument
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\EditRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Document $myDocument
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, UserProfile $myProfile, Document $myDocument)
    {
        return view('my-profile.my-document.edit', [
            'myProfile' => $myProfile,
            'myDocument' => $myDocument,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\UpdateRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Document                                    $myDocument
     *
     * @return void
     */
    public function update(UpdateRequest $request, UserProfile $myProfile, Document $myDocument)
    {
        try {
            $myDocument = $this->service->update($myDocument, $request->all());

            if ($request->has('media')) {
                $myDocument->clearMediaCollection(EnumMediaCollection::DEFAULT);
                $media = $myDocument->addMedia($request->media)
                            ->toMediaCollection(EnumMediaCollection::DEFAULT);
            }

            return redirect()
                ->route('my-profile.show', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(__('my-document.message.success.document-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\DestroyRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Document $myDocument
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, UserProfile $myProfile, Document $myDocument)
    {
        try {
            $this->service->destroy($myDocument);

            return redirect()
                ->route('my-profile.show', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(__('my-document.message.success.document-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\ToggleEnableRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Document $myDocument
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, UserProfile $myProfile, Document $myDocument)
    {
        try {
            $myDocument = $this->service->toggleEnable($myDocument);

            return redirect()
                ->route('my-profile.show', [
                    'my_profile' => $myProfile->id
                ])
                ->withSuccess(
                    $myDocument->isEnabled() ?
                    __('my-document.message.success.document-enabled') :
                    __('my-document.message.success.document-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Document
     *
     * @param App\Http\Requests\Web\MyProfile\MyDocument\ChangePositionRequest $request
     * @param App\Models\UserProfile $myProfile
     * @param App\Models\Document $myDocument
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, UserProfile $myProfile, Document $myDocument, int $position)
    {
        try {
            $myDocument = $this->service->changePosition($myDocument, $position);

            return back();

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
