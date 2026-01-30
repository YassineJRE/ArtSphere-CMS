<?php

namespace App\Http\Controllers\Web;

use App\Enums\LogEvent;
use App\Enums\LogName;
use App\Enums\ProfileType as EnumProfileType;
use App\Models\User;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\Register\StoreRequest;
use App\Http\Requests\Web\Register\FinalizeRequest;
use App\Services\Authentication\RegisterService;

class RegisterController extends BaseController
{
    public function __construct(RegisterService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the form for registering a new Member.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('register.index');
    }

    /**
     * Store a newly created member in storage.
     *
     * @param App\Http\Requests\Web\Register\StoreRequest $request
     *
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        try {
            $userDeleted = User::onlyTrashed()->where('email', $request->get('email'))->first();

            if ($userDeleted) {
                return back()->withErrors(__('register.message.error.user-deleted'));
            }

            $user = $this->service->store($request->all());
            Auth::login($user);
            auth()->user()->sendEmailVerificationNotification();
            activity(LogName::USER)
                ->causedBy($user)
                ->event(LogEvent::REGISTERED)
                ->withProperties([
                    'ip' => $request->ip(),
                    'guard' => 'web',
                ])
                ->log(LogName::USER.'.'.LogEvent::REGISTERED);

            return redirect()->route('app.home')
                ->withSuccess(__('register.message.success.register-successfully'));
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Store a newly created member in storage.
     *
     * @param App\Http\Requests\Web\Register\FinalizeRequest $request
     *
     * @return Renderable
     */
    public function finalize(FinalizeRequest $request)
    {
        try {
            $user = $this->service->finalize(Auth::user(), $request->validated());
            $profileCreated = $user->profiles()->first();
            activity(LogName::USER)
                ->causedBy($user)
                ->event(LogEvent::PROFILE_REGISTERED)
                ->withProperties([
                    'ip' => $request->ip(),
                    'guard' => 'web',
                    'profile' => $profileCreated
                ])
                ->log(LogName::USER.'.'.LogEvent::PROFILE_REGISTERED);

            switch ($profileCreated->type)
            {
                case EnumProfileType::ARTIST:
                    return redirect()->route('my-account.artist-profile.show',[
                        'artist_profile' => $profileCreated->id
                    ])->withSuccess(__('register.message.success.register-successfully'));
                case EnumProfileType::CURATOR:
                    return redirect()->route('my-account.curator-profile.show',[
                        'curator_profile' => $profileCreated->id
                    ])->withSuccess(__('register.message.success.register-successfully'));
                case EnumProfileType::PUBLIC_COLLECTOR:
                    return redirect()->route('my-account.public-collector-profile.show',[
                        'public_collector_profile' => $profileCreated->id
                    ])->withSuccess(__('register.message.success.register-successfully'));
                default:
                    return redirect()->route('my-account.index')
                        ->withSuccess(__('register.message.success.register-successfully'));
            }
        } catch (ServiceException $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
