<?php

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Notifications\Web\NotifyProfileForContact;
use App\Http\Controllers\Web\BaseController;
use App\Models\UserProfile;
use Mail;
use Validator;

class ProfileController extends BaseController
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

    /**
     * Display Search page.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\UserProfile $profile
     *
     * @return Renderable
     */
    public function show(Request $request, UserProfile $profile)
    {
        return view('profile.show', [
            'profile' => $profile,
        ]);
    }

    /**
     * Send an e-mail to this profile.
     *
     * @param Illuminate\Http\Request $request
     * @param App\Models\UserProfile $profile
     * 
     * @return Response
     */
    public function sendEmail(Request $request, UserProfile $profile)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ( !$validator->fails() )
        {
            if ($request->isMethod('post'))
            {
                $profile->user->notify(new NotifyProfileForContact($request));
                $request->session()->flash('success', __('profile.message.success.message-sent'));
                return response()->json([
                    'status' => 'success',
                    'view' => view('admin.components.notifications')->render(),
                ]);
            }
        }

        $request->session()->flash('error', __('profile.message.error.send-email-failed'));
        return response()->json([
            'status' => 'error',
            'view' => view('admin.components.notifications')->render(),
        ]);
    }
		
}
