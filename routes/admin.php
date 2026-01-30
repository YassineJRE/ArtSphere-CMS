<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('admin.')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/lang/{lang}', 'LanguageController@switchLang')->name('lang.switch');

    Route::prefix('/register')->name('register.')->group(function () {
        Route::get('/{token}/finalize', 'RegisterController@finalize')->middleware('signed')->name('finalize');
        Route::post('/password', 'RegisterController@password')->name('password');
    });

    Route::prefix('login')->group(function () {
        Route::get('/', 'LoginController@index')->name('login');
        Route::post('/', 'LoginController@authenticate')->name('login.authenticate');
    });

    Route::get('logout', 'LogoutController@index')->name('logout');

    Route::prefix('/forgot-password')->group(function () {
        Route::get('/', 'PasswordController@request')->name('password.request');
        Route::post('/', 'PasswordController@email')->name('password.email');
    });

    Route::prefix('/reset-password')->group(function () {
        Route::get('/{token}', 'PasswordController@reset')->name('password.reset');
        Route::post('/', 'PasswordController@update')->name('password.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Private Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::middleware('auth.admin')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::prefix('my-profile')->group(function () {
            Route::get('/', 'MyProfileController@index')->name('my-profile');
            Route::put('/update-details', 'MyProfileController@updateDetails')->name('my-profile.update-details');
            Route::put('/change-password', 'MyProfileController@changePassword')->name('my-profile.change-password');
        });

        Route::resource('user-logs', UserLogController::class)->only(['index', 'show']);
        Route::resource('admin-logs', AdminLogController::class)->only(['index', 'show']);
        Route::resource('galleries', GalleryController::class)->only(['index', 'show', 'destroy']);

        Route::resources([
            'users' => UserController::class,
            'roles' => RoleController::class,
            'members' => MemberController::class,
            'user-notifications' => UserNotificationController::class,
            'contents' => ContentController::class,
        ]);

        Route::get('members/index/datatable', 'MemberController@datatable')->name('members.datatable');
        Route::get('galleries/index/datatable', 'GalleryController@datatable')->name('galleries.datatable');
        Route::get('user-notifications/index/datatable', 'UserNotificationController@datatable')->name('user-notifications.datatable');
        Route::get('roles/index/datatable', 'RoleController@datatable')->name('roles.datatable');

        Route::prefix('/contents')->name('contents.')->group(function () {
            Route::get('index/datatable', 'ContentController@datatable')->name('datatable');
            Route::get('{content}/restore', 'ContentController@restore')->name('restore');
        });

        Route::prefix('/galleries')->name('galleries.')->group(function () {
            Route::get('index/datatable', 'GalleryController@datatable')->name('datatable');
            Route::get('{gallery}/restore', 'GalleryController@restore')->name('restore');
            Route::get('{gallery}/toggle-enable', 'GalleryController@toggleEnable')->name('toggle-enable');
            Route::get('{gallery}/approve', 'GalleryController@approve')->name('approve');
        });

        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('index/datatable', 'UserController@datatable')->name('datatable');
            Route::get('{user}/notify-to-activate-account', function (App\Models\User $user) {
                $user->notifyToActivateAdminAccount();

                return back()->withSuccess(__('Email has been sent to the user'));
            })->name('notify-to-activate-account');
            Route::get('{user}/restore', function ($user) {
                App\Models\User::withTrashed()->find($user)->restore();

                return back()->withSuccess(__('User has been restored'));
            })->name('restore');
            Route::get('{user}/destroy', function (App\Models\User $user) {
                if ($user->canDestroy()) {
                    $user->user_notifications()->delete();
                    $user->invitations()->delete();
                    $user->forceDelete();
    
                    return back()->withSuccess(__('User has been destroy'));
                }

                return back();
            })->name('force-delete');
        });
    });
});
