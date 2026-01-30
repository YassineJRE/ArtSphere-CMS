@isset($collections)
    @if ($collections->filter()->count() > 0)
        @php
            $collectionsPaginated = $collections->filter()->orderBy('order_column')->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($collectionsPaginated as $collection)
                        <li
                            @if ($collectionsPaginated->count() <= 1)
                                class="dokan-single-seller woocommerce composition-1"
                            @elseif ($collectionsPaginated->count() == 2)
                                class="dokan-single-seller woocommerce composition-2"
                            @elseif ($collectionsPaginated->count() == 3)
                                class="dokan-single-seller woocommerce composition-3"
                            @else
                                class="dokan-single-seller woocommerce composition-6"
                            @endif
                        >
                            <a
                                @if ($collection->belongsToProfile())
                                    href="{{ route('app.profiles.collections.show',[
                                        'profile' => $collection->owner_id,
                                        'collection' => $collection->id,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @elseif ($collection->belongsToGroup())
                                    href="{{ route('app.groups.collections.show',[
                                        'group' => $collection->owner_id,
                                        'collection' => $collection->id,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @endif
                            >
                                <div class="store-wrapper" data-full-title="{{ $collection->title }}">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.collection', [
                                                'collection' => $collection
                                            ])
                                        </div>
                                    </div>
                                    <div class="store-content">
                                        <div class="store-data-container">
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2>{{ $collection->title }}</h2>
                                                <p>{{ $collection->description }}</p>
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

        {{-- Section pagination collections--}}
        <div class="col-md-12">
            @include('components.main-buttons', [
                'rightButtons' => [
                    ( $collectionsPaginated->previousPageUrl() ? [
                        'label' => '',
                        'link' => $collectionsPaginated->previousPageUrl(),
                        'icon' => 'arrow-left',
                        'type' => 'outline'
                        ] : []
                    ),
                    ( $collectionsPaginated->nextPageUrl() ? [
                        'label' => '',
                        'link' => $collectionsPaginated->nextPageUrl(),
                        'icon' => 'arrow-right',
                        'type' => 'outline'
                        ] : []
                    )
                ]
            ])
        </div>
        {{-- End Section pagination collections--}}
    @endif
@endisset
