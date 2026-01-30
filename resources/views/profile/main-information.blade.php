@isset($profile)
    <div class="row">
        <div 
            id="main-information"
            class="col-md-12 my-profile with-separator"
        >
            <div class="col-md-5 my-profile-content margin-top-20 margin-bottom-20">
                <b>{{ $profile->getName() }}</b><br>
                <b>{{ $profile->getArtPracticeType() }}</b><br>
            </div>
            <div class="col-md-5 my-profile-content margin-top-20 margin-bottom-20">
                <b>{{ __('enums.profile-type.'.$profile->type) }}</b><br>
                <a href="#more-information">
                    <u><i>{{ __('profile.views.button.more-information') }}</i></u>
                </a>
            </div>
            <div class="col-md-2 main-information-buttons margin-top-20 margin-bottom-20">
                <div class="padding-bottom-5">
                    <div class="elementor-align-right">
                        @include('profile.top-buttons',['profile' => $profile])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset