@isset($collection)
    @php
        $filteredItems = $collection->items()->filter();
    @endphp

    @if ($filteredItems->exists())
        @php
            $items = $filteredItems->orderBy('order_column')->paginate(6);
            $classMap = [
                1 => 'composition-1',
                2 => 'composition-2',
                3 => 'composition-3',
            ];
            $compositionClass = $classMap[$items->count()] ?? 'composition-6';
            $queryParams = request()->only('search', 'discover');
        @endphp

        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($items as $item)
                        <li class="dokan-single-seller woocommerce {{ $compositionClass }}">
                            <a href="{{ $item->getModelRoute($queryParams) }}">
                                <div class="store-wrapper">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.item', ['item' => $item])
                                        </div>
                                    </div>
                                    <div class="store-content">
                                        <div class="store-data-container">
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2>{{ $item->name }}</h2>
                                                <p>{{ $item->description }}</p>
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

        @if ($items->hasPages())
            <div class="col-md-12">
                @php
                    $prevPage = $items->previousPageUrl();
                    $nextPage = $items->nextPageUrl();
                    $rightButtons = [];

                    if ($prevPage) {
                        $rightButtons[] = [
                            'label' => '',
                            'link' => $prevPage,
                            'icon' => 'arrow-left',
                            'type' => 'outline',
                        ];
                    }

                    if ($nextPage) {
                        $rightButtons[] = [
                            'label' => '',
                            'link' => $nextPage,
                            'icon' => 'arrow-right',
                            'type' => 'outline',
                        ];
                    }
                @endphp

                @include('components.main-buttons', ['rightButtons' => $rightButtons])
            </div>
        @endif
    @endif
@endisset
