@isset($myExhibit)
    {{-- Section add artwork --}}
    @if ($myExhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myExhibit->owner))
        @if ($myExhibit->artworks->count() <= 0)
            <div class="margin-bottom-20">
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-row">
                        <div class="elementor-column elementor-col-100 elementor-element">
                            <div class="elementor-column-wrap elementor-element-populated">
                                <div class="elementor-widget-wrap">
                                    <div class="elementor-element elementor-widget elementor-widget-button">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                <a
                                                    @if ($myExhibit->belongsToProfile())
                                                        href="{{ route('my-profile.my-exhibits.my-artworks.create',[
                                                            'my_profile' => $myExhibit->owner_id,
                                                            'my_exhibit' => $myExhibit->id
                                                        ]) }}"
                                                    @elseif ($myExhibit->belongsToGroup())
                                                        href="{{ route('my-group.my-exhibits.my-artworks.create',[
                                                            'my_group' => $myExhibit->owner_id,
                                                            'my_exhibit' => $myExhibit->id
                                                        ]) }}"
                                                    @endif
                                                    role="button"
                                                    class="elementor-button elementor-size-xl"
                                                >
                                                    <span class="elementor-button-content-wrapper">
                                                        <span class="elementor-button-text">
                                                            <i class="sl sl-icon-plus"></i>
                                                            {{ __('my-exhibit.views.show.span.add-artwork') }}
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
    {{-- End Section add artwork --}}

    {{-- Section artworks --}}
    @if ($myExhibit->artworks->count() > 0)
        @php
            $artworks = $myExhibit->artworks()->orderBy('order_column')->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($artworks as $artwork)
                        <li class="dokan-single-seller woocommerce coloum-3">
                            <a
                                @if ($myExhibit->belongsToProfile())
                                    href="{{ route('my-profile.my-exhibits.my-artworks.show',[
                                        'my_profile' => $myExhibit->owner_id,
                                        'my_exhibit' => $myExhibit->id,
                                        'my_artwork' => $artwork->id
                                    ]) }}"
                                @elseif ($myExhibit->belongsToGroup())
                                    href="{{ route('my-group.my-exhibits.my-artworks.show',[
                                        'my_group' => $myExhibit->owner_id,
                                        'my_exhibit' => $myExhibit->id,
                                        'my_artwork' => $artwork->id
                                    ]) }}"
                                @endif
                            >
                                <div class="store-wrapper">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @include('components.media.artwork', [
                                                'artwork' => $artwork
                                            ])
                                        </div>
                                    </div>
                                    <div class="store-content ">
                                        <div class="store-data-container">
                                            <div class="featured-favourite"></div>
                                            <div class="store-data">
                                                <h2>{{ $artwork->name }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-footer"> 
                                        @if ($artwork->getFirstMedia())
                                            <a href="{{ $artwork->getFirstMedia()->getFullUrl() }}"
                                                class="button download"
                                                download
                                            >
                                                <i class="fa fa-download"></i>
                                                {{-- {{ __('my-exhibit.views.show.ul.li.button.download') }} --}}
                                            </a>
                                        @endif
                                        @if ($myExhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myExhibit->owner))
                                            <a href="#delete-row-dialog-{{ $artwork->id }}" class="button delete popup-delete-row">
                                                <i class="sl sl-icon-trash"></i>
                                                {{-- {{ __('my-exhibit.views.show.ul.li.button.delete') }} --}}
                                            </a>
                                            <div id="delete-row-dialog-{{ $artwork->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                                <div class="small-dialog-header">
                                                    <h3>{{ __('my-exhibit.views.show.ul.li.button.h3.delete-artwork') }}</h3>
                                                </div>
                                                <div class="sign-in-form style-1">
                                                    <p>{{ __('my-exhibit.views.show.ul.li.button.p.sure') }}</p>
                                                    <form
                                                        method="post"
                                                        @if ($myExhibit->belongsToProfile())
                                                            action="{{ route('my-profile.my-exhibits.my-artworks.destroy',[
                                                                'my_profile' => $myExhibit->owner_id,
                                                                'my_exhibit' => $myExhibit->id,
                                                                'my_artwork' => $artwork->id
                                                            ]) }}"
                                                        @elseif ($myExhibit->belongsToGroup())
                                                            action="{{ route('my-group.my-exhibits.my-artworks.destroy',[
                                                                'my_group' => $myExhibit->owner_id,
                                                                'my_exhibit' => $myExhibit->id,
                                                                'my_artwork' => $artwork->id
                                                            ]) }}"
                                                        @endif
                                                    >
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button class="button">
                                                            {{ __('my-exhibit.views.show.ul.li.button.form.button.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- button Tranfer --}}
                                            <a href="#transfer-row-dialog-{{ $artwork->id }}" class="button delete popup-delete-row">
                                                <i class="sl sl-icon-share-alt"></i>
                                                {{ __('my-exhibit.views.show.ul.li.button.transfer') }}
                                            </a>
                                            <div id="transfer-row-dialog-{{ $artwork->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                                <div class="small-dialog-header">
                                                    <h3>{{ __('my-exhibit.views.show.ul.li.button.h3.transfer-artwork') }}</h3>
                                                </div>
                                                <div class="sign-in-form style-1">
                                                    <p>{{ __('my-exhibit.views.show.ul.li.button.p.choose-exhibit') }}</p>
                                                    <form
                                                        method="post"
                                                        @if ($myExhibit->belongsToProfile())
                                                            action="{{ route('my-profile.my-exhibits.my-artworks.post.transfer-to',[
                                                                'my_profile' => $myExhibit->owner_id,
                                                                'my_exhibit' => $myExhibit->id,
                                                                'my_artwork' => $artwork->id
                                                            ]) }}"
                                                        @elseif ($myExhibit->belongsToGroup())
                                                            action="{{ route('my-group.my-exhibits.my-artworks.post.transfer-to',[
                                                                'my_group' => $myExhibit->owner_id,
                                                                'my_exhibit' => $myExhibit->id,
                                                                'my_artwork' => $artwork->id
                                                            ]) }}"
                                                        @endif
                                                    >
                                                        <select
                                                            data-placeholder="{{ @old('exhibit_id') }}"
                                                            class="chosen-select @if ($errors->has('exhibit_id')) _invalid @endif"
                                                            name="exhibit_id"
                                                            id="exhibit_id"
                                                        >
                                                            @foreach ($exhibits as $exhibit)
                                                                <option
                                                                    value="{{ $exhibit->id }}"
                                                                    @if (@old('exhibit_id') && @old('exhibit_id') == $exhibit->id)
                                                                        selected
                                                                    @endif
                                                                >{{ $exhibit->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button class="button">
                                                            {{ __('my-exhibit.views.show.ul.li.button.form.button.transfer') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- End button Transfer --}}

                                            {{-- Sortable dropdown --}}
                                            <select
                                                onchange="location = this.value;"
                                                class="select2-single"
                                                data-placeholder="All positions"
                                            >
                                                @for ($position = 1; $position <= $myExhibit->artworks->count(); $position++)
                                                    <option
                                                        @if ($artwork->order_column == $position) selected @endif
                                                        @if ($myExhibit->belongsToProfile())
                                                            value="{{ route('my-profile.my-exhibits.my-artworks.change-position',[
                                                                'my_profile' => $myExhibit->owner_id,
                                                                'my_exhibit' => $myExhibit->id,
                                                                'my_artwork' => $artwork->id,
                                                                'position' => $position
                                                            ]) }}"
                                                        @elseif ($myExhibit->belongsToGroup())
                                                            value="{{ route('my-group.my-exhibits.my-artworks.change-position',[
                                                                'my_group' => $myExhibit->owner_id,
                                                                'my_exhibit' => $myExhibit->id,
                                                                'my_artwork' => $artwork->id,
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

        {{-- Section pagination artworks--}}
        @include('components.main-buttons', [
            'rightButtons' => [
                ( $artworks->previousPageUrl() ? [
                    'label' => '',
                    'link' => $artworks->previousPageUrl(),
                    'icon' => 'arrow-left',
                    'type' => 'outline'
                    ] : []
                ),
                ( $artworks->nextPageUrl() ? [
                    'label' => '',
                    'link' => $artworks->nextPageUrl(),
                    'icon' => 'arrow-right',
                    'type' => 'outline'
                    ] : []
                )
            ]
        ])
        {{-- End Section pagination artworks--}}
    @endif
    {{-- End Section artworks --}}

    @push('app_scripts')
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
            $(".rightButtons").click(function(event){
                 event.preventDefault();
            });
        </script>
    @endpush
@endisset
