<?php

namespace App\Http\Controllers\Web;

use App\Enums\ProfileType;
use App\Enums\ArtistType;
use App\Enums\Status as EnumStatus;
use App\Enums\ArtPracticeType;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Events\Web\UserWasRegistered;

class VerificationController extends BaseController
{
    public function __construct()
    {

    }

    /**
     * Show the Email Verification Notice.
     *
     * @return Renderable
     */
    public function notice()
    {
        if (
            Auth::user()->hasVerifiedEmail()
        ) {
            return redirect()->route('app.home');
        }

        return view('verification.notice');
    }

    /**
     * Show the Profile Verification Notice.
     *
     * @return Renderable
     */
    public function profileNotice()
    {
        $user = Auth::user();

        if (
            $user->hasVerifiedProfile()
        ) {
            return redirect()->route('app.home');
        }

        return view('verification.profile-notice',[
            'user' => $user,
            'profileTypes' => ProfileType::list(),
            'artistTypes' => ArtistType::list(),
            'artPracticeTypes' => ArtPracticeType::list(),
            'statuses' => EnumStatus::shortPublish(),
        ]);
    }

    /**
     * Resending The Verification Email.
     *
     * @return Renderable
     */
    public function sendVerificationEmail()
    {
        auth()->user()->sendEmailVerificationNotification();

        return back()
            ->withSuccess(__('Verification link sent to '.auth()->user()->email));
    }

    /**
     * Verify the email address after clicking on a button in an email.
     * The Email Verification Handler.
     *
     * @param Illuminate\Foundation\Auth\EmailVerificationRequest $request
     *
     * @return Renderable
     */
    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        $request->user()->markAsEnabled();
        event(new UserWasRegistered($request->user()));

        return redirect()->route('my-account.index');
    }
}
