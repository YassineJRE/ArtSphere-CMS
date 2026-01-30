@isset($myProfile)
    {{-- Section add collection button --}}
    @if ($myProfile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($myProfile))
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element
                    @if ($myProfile->collections->count() > 0) elementor-align-right @endif"
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element  elementor-widget elementor-widget-button">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a
                                            @if ($myProfile->isProfile())
                                                href="{{ route('my-profile.my-collections.create',[
                                                    'my_profile' => $myProfile->id
                                                ]) }}"
                                            @elseif ($myProfile->isGroup())
                                                href="{{ route('my-group.my-collections.create',[
                                                    'my_group' => $myProfile->id
                                                ]) }}"
                                            @endif
                                            role="button"
                                            class="elementor-button
                                                @if ($myProfile->collections->count() > 0)
                                                    elementor-size-sm
                                                @else
                                                    elementor-size-xl
                                                @endif"
                                        >
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">
                                                    <i class="sl sl-icon-plus"></i>
                                                    {{ __('my-collection.views.index.span.add-collection') }}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($myProfile->collections->count() <= 0)
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-widget elementor-widget-button">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text margin-top-20">
                                                    {{ __('my-collection.views.index.span.add-folder') }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    {{-- End Section add collection button --}}

    {{-- Section collections --}}
    @if ($myProfile->collections->count() > 0)
        @php
            $myCollectionsPaginated = $myProfile->collections()->orderBy('order_column')->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($myCollectionsPaginated as $collection)
                        <li class="dokan-single-seller woocommerce coloum-3 ">
                            <a
                                @if ($collection->belongsToProfile())
                                    href="{{ route('my-profile.my-collections.show',[
                                        'my_profile' => $collection->owner_id,
                                        'my_collection' => $collection->id
                                    ]) }}"
                                @elseif ($collection->belongsToGroup())
                                    href="{{ route('my-group.my-collections.show',[
                                        'my_group' => $collection->owner_id,
                                        'my_collection' => $collection->id
                                    ]) }}"
                                @endif
                            >
                                <div class="store-wrapper">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.collection', [
                                                'collection' => $collection
                                            ])
                                        </div>
                                    </div>
                                    <div class="store-content ">
                                        <div class="store-data-container">
                                            @if ($collection->isEnabled())
                                                <span
                                                    class="dokan-store-is-open-close-status"
                                                    title="Website is published"
                                                >{{ __('my-collection.views.index.ul.li.span.published') }}</span>
                                            @else
                                                <span
                                                    class="dokan-store-is-open-close-status dokan-store-is-closed-status"
                                                    title="Website is unpublished"
                                                >{{ __('my-collection.views.index.ul.li.span.unpublished') }}</span>
                                            @endif
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2>{{ $collection->title }}</h2>
                                                {{--   <p>{{ $collection->description }}</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-footer">
                                        @if ($myProfile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($myProfile))
                                            <a
                                                @if ($collection->belongsToProfile())
                                                    href="{{ route('my-profile.my-collections.toggle-enable',[
                                                        'my_profile' => $collection->owner_id,
                                                        'my_collection' => $collection->id
                                                    ]) }}"
                                                @elseif ($collection->belongsToGroup())
                                                    href="{{ route('my-group.my-collections.toggle-enable',[
                                                        'my_group' => $collection->owner_id,
                                                        'my_collection' => $collection->id
                                                    ]) }}"
                                                @endif
                                                class="button publish"
                                            >
                                                @if ($collection->isEnabled())
                                                    <i class="sl sl-icon-close"></i> {{ __('my-collection.views.index.ul.li.button.unpublish') }}
                                                @else
                                                    <i class="sl sl-icon-check"></i> {{ __('my-collection.views.index.ul.li.button.publish') }}
                                                @endif
                                            </a>

                                            <a href="#delete-row-dialog-{{ $collection->id }}" class="button delete popup-delete-row">
                                                <i class="sl sl-icon-trash"></i>
                                                {{-- {{ __('my-collection.views.index.ul.li.button.delete') }} --}}
                                            </a>
                                            <div id="delete-row-dialog-{{ $collection->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                                <div class="small-dialog-header">
                                                    <h3>{{ __('my-collection.views.index.ul.li.button.h3.delete-collection') }}</h3>
                                                </div>
                                                <div class="sign-in-form style-1">
                                                    <p>{{ __('my-collection.views.index.ul.li.button.p.sure') }}</p>
                                                    <form
                                                        method="post"
                                                        @if ($collection->belongsToProfile())
                                                            action="{{ route('my-profile.my-collections.destroy',[
                                                                'my_profile' => $collection->owner_id,
                                                                'my_collection' => $collection->id
                                                            ]) }}"
                                                        @elseif ($collection->belongsToGroup())
                                                            action="{{ route('my-group.my-collections.destroy',[
                                                                'my_group' => $collection->owner_id,
                                                                'my_collection' => $collection->id
                                                            ]) }}"
                                                        @endif
                                                    >
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button class="button">
                                                            {{ __('my-collection.views.index.ul.li.button.form.button.delete') }}
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
                                                @for ($position = 1; $position <= $myProfile->collections->count(); $position++)
                                                    <option
                                                        @if ($collection->order_column == $position) selected @endif
                                                        @if ($collection->belongsToProfile())
                                                            value="{{ route('my-profile.my-collections.change-position',[
                                                                'my_profile' => $collection->owner_id,
                                                                'my_collection' => $collection->id,
                                                                'position' => $position
                                                            ]) }}"
                                                        @elseif ($collection->belongsToGroup())
                                                            value="{{ route('my-group.my-collections.change-position',[
                                                                'my_group' => $collection->owner_id,
                                                                'my_collection' => $collection->id,
                                                                'position' => $position
                                                            ]) }}"
                                                        @endif
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

        {{-- Section pagination collections--}}
        @include('components.main-buttons', [
            'rightButtons' => [
                ( $myCollectionsPaginated->previousPageUrl() ? [
                    'label' => '',
                    'link' => $myCollectionsPaginated->previousPageUrl(),
                    'icon' => 'arrow-left',
                    'type' => 'outline'
                    ] : []
                ),
                ( $myCollectionsPaginated->nextPageUrl() ? [
                    'label' => '',
                    'link' => $myCollectionsPaginated->nextPageUrl(),
                    'icon' => 'arrow-right',
                    'type' => 'outline'
                    ] : []
                )
            ]
        ])
        {{-- End Section pagination collections--}}
    @endif
    {{-- End Section collections --}}

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function (e) {
                $('.popup-delete-row').magnificPopup({
                    type: 'inline',
                    fixedContentPos: false,
                    fixedBgPos: true,
                    overflowY: 'auto',
                    closeBtnInside: true,
                    preloader: false,
                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'art-mfp-zoom-in'
                });
            });
        </script>
    @endpush
@endisset
