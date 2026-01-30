@isset($group)
    <div class="row">
        <div class="col-md-12 my-profile with-separator">
            @if ($group->isArtistRunCenterOrganisation())
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-group.views.show.footer.institution-name') }} <b>{{ $group->getName() }}</b><br>
                    {{ __('my-group.views.show.footer.address') }} <b>{{ $group->address }}</b><br>
                    {{ __('my-group.views.show.footer.city') }} <b>{{ $group->city }}</b><br>
                    {{ __('my-group.views.show.footer.country') }} <b>{{ $group->country }}</b><br>
                </div>
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-group.views.show.footer.institution-type') }} <b>{{ $group->institution_type ? __("enums.institution-type.$group->institution_type") : '' }}</b><br>
                    {{ __('my-group.views.show.footer.mandate') }} <b>{!! nl2br($group->mandate) !!}</b><br>
                    {{ __('my-group.views.show.footer.member-of') }} <b>{{ $group->member_of }}</b><br>
                    @if ($group->additional_information_title)
                        {{ $group->additional_information_title }}: <b>{!! nl2br($group->additional_information_content) !!}</b><br>
                    @endif
                </div>
            @elseif ($group->isCurator())
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-group.views.show.footer.group-name') }} <b>{{ $group->getName() }}</b><br>
                    {{ __('my-group.views.show.footer.member') }}
                    @foreach ($group->members as $member)
                        <b><a
                            target="_blank"
                            title="{{ $member->profile->getLongName() }}"
                            href="{{ route('app.profiles.show',[
                                'profile' => $member->profile->id,
                            ]) }}"
                        ><u>{{ $member->profile->getName() }}</u></a></b>@if(!$loop->last),@endif
                    @endforeach
                    <br>
                    {{ __('my-group.views.show.footer.biography') }} <b>{!! nl2br($group->biography) !!}</b><br>
                </div>
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-group.views.show.footer.country') }} <b>{{ $group->country }}</b><br>
                    {{ __('my-group.views.show.footer.member-of') }} <b>{{ $group->member_of }}</b><br>
                    @if ($group->additional_information_title)
                        {{ $group->additional_information_title }}: <b>{!! nl2br($group->additional_information_content) !!}</b><br>
                    @endif
                </div>
            @else
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-group.views.show.footer.group-name') }} <b>{{ $group->getName() }}</b><br>
                    {{ __('my-group.views.show.footer.member') }}
                    @foreach ($group->members as $member)
                        <b><a
                            target="_blank"
                            title="{{ $member->profile->getLongName() }}"
                            href="{{ route('app.profiles.show',[
                                'profile' => $member->profile->id,
                            ]) }}"
                        ><u>{{ $member->profile->getName() }}</u></a></b>@if(!$loop->last),@endif
                    @endforeach
                    <br>
                    {{ __('my-group.views.show.footer.biography') }} <b>{!! nl2br($group->biography) !!}</b><br>
                </div>
                <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                    {{ __('my-group.views.show.footer.country') }} <b>{{ $group->country }}</b><br>
                    {{ __('my-group.views.show.footer.member-of') }} <b>{{ $group->member_of }}</b><br>
                    {{ __('my-group.views.show.footer.art-practice-type') }} <b>{{ $group->getArtPracticeType() }}</b><br>
                    @if ($group->additional_information_title)
                        {{ $group->additional_information_title }}: <b>{!! nl2br($group->additional_information_content) !!}</b><br>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endisset
