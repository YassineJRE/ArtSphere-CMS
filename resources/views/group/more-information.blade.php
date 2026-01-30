@isset($group)
    <section class="fullwidth" data-background-color="#f9f9f9">
        <div class="container" id="more-information">
            <div class="row">
                <div class="col-md-12 my-profile">
                    @if ($group->isArtist())
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            {{ __('profile.views.more-information.name') }} <b>{{ $group->getName() }}</b><br>
                            @if ($group->country)
                                {{ __('profile.views.more-information.country') }} <b>{{ $group->country }}</b><br>
                            @endif
                            @if ($group->member_of)
                                {{ __('profile.views.more-information.member-of') }} <b>{{ $group->member_of }}</b><br>
                            @endif
                            @if ($group->biography)
                                {{ __('profile.views.more-information.biography') }} <b>{!! nl2br($group->biography) !!}</b><br>
                            @endif
                            @if ($group->artist_type )
                                {{ __('profile.views.more-information.artist-type') }} <b>{{ $group->artist_type ? __('enums.artist-type.'.$group->artist_type): '' }}</b><br>
                            @endif
                            @if ($group->getArtPracticeType())
                                {{ __('profile.views.more-information.art-practice-type') }} <b>{{ $group->getArtPracticeType() }}</b><br>
                            @endif
                            @if ($group->additional_information_title)
                                {{ $group->additional_information_title }}: <b>{!! nl2br($group->additional_information_content) !!}</b><br>
                            @endif
                        </div>
                    @elseif ($group->isCurator())
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            {{ __('profile.views.more-information.name') }} <b>{{ $group->getName() }}</b><br>
                            @if ($group->country)
                                {{ __('profile.views.more-information.country') }} <b>{{ $group->country }}</b><br>
                            @endif
                            @if ($group->member_of)
                                {{ __('profile.views.more-information.member-of') }} <b>{{ $group->member_of }}</b><br>
                            @endif
                            @if ($group->biography)
                                {{ __('profile.views.more-information.biography') }} <b>{!! nl2br($group->biography) !!}</b><br>
                            @endif
                            @if ($group->additional_information_title)
                                {{ $group->additional_information_title }}: <b>{!! nl2br($group->additional_information_content) !!}</b><br>
                            @endif
                        </div>
                    @elseif ($group->isArtistRunCenterOrganisation())
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            {{ __('profile.views.more-information.name') }} <b>{{ $group->getName() }}</b><br>
                            @if ($group->institution_type )
                                {{ __('profile.views.more-information.institution-type') }} <b>{{ $group->institution_type ? __('enums.institution-type.'.$group->institution_type): '' }}</b><br>
                            @endif
                            @if ($group->address)
                                {{ __('profile.views.more-information.address') }} <b>{{ $group->address }}</b><br>
                            @endif
                            @if ($group->country)
                                {{ __('profile.views.more-information.country') }} <b>{{ $group->country }}</b><br>
                            @endif
                            @if ($group->member_of)
                                {{ __('profile.views.more-information.member-of') }} <b>{{ $group->member_of }}</b><br>
                            @endif
                            @if ($group->phone)
                                {{ __('profile.views.more-information.phone') }} <b>{{ $group->phone }}</b><br>
                            @endif
                            @if ($group->mandate)
                                {{ __('profile.views.more-information.mandate') }} <b>{!! nl2br($group->mandate) !!}</b><br>
                            @endif
                            @if ($group->additional_information_title)
                                {{ $group->additional_information_title }}: <b>{!! nl2br($group->additional_information_content) !!}</b><br>
                            @endif
                        </div>
                    @endif
                    @auth
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{{ __('profile.views.paragraph.contact-profile') }}</b><br>
                            @include('profile.contact', [
                                'action' => route('app.groups.sendemail',['group' => $group])
                            ])
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endisset
