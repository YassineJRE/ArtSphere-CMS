<?php

namespace App\Http\Controllers\Web\MyGroup;

use Exception;
use App\Exceptions\ServiceException;
use App\Exceptions\MailException;
use App\Http\Controllers\Web\BaseController;
use App\Enums\MemberType as EnumMemberType;
use App\Models\Group;
use App\Models\UserHasGroup;
use Illuminate\Contracts\Support\Renderable;
use App\Http\Requests\Web\MyGroup\Member\IndexRequest;
use App\Http\Requests\Web\MyGroup\Member\CreateRequest;
use App\Http\Requests\Web\MyGroup\Member\ShowRequest;
use App\Http\Requests\Web\MyGroup\Member\StoreRequest;
use App\Http\Requests\Web\MyGroup\Member\EditRequest;
use App\Http\Requests\Web\MyGroup\Member\UpdateRequest;
use App\Http\Requests\Web\MyGroup\Member\DestroyRequest;
use App\Http\Requests\Web\MyGroup\Member\ToggleEnableRequest;
use App\Http\Requests\Web\MyGroup\Member\InviteRequest;
use App\Services\Web\MyGroup\MemberService;

class MemberController extends BaseController
{
    public function __construct(MemberService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\IndexRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function index(IndexRequest $request, Group $myGroup)
    {
        return view('my-group.member.index', [
            'myGroup' => $myGroup
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\CreateRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return Renderable
     */
    public function create(CreateRequest $request, Group $myGroup)
    {
        return view('my-group.member.create', [
            'myGroup' => $myGroup,
            'memberTypes' => EnumMemberType::list(),
            'profiles' => MemberService::getListProfiles($myGroup)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\StoreRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return void
     */
    public function store(StoreRequest $request, Group $myGroup)
    {
        try {
            $data = $request->validated();
            $data['group_id'] = $myGroup->id;
            $this->service->store($data);

            return redirect()
                ->route('my-group.members.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-member.message.success.member-added'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\ShowRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\UserHasGroup $member
     *
     * @return Renderable
     */
    public function show(ShowRequest $request, Group $myGroup, UserHasGroup $member)
    {
        return view('my-group.member.show', [
            'myGroup' => $myGroup,
            'member' => $member
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\EditRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\UserHasGroup $member
     *
     * @return Renderable
     */
    public function edit(EditRequest $request, Group $myGroup, UserHasGroup $member)
    {
        return view('my-group.member.edit', [
            'myGroup' => $myGroup,
            'member' => $member,
            'memberTypes' => EnumMemberType::list()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\UpdateRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\UserHasGroup                                    $member
     *
     * @return void
     */
    public function update(UpdateRequest $request, Group $myGroup, UserHasGroup $member)
    {
        try {
            $member = $this->service->update($member, $request->validated());

            return redirect()
                ->route('my-group.members.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-member.message.success.member-updated'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\DestroyRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\UserHasGroup $member
     *
     * @return void
     */
    public function destroy(DestroyRequest $request, Group $myGroup, UserHasGroup $member)
    {
        try {

            $isOwner = $member->isOwner();
            $this->service->destroy($member);

            if ($isOwner) {
                return redirect()->route('my-account.index');
            }

            return redirect()
                ->route('my-group.members.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-member.message.success.member-removed'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\ToggleEnableRequest $request
     * @param App\Models\Group $myGroup
     * @param App\Models\UserHasGroup $member
     *
     * @return void
     */
    public function toggleEnable(ToggleEnableRequest $request, Group $myGroup, UserHasGroup $member)
    {
        try {
            $member = $this->service->toggleEnable($member);

            return redirect()
                ->route('my-group.members.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(
                    $member->isEnabled() ?
                    __('my-group-member.message.success.member-enabled') :
                    __('my-group-member.message.success.member-disabled')
                );
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Invite someone to artolog.
     *
     * @param App\Http\Requests\Web\MyGroup\Member\InviteRequest $request
     * @param App\Models\Group $myGroup
     *
     * @return void
     */
    public function processInvite(InviteRequest $request, Group $myGroup)
    {
        try {
            $data = $request->validated();
            $data['subject_type'] = Group::class;
            $data['subject_id'] = $myGroup->id;
            $data['inviter_id'] = $request->user()->id;
            $invitation = $this->service->processInvite($data);

            return redirect()
                ->route('my-group.members.index', [
                    'my_group' => $myGroup->id
                ])
                ->withSuccess(__('my-group-member.message.success.invitation-sent'));
        } catch (MailException $e) {
            return back()->withErrors(__('my-group-member.message.error.email-sending-failed'));
        } catch (Exception $e) {
            return back()->withErrors(__('my-group-member.message.error.email-sending-failed'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
