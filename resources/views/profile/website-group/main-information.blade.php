@isset($websiteGroup)
    <div class="row">
        <div
            id="main-information"
            class="col-md-12 my-profile with-separator"
        >
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                <b>{{ $websiteGroup->getType() }}</b><br>
                <b>{{ $websiteGroup->title }}</b><br>
            </div>
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                <b>
                    @foreach ($websiteGroup->websites as $website)
                        @if ($website->owner_name)
                            <a href="{{ $website->owner_link }}" target="_blank">
                                <u>{{ $website->owner_name }}</u>
                            </a>@if (!$loop->last), @endif                        
                        @endif
                    @endforeach
                </b><br>
            </div>
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('profile.views.added-by') }} 
                <a
                    target="_blank"
                    @if ($websiteGroup->belongsToProfile())
                        href="{{ route('app.profiles.show',[
                            'profile' => $websiteGroup->owner_id,
                            'search' => request()->search,
                            'discover' => request()->discover,
                        ]) }}" 
                    @elseif ($websiteGroup->belongsToGroup())
                        href="{{ route('app.groups.show',[
                            'group' => $websiteGroup->owner_id,
                            'search' => request()->search,
                            'discover' => request()->discover,
                        ]) }}"
                    @endif
                ><u><b>{{ $websiteGroup->owner->getName() }}</b></u></a><br>
                <a href="#more-information">
                    <u><i>{{ __('profile.views.button.more-information') }}</i></u>
                </a>
            </div>
            <div class="col-md-3 main-information-buttons my-profile-content margin-top-20 margin-bottom-20">
                <div class="padding-bottom-5">
                    <div class="elementor-align-right">
                        @include('profile.website-group.top-buttons',['websiteGroup' => $websiteGroup])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset