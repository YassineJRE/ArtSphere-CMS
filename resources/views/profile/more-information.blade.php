@isset($profile)
    <section class="fullwidth" data-background-color="#f9f9f9">
        <div class="container" id="more-information">
            <div class="row">
                <div class="col-md-12 my-profile">
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        <b>{{ __('profile.views.more-information.name') }}</b> {{ $profile->getName() }}<br>
                        @if ($profile->biography)
                            <b>{{ __('profile.views.more-information.biography') }}</b> {!! nl2br($profile->biography) !!}<br>                            
                        @endif
                        @if ($profile->user->prefix)
                            <b>{{ __('profile.views.more-information.prefix') }}</b> {{ $profile->user->prefix ?? 'N/A' }}<br>
                        @endif
                        @if ($profile->user->ethnicity)
                            <b>{{ __('profile.views.more-information.ethnicity') }}</b> {{ $profile->user->ethnicity ?? 'N/A' }}<br>
                        @endif
                        @if ($profile->artist_type)
                            <b>{{ __('profile.views.more-information.artist-type') }}</b> {{ $profile->artist_type ? __('enums.artist-type.'.$profile->artist_type): '' }}<br>                            
                        @endif
                        @if ($profile->getArtPracticeType())
                            <b>{{ __('profile.views.more-information.art-practice-type') }}</b> {{ $profile->getArtPracticeType() }}<br>    
                        @endif
                        @if ($profile->member_of)
                            <b>{{ __('profile.views.more-information.member-of') }}</b> {{ $profile->member_of }}<br>
                        @endif
                    </div>
                    @if ($profile->additional_information_title)
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        <b>{!! nl2br($profile->additional_information_title) !!}</b> {!! nl2br($profile->additional_information_content) !!}<br> 
                    </div>                        
                @endif
                    @isset ($showContactForm)
                        @auth
                            <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                                <b>{{ __('profile.views.paragraph.contact-profile') }}</b><br>
                                @include('profile.contact', [
                                    'action' => route('app.profiles.sendemail',['profile' => $profile])
                                ])
                            </div>
                        @endauth
                    @endisset
                </div>
            </div>
        </div>
    </section>
@endisset