<?php

use Illuminate\Support\Facades\Route;
use App\Enums\ProfileType as EnumProfileType;
use App\Http\Controllers\Web\Profile\ProfileController;

/* Drag and Drop on Create Exhibit Page */







/* End testing Gallery Invites */
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

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/lang/{lang}', 'LanguageController@switchLang')->name('app.lang.switch');
Route::middleware(['email-verified','profile-verified', 'draft-gallery'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    | - Home
    | - Privacy
    | - Conditions
    | - Contact Us [send email]
    | - Search
    | - Profile [Profile/Documents/Exhibits/Artworks/Websites/Collections]
    | - Group [Profile/Documents/Exhibits/Artworks/Websites/Collections]
    */
    Route::name('app.')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/privacy', 'PrivacyController@index')->name('privacy');
        Route::get('/conditions', 'ConditionsController@index')->name('conditions');
        Route::post('sendemail', 'ContactUsController@sendEmail')->name('sendemail');
        Route::get('/search', 'ResearchController@index')->name('research');
        Route::get('/search/carousel/{type}', 'ResearchController@loadCarousel')->name('research.carousel');
        Route::resource('exhibits', ExhibitController::class)->only([
            'index', 'show',
        ]);
        Route::resource('exhibits.comments', ExhibitCommentController::class)->only([
            'store',
        ]);
        Route::resource('exhibits.artworks', ArtworkController::class)->only([
            'show',
        ]);

        Route::namespace('Profile')->group(function () {
            Route::name('profiles.')->prefix('profiles')->group(function () {
                Route::get('/{profile}', 'ProfileController@show')->name('show');
                Route::post('/{profile}/sendemail', 'ProfileController@sendEmail')->name('sendemail');
            });
            Route::resource('profiles.documents', DocumentController::class)->only([
                'show',
            ]);
            Route::resource('profiles.exhibits', ExhibitController::class)->only([
                'index', 'show',
            ]);
            Route::resource('profiles.exhibits.artworks', ArtworkController::class)->only([
                'index', 'show',
            ]);
            Route::resource('profiles.exhibits.artworks.comments', ArtworkCommentController::class)->only([
                'store',
            ]);
            Route::resource('profiles.website-groups', WebsiteGroupController::class)->only([
                'index', 'show',
            ]);
            Route::resource('profiles.website-groups.websites', WebsiteController::class)->only([
                'index', 'show',
            ]);
            Route::resource('profiles.collections', CollectionController::class)->only([
                'index', 'show',
            ]);
            Route::resource('profiles.collections.comments', CollectionCommentController::class)->only([
                'store',
            ]);
            Route::resource('profiles.collections.items', CollectionItemController::class)->only([
                'show',
            ]);
            Route::resource('profiles.collections.items.comments', CollectionItemCommentController::class)->only([
                'store',
            ]);
        });

        Route::namespace('Group')->group(function () {
            Route::name('groups.')->prefix('groups')->group(function () {
                 Route::get('/search', 'GroupController@basicSearch')->name('search')->middleware('throttle:100,5');
                Route::get('/{group}', 'GroupController@show')->name('show');
                Route::post('/{group}/sendemail', 'GroupController@sendEmail')->name('sendemail');
            });
            Route::resource('groups.documents', DocumentController::class)->only([
                'show',
            ]);
            Route::resource('groups.exhibits', ExhibitController::class)->only([
                'index', 'show',
            ]);
            Route::resource('groups.exhibits.artworks', ArtworkController::class)->only([
                'index', 'show',
            ]);
            Route::resource('groups.exhibits.artworks.comments', ArtworkCommentController::class)->only([
                'store',
            ]);
            Route::resource('groups.website-groups', WebsiteGroupController::class)->only([
                'index', 'show',
            ]);
            Route::resource('groups.website-groups.websites', WebsiteController::class)->only([
                'index', 'show',
            ]);
            Route::resource('groups.collections', CollectionController::class)->only([
                'index', 'show',
            ]);
            Route::resource('groups.collections.comments', CollectionCommentController::class)->only([
                'store',
            ]);
            Route::resource('groups.collections.items', CollectionItemController::class)->only([
                'show',
            ]);
            Route::resource('groups.collections.items.comments', CollectionItemCommentController::class)->only([
                'store',
            ]);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    | - Register
    | - Login
    | - Forgot Password
    | - Reset Password
    */
    Route::name('authentication.')->group(function () {
        Route::prefix('register')->name('register.')->group(function () {
            Route::get('/', 'RegisterController@index')->name('index');
            Route::post('/', 'RegisterController@store')->name('store');
        });

        Route::prefix('login')->group(function () {
            Route::get('/', 'LoginController@index')->name('login');
            Route::post('/', 'LoginController@authenticate')->name('login.authenticate');
        });

        Route::prefix('forgot-password')->group(function () {
            Route::get('/', 'ForgotPasswordController@index')->name('forgot-password');
            Route::post('/', 'ForgotPasswordController@submit')->name('forgot-password.submit');
        });

        Route::prefix('/reset-password')->group(function () {
            Route::get('/{token}', 'ResetPasswordController@index')->name('reset-password');
            Route::post('/', 'ResetPasswordController@submit')->name('reset-password.submit');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Invitation Routes
    |--------------------------------------------------------------------------
    | - Registration
    | - Register
    */
    Route::name('invitation.')->group(function () {
        Route::get('invitation/{user_invitation}/subject/{subject}/register/{token}', 'InvitationController@registration')->name('registration');
        Route::post('invitation/{user_invitation}/subject/{subject}/register/{token}/process', 'InvitationController@register')->name('register');
    });
});

/*
|--------------------------------------------------------------------------
| Private Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    | - Logout
    | - Finalize
    */
    Route::name('authentication.')->group(function () {
        Route::get('logout', 'LogoutController@index')->name('logout');

        Route::prefix('register')->name('register.')->group(function () {
            Route::post('/finalize', 'RegisterController@finalize')->name('finalize')->middleware(['email-verified']);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Verification Routes
    |--------------------------------------------------------------------------
    | - Notice
    | - Profile Notice
    | - Send verification email
    | - Verify Email
    */
    Route::name('verification.')->group(function () {
        Route::get('/verify', 'VerificationController@notice')->name('notice');
        Route::get('/verify-profile', 'VerificationController@profileNotice')->name('profile-notice');
        Route::prefix('email')->group(function () {
            Route::post('/verification-notification', 'VerificationController@sendVerificationEmail')
                ->middleware(['throttle:6,1'])
                ->name('send-email');
            Route::get('/verify/{id}/{hash}', 'VerificationController@verifyEmail')
                ->middleware(['signed'])
                ->name('verify');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Invitation Routes
    |--------------------------------------------------------------------------
    | - Resend invitation mail
    */
    Route::name('invitations.')->prefix('invitations/')->group(function () {
        Route::get('{user_invitation}/resend-invitation-mail',
        function (App\Models\UserInvitation $userInvitation) {
            if ( $userInvitation->resendInvitationMail() ) {
                return back()->withSuccess(
                    __("Invitation has been resent to ".$userInvitation->getName()." <$userInvitation->email>.")
                );
            }

            return back()->withError(__("Invitation Email sending failed"));
        })->name('resend-invitation-mail');

        Route::delete('{user_invitation}',
            function (App\Models\UserInvitation $userInvitation) {
                $userInvitation->delete();
                return back()->withSuccess(__("Invitation has been deleted"));
        })->name('destroy');
    });
    Route::name("invite-gallery.")->prefix("/invite-gallery")->group(function () {
        Route::post('/{inviter}/create', 'InvitationController@galleryInvite')->name('create')->middleware('throttle:20,5');
    });

    /*
    |--------------------------------------------------------------------------
    | My Account Routes
    |--------------------------------------------------------------------------
    | - My account
    | - Edit My account
    | - Change password
    | - My Artist Profile
    | - My Artist Group
    | - My Curator Profile
    | - My Curator Group
    | - My Public Collector Profile
    */
    Route::namespace('MyAccount')->name('my-account.')->middleware(['email-verified','profile-verified','draft-gallery'])->group(function () {
        Route::prefix('my-account')->group(function () {
            Route::get('', 'MyAccountController@index')->name('index');
            Route::get('edit', 'MyAccountController@edit')->name('edit');
            Route::put('update-details', 'MyAccountController@updateDetails')->name('update-details');
            Route::get('change-password', 'MyAccountController@changePassword')->name('change-password');
            Route::put('update-password', 'MyAccountController@updatePassword')->name('update-password');
        });

        Route::resource('artist-profile', MyArtistProfileController::class)->except([
            'edit', 'update',
        ]);
        Route::name('artist-profile.')->prefix('artist-profile/{artist_profile}/')->group(function () {
            Route::get('toggle-enable', 'MyArtistProfileController@toggleEnable')->name('toggle-enable');
        });

        Route::resource('artist-group', MyArtistGroupController::class)->except([
            'edit', 'update',
        ]);
        Route::name('artist-group.')->prefix('artist-group/{artist_group}/')->group(function () {
            Route::get('toggle-enable', 'MyArtistGroupController@toggleEnable')->name('toggle-enable');
        });

        Route::resource('curator-profile', MyCuratorProfileController::class)->except([
            'edit', 'update',
        ]);
        Route::name('curator-profile.')->prefix('curator-profile/{curator_profile}/')->group(function () {
            Route::get('toggle-enable', 'MyCuratorProfileController@toggleEnable')->name('toggle-enable');
        });

        Route::resource('curator-group', MyCuratorGroupController::class)->except([
            'edit', 'update',
        ]);
        Route::name('curator-group.')->prefix('curator-group/{curator_group}/')->group(function () {
            Route::get('toggle-enable', 'MyCuratorGroupController@toggleEnable')->name('toggle-enable');
        });

        Route::resource('public-collector-profile', MyPublicCollectorProfileController::class)->except([
            'edit', 'update',
        ]);
        Route::name('public-collector-profile.')->prefix('public-collector-profile/{public_collector_profile}/')->group(function () {
            Route::get('toggle-enable', 'MyPublicCollectorProfileController@toggleEnable')->name('toggle-enable');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | My Profile Routes
    |--------------------------------------------------------------------------
    | - My Profile / My Documents
    | - My exhibits
    | - My artworks
    | - My website groups
    | - My websites
    | - My collections
    | - My collections items
    | - My Artist Run Center Gallery
    */
    Route::namespace('MyProfile')->middleware(['email-verified', 'profile-verified'])->group(function () {
        Route::resource('my-profile', MyProfileController::class)->only([
            'show', 'edit', 'update', 'destroy',
        ]);
        Route::name('my-profile.')->prefix('my-profile/{my_profile}/')->group(function () {
            Route::get('toggle-enable', 'MyProfileController@toggleEnable')->name('toggle-enable');
        });

        Route::resource('my-profile.my-documents', MyDocumentController::class);
        Route::name('my-profile.my-documents.')->prefix('my-profile/{my_profile}/my-documents/{my_document}/')->group(function () {
            Route::get('toggle-enable', 'MyDocumentController@toggleEnable')->name('toggle-enable');
            Route::get('change-position/{position}', 'MyDocumentController@changePosition')->name('change-position');
        });

        Route::resource('my-profile.my-exhibits', MyExhibitController::class);
        Route::name('my-profile.my-exhibits.')->prefix('my-profile/{my_profile}/my-exhibits/{my_exhibit}/')->group(function () {
            Route::get('toggle-enable', 'MyExhibitController@toggleEnable')->name('toggle-enable');
            Route::get('transfer-to', 'MyExhibitController@transferTo')->name('transfer-to');
            Route::post('transfer-to/post', 'MyExhibitController@postTransferTo')->name('post.transfer-to');
            Route::post('process-invite', 'MyExhibitController@processInvite')->name('process-invite');
            Route::get('change-position/{position}', 'MyExhibitController@changePosition')->name('change-position');
            Route::post('exhibit-download', 'MyDownloadController@RequestHandler')->name('exhibit-download');
        });
        Route::resource('my-profile.my-exhibits.my-artworks', MyArtworkController::class);
        Route::name('my-profile.my-exhibits.my-artworks.')->prefix('my-profile/{my_profile}/my-exhibits/{my_exhibit}/my-artworks/{my_artwork}/')->group(function () {
            Route::post('transfer-to/post', 'MyArtworkController@postTransferTo')->name('post.transfer-to');
            Route::get('change-position/{position}', 'MyArtworkController@changePosition')->name('change-position');
            Route::post('artwork-download', 'MyDownloadController@RequestHandler')->name('artwork-download');
        });

        Route::resource('my-profile.my-website-groups', MyWebsiteGroupController::class);
        Route::name('my-profile.my-website-groups.')->prefix('my-profile/{my_profile}/my-website-groups/{my_website_group}/')->group(function () {
            Route::get('toggle-enable', 'MyWebsiteGroupController@toggleEnable')->name('toggle-enable');
            Route::get('change-position/{position}', 'MyWebsiteGroupController@changePosition')->name('change-position');
        });
        Route::resource('my-profile.my-website-groups.my-websites', MyWebsiteController::class);
        Route::name('my-profile.my-website-groups.my-websites.')->prefix('my-profile/{my_profile}/my-website-groups/{my_website_group}/my-websites/{my_website}/')->group(function () {
            Route::get('change-position/{position}', 'MyWebsiteController@changePosition')->name('change-position');
        });

        Route::resource('my-profile.my-collections', MyCollectionController::class);
        Route::name('my-profile.my-collections.')->prefix('my-profile/{my_profile}/my-collections/{my_collection}/')->group(function () {
            Route::get('toggle-enable', 'MyCollectionController@toggleEnable')->name('toggle-enable');
            Route::get('change-position/{position}', 'MyCollectionController@changePosition')->name('change-position');
        });
        Route::resource('my-profile.my-collections.items', MyCollectionItemController::class)->only([
            'show', 'store', 'destroy',
        ]);
        Route::name('my-profile.my-collections.items.')->prefix('my-profile/{my_profile}/my-collections/{my_collection}/items/{item}')->group(function () {
            Route::get('change-position/{position}', 'MyCollectionItemController@changePosition')->name('change-position');
        });

        Route::resource('my-profile.my-model-removed', MyModelRemovedController::class)->only([
            'index', 'store', 'destroy',
        ]);

        Route::get('my-profile/{my_profile}/my-artist-run-center-gallery/{profile_type}',
            'MyArtistRunCenterGalleryController@index'
        )
        ->name('my-profile.my-artist-run-center-gallery.index')
        ->whereIn('profile_type', EnumProfileType::list());
        Route::resource('my-profile.my-artist-run-center-gallery', MyArtistRunCenterGalleryController::class)->except([
            'edit','update','index'
        ]);
        Route::name('my-profile.my-artist-run-center-gallery.')->prefix('my-profile/{my_profile}/my-artist-run-center-gallery/{my_artist_run_center_gallery}/')->group(function () {
            Route::get('toggle-enable', 'MyArtistRunCenterGalleryController@toggleEnable')->name('toggle-enable');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | My Group Routes
    |--------------------------------------------------------------------------
    | - My Group / My documents
    | - My exhibits
    | - My artworks
    | - My website groups
    | - My websites
    | - My collections
    | - My collections items
    | - Members
    */
    Route::namespace('MyGroup')->middleware(['email-verified', 'profile-verified'])->group(function () {
        Route::resource('my-group', MyGroupController::class)->only([
            'show', 'edit', 'update', 'destroy',
        ]);
        Route::name('my-group.')->prefix('my-group/{my_group}/')->group(function () {
            Route::get('toggle-enable', 'MyGroupController@toggleEnable')->name('toggle-enable');
        });

        Route::resource('my-group.my-documents', MyDocumentController::class);
        Route::name('my-group.my-documents.')->prefix('my-group/{my_group}/my-documents/{my_document}/')->group(function () {
            Route::get('toggle-enable', 'MyDocumentController@toggleEnable')->name('toggle-enable');
            Route::get('change-position/{position}', 'MyDocumentController@changePosition')->name('change-position');
        });

        Route::resource('my-group.my-exhibits', MyExhibitController::class);
        Route::name('my-group.my-exhibits.')->prefix('my-group/{my_group}/my-exhibits/{my_exhibit}/')->group(function () {
            Route::get('toggle-enable', 'MyExhibitController@toggleEnable')->name('toggle-enable');
            Route::get('transfer-to', 'MyExhibitController@transferTo')->name('transfer-to');
            Route::post('transfer-to/post', 'MyExhibitController@postTransferTo')->name('post.transfer-to');
            Route::post('process-invite', 'MyExhibitController@processInvite')->name('process-invite');
            Route::get('change-position/{position}', 'MyExhibitController@changePosition')->name('change-position');
        });
        Route::resource('my-group.my-exhibits.my-artworks', MyArtworkController::class);
        Route::name('my-group.my-exhibits.my-artworks.')->prefix('my-group/{my_group}/my-exhibits/{my_exhibit}/my-artworks/{my_artwork}/')->group(function () {
            Route::post('transfer-to/post', 'MyArtworkController@postTransferTo')->name('post.transfer-to');
            Route::get('change-position/{position}', 'MyArtworkController@changePosition')->name('change-position');
        });

        Route::resource('my-group.my-website-groups', MyWebsiteGroupController::class);
        Route::name('my-group.my-website-groups.')->prefix('my-group/{my_group}/my-website-groups/{my_website_group}/')->group(function () {
            Route::get('toggle-enable', 'MyWebsiteGroupController@toggleEnable')->name('toggle-enable');
            Route::get('change-position/{position}', 'MyWebsiteGroupController@changePosition')->name('change-position');
        });
        Route::resource('my-group.my-website-groups.my-websites', MyWebsiteController::class);
        Route::name('my-group.my-website-groups.my-websites.')->prefix('my-group/{my_group}/my-website-groups/{my_website_group}/my-websites/{my_website}/')->group(function () {
            Route::get('change-position/{position}', 'MyWebsiteController@changePosition')->name('change-position');
        });

        Route::resource('my-group.my-collections', MyCollectionController::class);
        Route::name('my-group.my-collections.')->prefix('my-group/{my_group}/my-collections/{my_collection}/')->group(function () {
            Route::get('toggle-enable', 'MyCollectionController@toggleEnable')->name('toggle-enable');
            Route::get('change-position/{position}', 'MyCollectionController@changePosition')->name('change-position');
        });
        Route::resource('my-group.my-collections.items', MyCollectionItemController::class)->only([
            'show', 'store', 'destroy',
        ]);
        Route::name('my-group.my-collections.items.')->prefix('my-group/{my_group}/my-collections/{my_collection}/items/{item}')->group(function () {
            Route::get('change-position/{position}', 'MyCollectionItemController@changePosition')->name('change-position');
        });

        Route::resource('my-group.my-model-removed', MyModelRemovedController::class)->only([
            'index', 'store', 'destroy',
        ]);

        Route::resource('my-group.members', MemberController::class);
        Route::name('my-group.members.')->prefix('my-group/{my_group}/members/')->group(function () {
            Route::post('process-invite', 'MemberController@processInvite')->name('process-invite');
        });
        Route::resource('my-group.verification', VerificationController::class)->only([
            'index',
        ]);
        Route::name('my-group.verification.')->prefix('my-group/{my_group}/verification/{exhibit}')->controller(VerificationController::class)->group(function () {
            Route::put('update','update')->name('update');
            Route::get('show','show')->name('show');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Media Routes
    |--------------------------------------------------------------------------
    | - Media
    */
    Route::resource('medias', MediaController::class)->only([
        'destroy',
    ]);
});
