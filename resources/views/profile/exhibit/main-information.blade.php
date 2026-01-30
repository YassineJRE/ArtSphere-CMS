@isset($exhibit)
    <div class="row">
        <div 
            id="main-information"
            class="col-md-12 my-profile @if($exhibit->artworks->count() > 0) with-separator @endif"
        >
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                <b>{{ $exhibit->owner->getName() }}</b><br>
                <b>{{ $exhibit->name }}</b><br>
            </div>
            <div class="col-md-3 my-profile-content margin-top-20 margin-bottom-20">
                <b>
                    {{$exhibit->getLocations()->prepend($exhibit->location)->filter()->unique()->implode(', ')}}
                </b><br>
                <b>
                    @foreach ($exhibit->getDatesInYear() as $dateInYear)
                        {{ $dateInYear }}@if (!$loop->last), @endif
                    @endforeach
                </b><br>
            </div>
            <div class="col-md-2 my-profile-content margin-top-20 margin-bottom-20">
                <a href="#more-information">
                    <b>{{ $exhibit->grant_acknowledgement }}</b><br>
                    <u><i>{{ __('profile.views.button.more-information') }}</i></u>
                </a>
            </div>
            <div class="col-md-4 main-information-buttons margin-top-20 margin-bottom-20">
                <div class="padding-bottom-5">
                    <div class="elementor-align-right">
                        @include('profile.exhibit.top-buttons',['exhibit' => $exhibit])
                        @isset($previousExhibitId)                                                        
                            <a href="{{ route('app.exhibits.show',[
                                    'exhibit' => $previousExhibitId, 
                                    'search' => request()->search, 
                                    'discover' => request()->discover ? $previousExhibitId : null
                                ]) }}"
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
                        @isset($nextExhibitId)                                                        
                            <a href="{{ route('app.exhibits.show',[
                                    'exhibit' => $nextExhibitId,
                                    'search' => request()->search, 
                                    'discover' => request()->discover ? $nextExhibitId : null,
                                ]) }}"
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