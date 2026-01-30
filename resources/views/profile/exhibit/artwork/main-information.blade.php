@isset($artwork)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="col-md-12 my-profile-content add-file margin-bottom-20">
                @include('components.media.artwork', [
                    'artwork' => $artwork,
                    'showIFrame' => true
                ])
            </div>
        </div>
        <div 
            id="main-information"
            class="col-md-12 my-profile"
        >
            <div class="col-md-3 my-profile-content margin-bottom-20">
                <b>{{ $artwork->exhibit->owner->getName() }}</b><br>
                <b>{{ $artwork->name }}</b><br>
            </div>
            <div class="col-md-3 my-profile-content margin-bottom-20">
                <b>{{ \Carbon\Carbon::parse($artwork->date)->format('Y') }}</b><br>
                {{ __('profile.views.main-information.photo') }} <u><a href="{{ $artwork->photographer_link }}" target="_blank">{{ $artwork->photographer }}</a></u><br>
            </div>
            <div class="col-md-3 my-profile-content margin-bottom-20">
                {{ __('profile.views.main-information.medium') }} <b>{{ $artwork->medium }}</b><br>
                <a href="#more-information">
                    <u><i>{{ __('profile.views.button.more-information') }}</i></u>
                </a>
            </div>
            <div class="col-md-3 main-information-buttons my-profile-content margin-bottom-20">
                <div class="padding-bottom-5">
                    <div class="elementor-align-right">
                        @include('profile.exhibit.artwork.top-buttons',['artwork' => $artwork])
                        @isset($previousArtworkId)                                                        
                            <a
                                @if (Route::current()->getName() == 'app.exhibits.artworks.show')
                                    href="{{ route('app.exhibits.artworks.show',[
                                        'exhibit' => $artwork->exhibit,
                                        'artwork' => $previousArtworkId,
                                        'token' => request()->token,
                                    ]) }}"
                                @elseif ($artwork->exhibit->belongsToGroup())
                                    href="{{ route('app.groups.exhibits.artworks.show',[
                                        'group' => $artwork->exhibit->owner_id,
                                        'exhibit' => $artwork->exhibit,
                                        'artwork' => $previousArtworkId,
                                        'search' => request()->search, 
                                        'discover' => request()->discover,
                                        'token' => request()->token,
                                    ]) }}"
                                @elseif ($artwork->exhibit->belongsToProfile())
                                    href="{{ route('app.profiles.exhibits.artworks.show',[
                                        'profile' => $artwork->exhibit->owner_id,
                                        'exhibit' => $artwork->exhibit,
                                        'artwork' => $previousArtworkId,
                                        'search' => request()->search, 
                                        'discover' => request()->discover,
                                        'token' => request()->token,
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
                        @isset($nextArtworkId)                                                        
                            <a
                                @if (Route::current()->getName() == 'app.exhibits.artworks.show')
                                    href="{{ route('app.exhibits.artworks.show',[
                                        'exhibit' => $artwork->exhibit,
                                        'artwork' => $nextArtworkId,
                                        'token' => request()->token,
                                    ]) }}"
                                @elseif ($artwork->exhibit->belongsToGroup())
                                    href="{{ route('app.groups.exhibits.artworks.show',[
                                        'group' => $artwork->exhibit->owner_id,
                                        'exhibit' => $artwork->exhibit,
                                        'artwork' => $nextArtworkId,
                                        'search' => request()->search, 
                                        'discover' => request()->discover,
                                        'token' => request()->token,
                                    ]) }}"
                                @elseif ($artwork->exhibit->belongsToProfile())
                                    href="{{ route('app.profiles.exhibits.artworks.show',[
                                        'profile' => $artwork->exhibit->owner_id,
                                        'exhibit' => $artwork->exhibit,
                                        'artwork' => $nextArtworkId,
                                        'search' => request()->search, 
                                        'discover' => request()->discover,
                                        'token' => request()->token,
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