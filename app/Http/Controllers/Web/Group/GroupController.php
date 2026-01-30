<?php

namespace App\Http\Controllers\Web\Group;

use App\Enums\GroupType as EnumGroupType;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Notifications\Web\NotifyGroupMemberForContact;
use App\Http\Controllers\Web\BaseController;
use App\Models\Group;
use Mail;
use Validator;

class GroupController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function basicSearch(Request $request) {
        try{
            $searchName = $request->q;
            $collection = Group::where('name', 'like', $searchName . '%')->where('type', EnumGroupType::ARTIST_RUN_CENTER_ORG)->get(['id','name']);
            return response()->json($collection);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage(),
            ]);
        }
        
    }

    /**
     * Display Search page.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $group
     *
     * @return Renderable
     */
    public function show(Request $request, Group $group)
    {
        return view('group.show', [
            'group' => $group,
        ]);
    }

    /**
     * Send an e-mail to this group.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\Group $group
     * 
     * @return Response
     */
    public function sendEmail(Request $request, Group $group)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ( !$validator->fails() )
        {
            if ($request->isMethod('post'))
            {
                foreach ($group->memberUsers as $memberUser) 
                {
                    $memberUser->notify(new NotifyGroupMemberForContact($request));
                }

                if ($group->isNotifiable()) 
                {
                    $group->notify(new NotifyGroupMemberForContact($request));
                }

                $request->session()->flash('success', __('group.message.success.message-sent'));
                return response()->json([
                    'status' => 'success',
                    'view' => view('admin.components.notifications')->render(),
                ]);
            }
        }

        $request->session()->flash('error', __('group.message.error.send-email-failed'));
        return response()->json([
            'status' => 'error',
            'view' => view('admin.components.notifications')->render(),
        ]);
    }
	
	//GALLERY INVITATION FEATURE
	/* Show test invite gallery */
	
	public function showGalleryInvite()
    {
        return view('invitegallery.gallery');
    }
}
