@isset($myProfile)
    {{-- Section button add exhibit --}}
    @if ($myProfile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($myProfile))
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element
                    @if ($myProfile->exhibits->count() > 0) elementor-align-right @endif"
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget elementor-widget-button">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a 
                                            @if ($myProfile->isProfile())
                                                href="{{ route('my-profile.my-exhibits.create',[
                                                    'my_profile' => $myProfile->id
                                                ]) }}"
                                            @elseif ($myProfile->isGroup())
                                                href="{{ route('my-group.my-exhibits.create',[
                                                    'my_group' => $myProfile->id
                                                ]) }}"
                                            @endif
                                            role="button"
                                            class="elementor-button 
                                                @if ($myProfile->exhibits->count() > 0) 
                                                    elementor-size-sm 
                                                @else 
                                                    elementor-size-xl 
                                                @endif"
                                        >
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">
                                                    <i class="sl sl-icon-plus"></i>
                                                    {{ __('my-exhibit.views.index.span.add-exhibit') }}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($myProfile->exhibits->count() <= 0)
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-widget elementor-widget-button">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text margin-top-25">
                                                    @if (
                                                        ($myProfile->isGroup() && ($myProfile->isCurator() || $myProfile->isArtistRunCenterOrganisation() ))
                                                        ||
                                                        ($myProfile->isProfile() && $myProfile->isCurator())
                                                    )
                                                        {{ __('my-exhibit.views.index.span.add-documentation-and-transfer') }}
                                                    @else
                                                        {{ __('my-exhibit.views.index.span.add-documentation') }}
                                                    @endif
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
    {{-- End Section button add exhibit --}}

    {{-- Section exhibits --}}
    @if ($myProfile->exhibits->count() > 0)
        @php
            $exhibitsPaginated = $myProfile->exhibits()->orderBy('order_column')->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($exhibitsPaginated as $exhibit)
                        <li class="dokan-single-seller woocommerce coloum-3 ">
                            <a 
                                @if ($exhibit->belongsToProfile())
                                    href="{{ route('my-profile.my-exhibits.show',[
                                        'my_profile' => $exhibit->owner_id, 
                                        'my_exhibit' => $exhibit->id
                                    ]) }}"
                                @elseif ($exhibit->belongsToGroup())
                                    href="{{ route('my-group.my-exhibits.show',[
                                        'my_group' => $exhibit->owner_id, 
                                        'my_exhibit' => $exhibit->id
                                    ]) }}"
                                @endif
                            >
                                <div class="store-wrapper">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.exhibit', [
                                                'exhibit' => $exhibit
                                            ])
                                        </div>
                                    </div>
                                    <div class="store-content ">
                                        <div class="store-data-container">
                                            @if ($exhibit->isEnabled())
                                                <span
                                                    class="dokan-store-is-open-close-status"
                                                    title="Exhibit is published"
                                                >{{ __('enums.status.enabled') }}</span>
                                            @elseif ($exhibit->isToVerifiedGalleriesOnly())
                                                <span
                                                    class="dokan-store-is-open-close-status"
                                                    title="Exhibit is published for verified Galleries"
                                                >{{ __('enums.status.to-verified-galleries-only') }}</span>
                                            @elseif ($exhibit->isDisabled())
                                                <span
                                                    class="dokan-store-is-open-close-status dokan-store-is-closed-status"
                                                    title="Exhibit is unpublished"
                                                >{{ __('enums.status.disabled') }}</span>
                                            @endif
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2>{{ $exhibit->name }}</h2>
                                                <p>{{ $exhibit->type }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-footer">
                                        @if ($exhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($exhibit->owner))
                                            @if ($exhibit->canTransfer())
                                                <a 
                                                    @if ($exhibit->belongsToProfile())
                                                        href="{{ route('my-profile.my-exhibits.transfer-to',[
                                                            'my_profile' => $exhibit->owner_id,
                                                            'my_exhibit' => $exhibit->id
                                                        ]) }}"
                                                    @elseif ($exhibit->belongsToGroup())
                                                        href="{{ route('my-group.my-exhibits.transfer-to',[
                                                            'my_group' => $exhibit->owner_id,
                                                            'my_exhibit' => $exhibit->id
                                                        ]) }}"
                                                    @endif
                                                    class="button publish"
                                                ><i class="sl sl-icon-envolope"></i> {{ __('my-exhibit.views.show.footer.button.transfer') }}</a>
                                            @endif
                                            {{-- @if ($exhibit->canChangeStatus())
                                                <a 
                                                    @if ($exhibit->belongsToProfile())
                                                        href="{{ route('my-profile.my-exhibits.toggle-enable',[
                                                            'my_profile' => $exhibit->owner_id, 
                                                            'my_exhibit' => $exhibit->id
                                                        ]) }}"
                                                    @elseif ($exhibit->belongsToGroup())
                                                        href="{{ route('my-group.my-exhibits.toggle-enable',[
                                                            'my_group' => $exhibit->owner_id, 
                                                            'my_exhibit' => $exhibit->id
                                                        ]) }}"
                                                    @endif
                                                    class="button publish"
                                                >
                                                    @if ($exhibit->isEnabled())
                                                        <i class="sl sl-icon-close"></i> {{ __('my-exhibit.views.index.ul.li.button.unpublish') }}
                                                    @else
                                                        <i class="sl sl-icon-check"></i> {{ __('my-exhibit.views.index.ul.li.button.publish') }}
                                                    @endif
                                                </a>
                                            @endif --}}

                                            <a 
                                                @if ($exhibit->belongsToProfile())
                                                    href="{{ route('my-profile.my-exhibits.edit',[
                                                        'my_profile' => $exhibit->owner_id, 
                                                        'my_exhibit' => $exhibit->id
                                                    ]) }}"
                                                @elseif ($exhibit->belongsToGroup())
                                                    href="{{ route('my-group.my-exhibits.edit',[
                                                        'my_group' => $exhibit->owner_id, 
                                                        'my_exhibit' => $exhibit->id
                                                    ]) }}"
                                                @endif
                                                class="button publish"
                                            >
                                                <i class="sl sl-icon-pencil"></i> 
                                                {{-- {{ __('my-exhibit.views.index.ul.li.edit') }} --}}
                                            </a>

                                            <a href="#delete-row-dialog-{{ $exhibit->id }}" class="button delete popup-delete-row">
                                                <i class="sl sl-icon-trash"></i>
                                                {{-- {{ __('my-exhibit.views.index.ul.li.button.delete') }} --}}
                                            </a>
                                            <div id="delete-row-dialog-{{ $exhibit->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                                <div class="small-dialog-header">
                                                    <h3>{{ __('my-exhibit.views.index.ul.li.button.h3.delete-exhibit') }}</h3>
                                                </div>
                                                <div class="sign-in-form style-1">
                                                    <p>{{ __('my-exhibit.views.index.ul.li.button.p.sure') }}</p>
                                                    <form 
                                                        method="post"
                                                        @if ($exhibit->belongsToProfile())
                                                            action="{{ route('my-profile.my-exhibits.destroy',[
                                                                'my_profile' => $exhibit->owner_id, 
                                                                'my_exhibit' => $exhibit->id
                                                            ]) }}"
                                                        @elseif ($exhibit->belongsToGroup())
                                                            action="{{ route('my-group.my-exhibits.destroy',[
                                                                'my_group' => $exhibit->owner_id, 
                                                                'my_exhibit' => $exhibit->id
                                                            ]) }}"
                                                        @endif
                                                    >
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button class="button">
                                                            {{ __('my-exhibit.views.index.ul.li.button.form.button.delete') }}
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
                                                @for ($position = 1; $position <= $myProfile->exhibits->count(); $position++)
                                                    <option
                                                        @if ($exhibit->order_column == $position) selected @endif
                                                        @if ($exhibit->belongsToProfile())
                                                            value="{{ route('my-profile.my-exhibits.change-position',[
                                                                'my_profile' => $exhibit->owner_id, 
                                                                'my_exhibit' => $exhibit->id,
                                                                'position' => $position
                                                            ]) }}"
                                                        @elseif ($exhibit->belongsToGroup())
                                                            value="{{ route('my-group.my-exhibits.change-position',[
                                                                'my_group' => $exhibit->owner_id, 
                                                                'my_exhibit' => $exhibit->id,
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

        {{-- Section pagination myExhibits--}}
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
        {{-- End Section pagination myExhibits--}}
    @endif
    {{-- End Section exhibits --}}

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