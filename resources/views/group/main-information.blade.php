@isset($group)
    <div class="row">
        <div 
            id="main-information"
            class="col-md-12 my-profile with-separator"
        >
            <div class="col-md-5 my-profile-content margin-top-20 margin-bottom-20">
                <b>{{ $group->getName() }}</b><br>
                <b>{{ $group->getArtPracticeType() }}</b><br>
            </div>
            <div class="col-md-5 my-profile-content margin-top-20 margin-bottom-20">
                <b>{{ $group->type ? __('enums.group-type.'.$group->type) : '' }}</b><br>
                <a href="#more-information">
                    <u><i>{{ __('profile.views.button.more-information') }}</i></u>
                </a>
            </div>
            <div class="col-md-2 main-information-buttons margin-top-20 margin-bottom-20">
                <div class="padding-bottom-5">
                    <div class="elementor-align-right">
                        @include('profile.top-buttons',['profile' => $group])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset
