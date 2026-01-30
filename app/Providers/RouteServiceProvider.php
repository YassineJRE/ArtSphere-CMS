<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your Web controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers\Web';

    /**
     * This namespace is applied to your Admin controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespaceAdmin = 'App\Http\Controllers\Admin';    

    /**
     * This namespace is applied to your API controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespaceApi = 'App\Http\Controllers\API';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->mapApiRoutes();
        $this->mapAdminRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $subdomain = env('APP_ENV') != 'production' ? env('APP_ENV').'.' : '';
        Route::domain(env('APP_DOMAIN'))
            ->domain($subdomain.env('APP_DOMAIN'))
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
/*
        Route::domain(env('APP_DOMAIN_FR'))
            ->domain(env('APP_ENV').'.'.env('APP_DOMAIN_FR'))
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));            
*/            
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        $subdomain = env('APP_ENV') != 'production' ? env('APP_ENV').'.' : '';
        Route::domain(env('APP_DOMAIN'))
            ->domain($subdomain.env('APP_DOMAIN'))
            ->middleware('admin')
            ->prefix('/admin')
            ->namespace($this->namespaceAdmin)
            ->group(base_path('routes/admin.php'));
/*
        Route::domain(env('APP_DOMAIN_FR'))
            ->domain(env('APP_ENV').'.'.env('APP_DOMAIN_FR'))
            ->middleware('admin')
            ->prefix('/admin')
            ->namespace($this->namespaceAdmin)
            ->group(base_path('routes/admin.php'));
*/            
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $subdomain = env('APP_ENV') != 'production' ? env('APP_ENV').'.' : '';
        Route::domain('api.'.env('APP_DOMAIN'))
            ->domain($subdomain.'api.'.env('APP_DOMAIN'))
            ->middleware('api')
            ->namespace($this->namespaceApi)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
