@isset($profile)
    <div class="row">
        <div class="col-md-12 my-profile with-separator">
            @if ($profile->isPublicCollector())
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-profile.views.show.footer.pronoun') }} <b>{{ $profile->user->pronoun }}</b><br>
                    {{ __('my-profile.views.show.footer.first-name') }} <b>{{ $profile->user->first_name }}</b><br>
                    {{ __('my-profile.views.show.footer.last-name') }} <b>{{ $profile->user->last_name }}</b><br>
                </div>
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-profile.views.show.footer.ethnicity') }} <b>{{ $profile->user->ethnicity }}</b><br>
                    {{ __('my-profile.views.show.footer.country') }} <b>{{ $profile->user->country }}</b><br>
                    {{ __('my-profile.views.show.footer.member-of') }} <b>{{ $profile->member_of }}</b><br>
                </div>
            @elseif ($profile->isCurator())
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-profile.views.show.footer.pronoun') }} <b>{{ $profile->user->pronoun }}</b><br>
                    {{ __('my-profile.views.show.footer.artist-name') }} <b>{{ $profile->artist_name }}</b><br>
                    {{ __('my-profile.views.show.footer.first-name') }} <b>{{ $profile->user->first_name }}</b><br>
                    {{ __('my-profile.views.show.footer.last-name') }} <b>{{ $profile->user->last_name }}</b><br>
                    {{ __('my-profile.views.show.footer.biography') }} <b>{!! nl2br($profile->biography) !!}</b><br>
                </div>
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-profile.views.show.footer.ethnicity') }} <b>{{ $profile->user->ethnicity }}</b><br>
                    {{ __('my-profile.views.show.footer.country') }} <b>{{ $profile->user->country }}</b><br>
                    {{ __('my-profile.views.show.footer.member-of') }} <b>{{ $profile->member_of }}</b><br>
                    @if ($profile->additional_information_title)
                        {{ $profile->additional_information_title }}: <b>{!! nl2br($profile->additional_information_content) !!}</b><br>
                    @endif
                </div>
            @else
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-profile.views.show.footer.pronoun') }} <b>{{ $profile->user->pronoun }}</b><br>
                    {{ __('my-profile.views.show.footer.artist-name') }} <b>{{ $profile->artist_name }}</b><br>
                    {{ __('my-profile.views.show.footer.first-name') }} <b>{{ $profile->user->first_name }}</b><br>
                    {{ __('my-profile.views.show.footer.last-name') }} <b>{{ $profile->user->last_name }}</b><br>
                    {{ __('my-profile.views.show.footer.artist-type') }} <b>{{ $profile->artist_type }}</b><br>
                    {{ __('my-profile.views.show.footer.biography') }} <b>{!! nl2br($profile->biography) !!}</b><br>
                </div>
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-profile.views.show.footer.ethnicity') }} <b>{{ $profile->user->ethnicity }}</b><br>
                    {{ __('my-profile.views.show.footer.other-artist-name') }} <b>{{ $profile->other_artist_name }}</b><br>
                    {{ __('my-profile.views.show.footer.country') }} <b>{{ $profile->user->country }}</b><br>
                    {{ __('my-profile.views.show.footer.member-of') }} <b>{{ $profile->member_of }}</b><br>
                    {{ __('my-profile.views.show.footer.art-practice-type') }} <b>{{ $profile->getArtPracticeType() }}</b><br>
                    @if ($profile->additional_information_title)
                        {{ $profile->additional_information_title }}: <b>{!! nl2br($profile->additional_information_content) !!}</b><br>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endisset
