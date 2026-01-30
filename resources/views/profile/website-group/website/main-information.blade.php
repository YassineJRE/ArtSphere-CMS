@isset($website)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="col-md-12 my-profile-content add-file margin-top-20 margin-bottom-20">
                @isset($website->url)                
                    <a
                        target="_blank"
                        href="{{ $website->url }}"
                    >
                        @include('components.media.website', [
                            'website' => $website
                        ])
                    </a>
                @else
                    @include('components.media.website', [
                        'website' => $website
                    ])
                @endisset
            </div>
        </div>
        <div 
            id="main-information"
            class="col-md-12 my-profile"
        >
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                <b>{{ $website->type }}</b><br>
                <b>{{ $website->title }}</b><br>
            </div>
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                <b>
                    @if ($website->owner_name)
                        <a href="{{ $website->owner_link }}" target="_blank">
                            <u>{{ $website->owner_name }}</u>
                        </a>
                    @endif
                </b><br>
                <b>
                    <a href="{{ $website->url }}" target="_blank">
                        <u>{{ $website->url }}</u>
                    </a>
                </b><br>
            </div>
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('profile.views.added-by') }} 
                <a
                    target="_blank"
                    @if ($website->parent->belongsToProfile())
                        href="{{ route('app.profiles.show',[
                            'profile' => $website->parent->owner_id,
                            'search' => request()->search,
                            'discover' => request()->discover,
                        ]) }}" 
                    @elseif ($website->parent->belongsToGroup())
                        href="{{ route('app.groups.show',[
                            'group' => $website->parent->owner_id,
                            'search' => request()->search,
                            'discover' => request()->discover,
                        ]) }}"
                    @endif
                ><u><b>{{ $website->parent->owner->getName() }}</b></u></a><br>
                <a href="#more-information">
                    <u><i>{{ __('profile.views.button.more-information') }}</i></u>
                </a>
            </div>
            <div class="col-md-3 main-information-buttons my-profile-content margin-top-20 margin-bottom-20">
                <div class="padding-bottom-5">
                    <div class="elementor-align-right">
                        @include('profile.website-group.website.top-buttons',['website' => $website])
                        @isset($previousWebsiteId)                                                        
                            <a
                                @if ($website->parent->belongsToGroup())
                                    href="{{ route('app.groups.website-groups.websites.show',[
                                        'group' => $website->parent->owner_id,
                                        'website_group' => $website->parent_id,
                                        'website' => $previousWebsiteId,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @elseif ($website->parent->belongsToProfile())
                                    href="{{ route('app.profiles.website-groups.websites.show',[
                                        'profile' => $website->parent->owner_id,
                                        'website_group' => $website->parent_id,
                                        'website' => $previousWebsiteId,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @endif
                                role="button"
                                class="elementor-button outline previous-btn" 
                            >
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">
                                        <i class="sl sl-icon-arrow-left"></i>
                                    </span>
                                </span>
                            </a>
                        @endisset
                        @isset($nextWebsiteId)                                                        
                            <a
                                @if ($website->parent->belongsToGroup())
                                    href="{{ route('app.groups.website-groups.websites.show',[
                                        'group' => $website->parent->owner_id,
                                        'website_group' => $website->parent_id,
                                        'website' => $nextWebsiteId,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @elseif ($website->parent->belongsToProfile())
                                    href="{{ route('app.profiles.website-groups.websites.show',[
                                        'profile' => $website->parent->owner_id,
                                        'website_group' => $website->parent_id,
                                        'website' => $nextWebsiteId,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @endif                                
                                role="button"
                                class="elementor-button outline next-btn" 
                            >
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">
                                        <i class="sl sl-icon-arrow-right"></i>
                                    </span>
                                </span>
                            </a>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset    