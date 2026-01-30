<?php

namespace App\Http\Controllers\Web\MyGroup;

use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\MediaCollection as EnumMediaCollection;
use App\Enums\Status as EnumStatus;
use App\Models\Group;
use App\Models\Document;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyGroup\MyDocument\IndexRequest;
use App\Http\Requests\Web\MyGroup\MyDocument\CreateRequest;
use App\Http\Requests\Web\MyGroup\MyDocument\ShowRequest;
use App\Http\Requests\Web\MyGroup\MyDocument\StoreRequest;
use App\Http\Requests\Web\MyGroup\MyDocument\EditRequest;
use App\Http\Requests\Web\MyGroup\MyDocument\UpdateRequest;
use App\Http\Requests\Web\MyGroup\MyDocument\DestroyRequest;
use App\Http\Requests\Web\MyGroup\MyDocument\ToggleEnableRequest;
use App\Http\Requests\Web\MyGroup\MyDocument\ChangePositionRequest;
use App\Services\Web\MyGroup\MyDocumentService;

class MyDocumentController extends BaseController
{
    public function __construct(protected MyDocumentService $service)
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
        return view('my-group.my-document.index', [
            'myGroup' => $myGroup
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
        return view('my-group.my-document.create', [
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
            $data = $request->all();
            $data['owner_type'] = Group::class;
            $data['owner_id'] = $myGroup->id;
            $myDocument = $this->service->store($data);

            if ($request->has('media')) {
                $myDocument->clearMediaCollection(EnumMediaCollection::DEFAULT);
                $media = $myDocument->addMedia($request->media)
                            ->toMediaCollection(EnumMediaCollection::DEFAULT);
            }

            return redirect()
                ->route('my-group.show', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-document.message.success.document-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param ShowRequest $request
     * @param Group $myGroup
     * @param Document $myDocument
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $myGroup, Document $myDocument)
    {
        return view('my-group.my-document.show', [
            'myGroup' => $myGroup,
            'myDocument' => $myDocument
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditRequest $request
     * @param Group $myGroup
     * @param Document $myDocument
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, Group $myGroup, Document $myDocument)
    {
        return view('my-group.my-document.edit', [
            'myGroup' => $myGroup,
            'myDocument' => $myDocument,
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Group $myGroup
     * @param Document $myDocument
     *
     * @return void
     */
    public function update(UpdateRequest $request, Group $myGroup, Document $myDocument)
    {
        try {
            $myDocument = $this->service->update($myDocument, $request->all());

            if ($request->has('media')) {
                $myDocument->clearMediaCollection(EnumMediaCollection::DEFAULT);
                $media = $myDocument->addMedia($request->media)
                            ->toMediaCollection(EnumMediaCollection::DEFAULT);
            }

            return redirect()
                ->route('my-group.show', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-document.message.success.document-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Group $myGroup
     * @param Document $myDocument
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $myGroup, Document $myDocument)
    {
        try {
            $this->service->destroy($myDocument);

            return redirect()
                ->route('my-group.show', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-document.message.success.document-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param ToggleEnableRequest $request
     * @param Group $myGroup
     * @param Document $myDocument
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, Group $myGroup, Document $myDocument)
    {
        try {
            $myDocument = $this->service->toggleEnable($myDocument);

            return redirect()
                ->route('my-group.show', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(
                    $myDocument->isEnabled() ?
                    __('my-group-document.message.success.document-enabled') :
                    __('my-group-document.message.success.document-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Document
     *
     * @param ChangePositionRequest $request
     * @param Group $myGroup
     * @param Document $myDocument
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, Group $myGroup, Document $myDocument, int $position)
    {
        try {
            $myDocument = $this->service->changePosition($myDocument, $position);

            return back();

        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
