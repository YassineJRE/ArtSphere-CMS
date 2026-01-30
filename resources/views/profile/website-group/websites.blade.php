@isset($websiteGroup)
    @if ($websiteGroup->websites->count() > 0)
        @php
            $websites = $websiteGroup->websites()->orderBy('order_column')->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($websites as $website)
                        <li
                            @if ($websites->count() <= 1)
                                class="dokan-single-seller woocommerce composition-1"
                            @elseif ($websites->count() == 2)
                                class="dokan-single-seller woocommerce composition-2"
                            @elseif ($websites->count() == 3)
                                class="dokan-single-seller woocommerce composition-3"
                            @else
                                class="dokan-single-seller woocommerce composition-6"
                            @endif
                        >
                            <a 
                                @if ($websiteGroup->belongsToProfile())
                                    href="{{ route('app.profiles.website-groups.websites.show',[
                                        'profile' => $websiteGroup->owner_id,
                                        'website_group' => $websiteGroup->id, 
                                        'website' => $website->id, 
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @elseif ($websiteGroup->belongsToGroup())
                                    href="{{ route('app.groups.website-groups.websites.show',[
                                        'group' => $websiteGroup->owner_id,
                                        'website_group' => $websiteGroup->id, 
                                        'website' => $website->id, 
                                        'search' => request()->search,
                                        'discover' => request()->discover,
                                    ]) }}"
                                @endif
                            >
                                <div class="store-wrapper">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.website', [
                                                'website' => $website
                                            ])
                                        </div>
                                    </div>
                                    <div class="store-content ">
                                        <div class="store-data-container">
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2>{{ $website->name }}</h2>
                                                <p>{{ $website->description }}</p>
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

        {{-- Section pagination websites--}}
        <div class="col-md-12">
            @include('components.main-buttons', [
                'rightButtons' => [
                    ( $websites->previousPageUrl() ? [
                        'label' => '',
                        'link' => $websites->previousPageUrl(),
                        'icon' => 'arrow-left',
                        'type' => 'outline'
                        ] : []
                    ),
                    ( $websites->nextPageUrl() ? [
                        'label' => '',
                        'link' => $websites->nextPageUrl(),
                        'icon' => 'arrow-right',
                        'type' => 'outline'
                        ] : []
                    )
                ]
            ])
        </div>
        {{-- End Section pagination websites--}}
    @endif
@endisset