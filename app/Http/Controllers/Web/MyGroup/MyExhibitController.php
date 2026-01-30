<?php

namespace App\Http\Controllers\Web\MyGroup;

use Exception;
use App\Exceptions\ServiceException;
use App\Exceptions\MailException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\ExhibitType;
use App\Enums\Status as EnumStatus;
use App\Models\Group;
use App\Models\Exhibit;
use App\Models\UserProfile;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyGroup\MyExhibit\IndexRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\CreateRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\ShowRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\StoreRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\EditRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\UpdateRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\DestroyRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\ToggleEnableRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\TransfertToRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\PostTransfertToRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\InviteRequest;
use App\Http\Requests\Web\MyGroup\MyExhibit\ChangePositionRequest;
use App\Services\Web\MyGroup\MyExhibitService;


class MyExhibitController extends BaseController
{
    public function __construct(MyExhibitService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\IndexRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, Group $myGroup)
    {
        return view('my-group.my-exhibit.index', [
            'myGroup' => $myGroup
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\CreateRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, Group $myGroup)
    {
        return view('my-group.my-exhibit.create', [
            'myGroup' => $myGroup,
            'exhibitTypes' => ExhibitType::list(),
            'statuses' => EnumStatus::longPublish(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\StoreRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return void
     */
    public function store(StoreRequest $request, Group $myGroup)
    {
        try {
            $data = $request->validated();
            $data['owner_type'] = Group::class;
            $data['owner_id'] = $myGroup->id;
            $myExhibit = $this->service->store($data);

            if ($request->has('transfer')) {
                return redirect()
                    ->route('my-group.my-exhibits.transfer-to', [
                        'my_group' => $myGroup->id,
                        'my_exhibit' => $myExhibit->id,
                    ]);
            }

            return redirect()
                ->route('my-group.my-exhibits.show', [
                    'my_group' => $myGroup->id,
                    'my_exhibit' => $myExhibit->id,
                ])
                ->withSuccess(__('my-group-exhibit.message.success.exhibit-created'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\ShowRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $myGroup, Exhibit $myExhibit)
    {
        return view('my-group.my-exhibit.show', [
            'myGroup' => $myGroup,
            'myExhibit' => $myExhibit,
            'exhibits' => $myGroup->exhibits()->where('id','<>',$myExhibit->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\EditRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, Group $myGroup, Exhibit $myExhibit)
    {
        return view('my-group.my-exhibit.edit', [
            'myGroup' => $myGroup,
            'myExhibit' => $myExhibit,
            'exhibitTypes' => ExhibitType::list(),
            'statuses' => EnumStatus::longPublish(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\UpdateRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit                                    $myExhibit
     *
     * @return void
     */
    public function update(UpdateRequest $request, Group $myGroup, Exhibit $myExhibit)
    {
        try {
            $this->service->update($myExhibit, $request->validated());

            if ($request->has('transfer')) {
                return redirect()
                    ->route('my-group.my-exhibits.transfer-to', [
                        'my_group' => $myGroup->id,
                        'my_exhibit' => $myExhibit->id,
                    ]);
            }

            return redirect()
                ->route('my-group.my-exhibits.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-exhibit.message.success.exhibit-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\DestroyRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $myGroup, Exhibit $myExhibit)
    {
        try {
            $this->service->destroy($myExhibit);

            return redirect()
                ->route('my-group.my-exhibits.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-exhibit.message.success.exhibit-deleted'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\ToggleEnableRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, Group $myGroup, Exhibit $myExhibit)
    {
        try {
            $myExhibit = $this->service->toggleEnable($myExhibit);

            return redirect()
                ->route('my-group.my-exhibits.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(
                    $myExhibit->isEnabled() ?
                    __('my-group-exhibit.message.success.exhibit-enabled') :
                    __('my-group-exhibit.message.success.exhibit-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show form of Transfer To.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\TransfertToRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function transferTo(TransfertToRequest $request, Group $myGroup, Exhibit $myExhibit)
    {
        return view('my-group.my-exhibit.transfer-to', [
            'myGroup' => $myGroup,
            'myExhibit' => $myExhibit,
            'profiles' => UserProfile::artists()->whereNot('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Request Transfer Exhibit To Artist Profile
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\PostTransfertToRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     *
     * @return Renderable
     */
    public function postTransferTo(PostTransfertToRequest $request, Group $myGroup, Exhibit $myExhibit)
    {
        try {

            if ( $myExhibit->canTransfer() )
            {
                $myExhibit = $this->service->transferTo($myExhibit, $request->validated());
            }

            if ( $myExhibit->isTransfered() ) {
                return redirect()
                ->route('my-group.my-exhibits.index', [
                    'my_group' => $myGroup->id,
                ])
                ->withSuccess(
                    __('my-group-exhibit.message.success.exhibit-has-been-transfered')
                );
            }

            return redirect()
            ->route('my-group.my-exhibits.show', [
                'my_group' => $myGroup->id,
                'my_exhibit' => $myExhibit->id,
            ])
            ->withSuccess(
                __('my-group-exhibit.message.success.exhibit-has-not-been-transfered')
            );
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Invite someone to artolog.
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\InviteRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     *
     * @return void
     */
    public function processInvite(InviteRequest $request, Group $myGroup, Exhibit $myExhibit)
    {
        try {
            $data = $request->validated();
            $data['subject_type'] = Exhibit::class;
            $data['subject_id'] = $myExhibit->id;
            $data['inviter_id'] = $request->user()->id;
            $invitation = $this->service->processInvite($data);

            return redirect()
                ->route('my-group.my-exhibits.show', [
                    'my_group' => $myGroup->id,
                    'my_exhibit' => $myExhibit->id,
                ])
                ->withSuccess(__('my-group-exhibit.message.success.invitation-sent'));
        } catch (MailException $e) {
            return back()->withErrors(__('my-group-exhibit.message.error.email-sending-failed'));
        } catch (Exception $e) {
            return back()->withErrors(__('my-group-exhibit.message.error.email-sending-failed'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Request Change position of this Exhibit
     *
     * @param App\Http\Requests\Web\MyGroup\MyExhibit\ChangePositionRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\Exhibit $myExhibit
     * @param int $position
     *
     * @return Renderable
     */
    public function changePosition(ChangePositionRequest $request, Group $myGroup, Exhibit $myExhibit, int $position)
    {
        try {
            $this->service->changePosition($myExhibit, $position);

            return back();

        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }    
}

