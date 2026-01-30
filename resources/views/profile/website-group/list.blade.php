@isset($websiteGroups)
    @if ($websiteGroups->filter()->count() > 0)
        @php
            $websiteGroupsPaginated = $websiteGroups->filter()->orderBy('order_column')->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($websiteGroupsPaginated as $websiteGroup)
                        <li
                            @if ($websiteGroupsPaginated->count() <= 1)
                                class="dokan-single-seller woocommerce composition-1"
                            @elseif ($websiteGroupsPaginated->count() == 2)
                                class="dokan-single-seller woocommerce composition-2"
                            @elseif ($websiteGroupsPaginated->count() == 3)
                                class="dokan-single-seller woocommerce composition-3"
                            @else
                                class="dokan-single-seller woocommerce composition-6"
                            @endif
                        >
                            <a 
                                @if ($websiteGroup->belongsToProfile())
                                    href="{{ route('app.profiles.website-groups.show',[
                                        'profile' => $websiteGroup->owner_id, 
                                        'website_group' => $websiteGroup->id, 
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}" 
                                @elseif ($websiteGroup->belongsToGroup())
                                    href="{{ route('app.groups.website-groups.show',[
                                        'group' => $websiteGroup->owner_id, 
                                        'website_group' => $websiteGroup->id,
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @endif
                            >
                                <div class="store-wrapper" data-full-title="{{ $websiteGroup->title }}">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.website-group', [
                                                'websiteGroup' => $websiteGroup
                                            ])
                                        </div>
                                    </div>
                                    <div class="store-content">
                                        <div class="store-data-container">
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2>{{ $websiteGroup->title }}</h2>
                                                <p>{{ $websiteGroup->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-footer">
                                        <h2>{{ $websiteGroup->title }}</h2>
                                        <p>{{ $websiteGroup->type }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <div class="dokan-clearfix"></div>
                </ul>
            </div>
        </div>

        {{-- Section pagination websiteGroups--}}
        @include('components.main-buttons', [
            'rightButtons' => [
                ( $websiteGroupsPaginated->previousPageUrl() ? [
                    'label' => '',
                    'link' => $websiteGroupsPaginated->previousPageUrl(),
                    'icon' => 'arrow-left',
                    'type' => 'outline'
                    ] : []
                ),
                ( $websiteGroupsPaginated->nextPageUrl() ? [
                    'label' => '',
                    'link' => $websiteGroupsPaginated->nextPageUrl(),
                    'icon' => 'arrow-right',
                    'type' => 'outline'
                    ] : []
                )
            ]
        ])
        {{-- End Section pagination websiteGroups--}}
    @endif
@endisset