@isset($myWebsiteGroup)
    @if ($myWebsiteGroup->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsiteGroup->owner))
        @if ($myWebsiteGroup->websites->count() <= 0)
            <div class="col-md-12">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-row">
                        <div class="elementor-column elementor-col-100 elementor-element">
                            <div class="elementor-column-wrap elementor-element-populated">
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-widget elementor-widget-button">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                <a
                                                    @if ($myWebsiteGroup->belongsToProfile())
                                                        href="{{ route('my-profile.my-website-groups.my-websites.create',[
                                                            'my_profile' => $myWebsiteGroup->owner_id,
                                                            'my_website_group' => $myWebsiteGroup->id,
                                                        ]) }}"
                                                    @elseif ($myWebsiteGroup->belongsToGroup())
                                                        href="{{ route('my-group.my-website-groups.my-websites.create',[
                                                            'my_group' => $myWebsiteGroup->owner_id,
                                                            'my_website_group' => $myWebsiteGroup->id,
                                                        ]) }}"
                                                    @endif
                                                    role="button"
                                                    class="elementor-button elementor-size-xl"
                                                >
                                                    <span class="elementor-button-content-wrapper">
                                                        <span class="elementor-button-text">
                                                            <i class="sl sl-icon-plus"></i>
                                                            {{ __('my-website-group.views.show.span.add-website') }}
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @if ($myWebsiteGroup->websites->count() > 0)
        @php
            $websites = $myWebsiteGroup->websites()->orderBy('order_column')->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($websites as $website)
                        <li class="dokan-single-seller woocommerce coloum-3">
                            <a
                                @if ($myWebsiteGroup->belongsToProfile())
                                    href="{{ route('my-profile.my-website-groups.my-websites.show',[
                                        'my_profile' => $myWebsiteGroup->owner_id,
                                        'my_website_group' => $myWebsiteGroup->id,
                                        'my_website' => $website->id
                                    ]) }}"
                                @elseif ($myWebsiteGroup->belongsToGroup())
                                    href="{{ route('my-group.my-website-groups.my-websites.show',[
                                        'my_group' => $myWebsiteGroup->owner_id,
                                        'my_website_group' => $myWebsiteGroup->id,
                                        'my_website' => $website->id
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
                                    <div class="store-footer">
                                        @if ($website->getFirstMedia())
                                            <a href="{{ $website->getFirstMedia()->getFullUrl() }}"
                                                class="button download"
                                                download
                                            >
                                                <i class="fa fa-download"></i>
                                                {{-- {{ __('my-website-group.views.show.ul.li.button.download') }} --}}
                                            </a>
                                        @endif
                                        @if ($myWebsiteGroup->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsiteGroup->owner))
                                            <a href="#delete-row-dialog-{{ $website->id }}" class="button delete popup-delete-row">
                                                <i class="sl sl-icon-trash"></i>
                                                {{-- {{ __('my-website-group.views.show.ul.li.button.delete') }} --}}
                                            </a>
                                            <div id="delete-row-dialog-{{ $website->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                                <div class="small-dialog-header">
                                                    <h3>{{ __('my-website-group.views.show.ul.li.button.h3.delete-website') }}</h3>
                                                </div>
                                                <div class="sign-in-form style-1">
                                                    <p>{{ __('my-website-group.views.show.ul.li.button.p.sure') }}</p>
                                                    <form
                                                        method="post"
                                                        @if ($myWebsiteGroup->belongsToProfile())
                                                            action="{{ route('my-profile.my-website-groups.my-websites.destroy',[
                                                                'my_profile' => $myWebsiteGroup->owner_id,
                                                                'my_website_group' => $myWebsiteGroup->id,
                                                                'my_website' => $website->id
                                                            ]) }}"
                                                        @elseif ($myWebsiteGroup->belongsToGroup())
                                                            action="{{ route('my-group.my-website-groups.my-websites.destroy',[
                                                                'my_group' => $myWebsiteGroup->owner_id,
                                                                'my_website_group' => $myWebsiteGroup->id,
                                                                'my_website' => $website->id
                                                            ]) }}"
                                                        @endif
                                                    >
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button class="button">
                                                            {{ __('my-website-group.views.show.ul.li.button.form.button.delete') }}
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
                                                @for ($position = 1; $position <= $myWebsiteGroup->websites->count(); $position++)
                                                    <option
                                                        @if ($website->order_column == $position) selected @endif
                                                        @if ($myWebsiteGroup->belongsToProfile())
                                                            value="{{ route('my-profile.my-website-groups.my-websites.change-position',[
                                                                'my_profile' => $myWebsiteGroup->owner_id,
                                                                'my_website_group' => $myWebsiteGroup->id,
                                                                'my_website' => $website->id,
                                                                'position' => $position
                                                            ]) }}"
                                                        @elseif ($myWebsiteGroup->belongsToGroup())
                                                            value="{{ route('my-group.my-website-groups.my-websites.change-position',[
                                                                'my_group' => $myWebsiteGroup->owner_id,
                                                                'my_website_group' => $myWebsiteGroup->id,
                                                                'my_website' => $website->id,
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

        {{-- Section pagination websites--}}
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
        {{-- End Section pagination websites--}}
    @endif

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
