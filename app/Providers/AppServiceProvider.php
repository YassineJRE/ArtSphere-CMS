<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResetPassword::toMailUsing(function ($user, $token) {
            $url = $user->canAccessAdmin() ?
            route('admin.password.reset', [
                'token' => $token,
                'email' => $user->email,
            ]) :
            route('authentication.reset-password', [
                'token' => $token,
                'email' => $user->email,
            ]);

            return (new MailMessage)
                ->subject(__('emails.app.ResetPassword.subject'))
                ->greeting(__('emails.app.ResetPassword.greeting'))
                ->line(__('emails.app.ResetPassword.line.you-receive'))
                ->action(__('emails.app.ResetPassword.action.reset-password'), $url)
                ->line(__('emails.app.ResetPassword.line.link-expires', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                ->line(__('emails.app.ResetPassword.line.not-request'));
        });
    }
}
