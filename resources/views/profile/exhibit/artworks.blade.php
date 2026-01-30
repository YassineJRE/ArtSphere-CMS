@isset($exhibit)
    @if ($exhibit->artworks->count() > 0)

        @php
            $artworks = $exhibit->artworks();
            // if a group is trying to verify a private exhibit we don't want to filter private out
            if(Route::current()->getName() != 'my-group.verification.show'){
                $artworks = $artworks->filter();
            }
            $artworks = $artworks->orderBy('order_column')->simplePaginate(6)->appends(request()->query());
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($artworks as $artwork)
                        <li 
                            @if ($artworks->count() <= 1)
                                class="dokan-single-seller woocommerce composition-1"
                            @elseif ($artworks->count() == 2)
                                class="dokan-single-seller woocommerce composition-2"
                            @elseif ($artworks->count() == 3)
                                class="dokan-single-seller woocommerce composition-3"
                            @else
                                class="dokan-single-seller woocommerce composition-6"
                            @endif
                        >
                            <a
                                @if (Route::current()->getName() == 'app.exhibits.show' || Route::current()->getName() == 'my-group.verification.show')
                                    href="{{ route('app.exhibits.artworks.show',[
                                        'exhibit' => $exhibit->id, 
                                        'artwork' => $artwork->id,
                                        'token' => request()->token
                                    ]) }}"
                                @elseif ($exhibit->belongsToProfile())
                                    href="{{ route('app.profiles.exhibits.artworks.show',[
                                        'profile' => $exhibit->owner_id, 
                                        'exhibit' => $exhibit->id, 
                                        'artwork' => $artwork->id,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                        'token' => request()->token
                                    ]) }}"
                                @elseif ($exhibit->belongsToGroup())
                                    href="{{ route('app.groups.exhibits.artworks.show',[
                                        'group' => $exhibit->owner_id, 
                                        'exhibit' => $exhibit->id, 
                                        'artwork' => $artwork->id,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                        'token' => request()->token
                                    ]) }}"
                                @endif
                            >
                                <div class="store-wrapper">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.artwork', [
                                                'artwork' => $artwork
                                            ])
                                        </div>
                                    </div>
                                    <div class="store-content ">
                                        <div class="store-data-container">
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2>{{ $artwork->name }}</h2>
                                                <p>{{ $artwork->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <div class="dokan-clearfix"></div>
                </ul>
            </div>
        </div>

        {{-- Section pagination artworks--}}
        @isset($hasArtworksPagination)        
            @include('components.main-buttons', [
                'rightButtons' => [
                    ( $artworks->previousPageUrl() ? [
                        'label' => '',
                        'link' => $artworks->previousPageUrl(),
                        'icon' => 'arrow-left',
                        'type' => 'outline'
                        ] : []
                    ),
                    ( $artworks->nextPageUrl() ? [
                        'label' => '',
                        'link' => $artworks->nextPageUrl(),
                        'icon' => 'arrow-right',
                        'type' => 'outline'
                        ] : []
                    )
                ]
            ])
        @endisset
        {{-- End Section pagination artworks--}}
    @endif
@endisset