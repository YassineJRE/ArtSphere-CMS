@isset($exhibits)
    @if ($exhibits->filter()->count() > 0)
        @php
            $exhibitsPaginated = $exhibits->filter()->orderBy('order_column')->paginate(6);
        @endphp
        
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($exhibitsPaginated as $exhibit)
                        <li
                            @if ($exhibitsPaginated->count() <= 1)
                                class="dokan-single-seller woocommerce composition-1"
                            @elseif ($exhibitsPaginated->count() == 2)
                                class="dokan-single-seller woocommerce composition-2"
                            @elseif ($exhibitsPaginated->count() == 3)
                                class="dokan-single-seller woocommerce composition-3"
                            @else
                                class="dokan-single-seller woocommerce composition-6"
                            @endif
                        >
                            <a 
                                @if ($exhibit->belongsToProfile())
                                    href="{{ route('app.profiles.exhibits.show',[
                                        'profile' => $exhibit->owner_id, 
                                        'exhibit' => $exhibit->id, 
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}" 
                                @elseif ($exhibit->belongsToGroup())
                                    href="{{ route('app.groups.exhibits.show',[
                                        'group' => $exhibit->owner_id, 
                                        'exhibit' => $exhibit->id,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @endif
                            >
                                <div class="store-wrapper exhibit-card" data-full-title="{{ $exhibit->name }}">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.exhibit', [
                                                'exhibit' => $exhibit
                                            ])
                                        </div>
                                    </div>
                                    <div class="store-content">
                                        <div class="store-data-container">
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2 class="exhibit-title">{{ $exhibit->name }}</h2>
                                                <p>{{ $exhibit->type }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-footer" >
                                        <h2 class="exhibit-title">{{ $exhibit->name }}</h2>
                                        <p>{{ $exhibit->type }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <div class="dokan-clearfix"></div>
                </ul>
            </div>
        </div>

        {{-- Section pagination exhibits--}}
            @include('components.main-buttons', [
                'rightButtons' => [
                    ( $exhibitsPaginated->previousPageUrl() ? [
                        'label' => '',
                        'link' => $exhibitsPaginated->previousPageUrl(),
                        'icon' => 'arrow-left',
                        'type' => 'outline'
                        ] : []
                    ),
                    ( $exhibitsPaginated->nextPageUrl() ? [
                        'label' => '',
                        'link' => $exhibitsPaginated->nextPageUrl(),
                        'icon' => 'arrow-right',
                        'type' => 'outline'
                        ] : []
                    )
                ]
            ])
        {{-- End Section pagination exhibits--}}
    @endif
@endisset

