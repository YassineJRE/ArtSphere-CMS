@isset($documents)
    @if ($documents->count() > 0)
        @php
            $documentsPaginated = $documents->orderBy('order_column')->paginate(6);
        @endphp
        <div class="col-md-12">
            <div id="dokan-seller-listing-wrap" class="grid-view">
                <div class="seller-listing-content">
                    <ul class="dokan-seller-wrap">
                        @foreach ($documentsPaginated as $document)
                            <li
                                @if ($documentsPaginated->count() <= 1)
                                    class="dokan-single-seller woocommerce composition-1"
                                @elseif ($documentsPaginated->count() == 2)
                                    class="dokan-single-seller woocommerce composition-2"
                                @elseif ($documentsPaginated->count() == 3)
                                    class="dokan-single-seller woocommerce composition-3"
                                @else
                                    class="dokan-single-seller woocommerce composition-6"
                                @endif
                            >
                                <a 
                                    @if ($document->belongsToProfile())
                                        href="{{ route('app.profiles.documents.show',[
                                            'profile' => $document->owner_id, 
                                            'document' => $document->id, 
                                            'search' => request()->search,
                                            'discover' => request()->discover,
                                        ]) }}" 
                                    @elseif ($document->belongsToGroup())
                                        href="{{ route('app.groups.documents.show',[
                                            'group' => $document->owner_id, 
                                            'document' => $document->id,
                                            'search' => request()->search,
                                            'discover' => request()->discover,
                                        ]) }}"
                                    @endif
                                >
                                    <div class="store-wrapper">
                                        <div class="store-header">
                                            <div class="store-banner">
                                                @include('components.media.document', [
                                                    'document' => $document
                                                ])
                                            </div>
                                        </div>
                                        <div class="store-content ">
                                            <div class="store-data-container">
                                                <div class="featured-favourite"></div>
                                                <div class="store-data">
                                                    <h2>{{ $document->name }}</h2>
                                                    <p>{{ $document->description }}</p>
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
        </div>

        {{-- Section pagination documents--}}
        <div class="col-md-12">
            @include('components.main-buttons', [
                'rightButtons' => [
                    ( $documentsPaginated->previousPageUrl() ? [
                        'label' => '',
                        'link' => $documentsPaginated->previousPageUrl(),
                        'icon' => 'arrow-left',
                        'type' => 'outline'
                        ] : []
                    ),
                    ( $documentsPaginated->nextPageUrl() ? [
                        'label' => '',
                        'link' => $documentsPaginated->nextPageUrl(),
                        'icon' => 'arrow-right',
                        'type' => 'outline'
                        ] : []
                    )
                ]
            ])
        </div>
        {{-- End Section pagination documents--}}
    @endif
@endisset    