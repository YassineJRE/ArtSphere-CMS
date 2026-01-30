<?php

namespace App\Providers;

use App\Support\ActiveProfile;
use App\Support\Contracts\ActiveProfileInterface;
use Illuminate\Support\ServiceProvider;

class ActiveProfileServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ActiveProfileInterface::class, function ($app) {
            return new ActiveProfile();
        });

        $this->app->alias(ActiveProfileInterface::class, 'profile.session');
    }

    public function boot()
    {
        //
    }
}
