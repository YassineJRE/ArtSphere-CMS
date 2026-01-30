@isset($myCollection)
    @if ($myCollection->items->count() > 0)
        @php
            $myCollectionItemsPaginated = $myCollection->items()->orderBy('order_column')->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($myCollectionItemsPaginated as $item)
                        @php
                            $routePrefix = null;
                            $ownerId = $myCollection->owner_id;
                            if ($myCollection->belongsToProfile()) {
                                $routePrefix = 'my-profile.my-collections.items';
                            } elseif ($myCollection->belongsToGroup()) {
                                $routePrefix = 'my-group.my-collections.items';
                            }
                        @endphp

                        <li class="dokan-single-seller woocommerce coloum-3">
                            <a href="{{ route($routePrefix . '.show', [
                                $myCollection->belongsToProfile() ? 'my_profile' : 'my_group' => $ownerId,
                                'my_collection' => $myCollection->id,
                                'item' => $item->id
                            ]) }}">
                                <div class="store-wrapper">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @if ($item->isExhibit())
                                                @include('components.media.exhibit', ['exhibit' => $item->model])
                                            @elseif ($item->isArtwork())
                                                @include('components.media.artwork', ['artwork' => $item->model])
                                            @elseif ($item->isCollection())
                                                @include('components.media.collection', ['collection' => $item->model])
                                            @elseif ($item->isCollectionItem())
                                                @include('components.media.collection_item', ['collectionItem' => $item->model])
                                            @elseif ($item->isWebsiteGroup())
                                                @include('components.media.website-group', ['websiteGroup' => $item->model])
                                            @elseif ($item->isWebsite())
                                                @include('components.media.website', ['website' => $item->model])
                                            @elseif ($item->isProfile())
                                                @include('components.media.profile', ['profile' => $item->model])
                                            @elseif ($item->isGroup())
                                                @include('components.media.group', ['group' => $item->model])
                                            @endif
                                        </div>
                                    </div>

                                    <div class="store-content">
                                        <div class="store-data-container">
                                            @if (empty($item->getDescription()))
                                                <div class="featured-favourite"></div>
                                            @endif
                                            <div class="store-data">
                                                <h2>{{ $item->getTitle() }}</h2>
                                                <p>{{ \Illuminate\Support\Str::limit($item->getDescription(), 50) }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="store-footer">
                                        @if ($item->collection->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($item->collection->owner))
                                            <a href="#delete-row-dialog-item-{{ $item->id }}" class="button delete popup-delete-row">
                                                <i class="sl sl-icon-trash"></i>
                                            </a>
                                            <div id="delete-row-dialog-item-{{ $item->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                                <div class="small-dialog-header">
                                                    <h3>{{ __('my-collection.views.show.ul.li.button.h3.delete-item') }}</h3>
                                                </div>
                                                <div class="sign-in-form style-1">
                                                    <p>{{ __('my-collection.views.show.ul.li.button.p.sure') }}</p>
                                                    <form method="post" action="{{ route($routePrefix . '.destroy', [
                                                        $myCollection->belongsToProfile() ? 'my_profile' : 'my_group' => $ownerId,
                                                        'my_collection' => $item->collection_id,
                                                        'item' => $item->id
                                                    ]) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="button">
                                                            {{ __('my-collection.views.show.ul.li.button.form.button.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- Sortable dropdown --}}
                                            <select
                                                onchange="location = this.value;"
                                                class="select2-single"
                                                data-placeholder="All positions"
                                            >
                                                @for ($position = 1; $position <= $myCollection->items->count(); $position++)
                                                    <option
                                                        @if ($item->order_column == $position) selected @endif
                                                        value="{{ route($routePrefix . '.change-position', [
                                                            $myCollection->belongsToProfile() ? 'my_profile' : 'my_group' => $ownerId,
                                                            'my_collection' => $item->collection_id,
                                                            'item' => $item->id,
                                                            'position' => $position
                                                        ]) }}"
                                                    >Position {{ $position }}</option>
                                                @endfor
                                            </select>
                                            {{-- End Sortable dropdown --}}
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <div class="dokan-clearfix"></div>
                </ul>
            </div>
        </div>

        {{-- Section pagination items--}}
        @include('components.main-buttons', [
            'rightButtons' => [
                ( $myCollectionItemsPaginated->previousPageUrl() ? [
                    'label' => '',
                    'link' => $myCollectionItemsPaginated->previousPageUrl(),
                    'icon' => 'arrow-left',
                    'type' => 'outline'
                    ] : []
                ),
                ( $myCollectionItemsPaginated->nextPageUrl() ? [
                    'label' => '',
                    'link' => $myCollectionItemsPaginated->nextPageUrl(),
                    'icon' => 'arrow-right',
                    'type' => 'outline'
                    ] : []
                )
            ]
        ])
        {{-- End Section pagination items--}}
    @endif
@endisset
