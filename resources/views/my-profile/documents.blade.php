@isset($profile)
    {{-- Section button add document --}}
    @if ($profile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($profile))
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element
                    @if ($profile->documents->count() > 0) elementor-align-right @endif"
                >
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget elementor-widget-button">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a
                                            @if ($profile->isProfile())
                                                href="{{ route('my-profile.my-documents.create',[
                                                    'my_profile' => $profile->id
                                                ]) }}"
                                            @elseif ($profile->isGroup())
                                                href="{{ route('my-group.my-documents.create',[
                                                    'my_group' => $profile->id
                                                ]) }}"
                                            @endif
                                            role="button"
                                            class="elementor-button
                                                @if ($profile->documents->count() > 0)
                                                    elementor-size-sm
                                                @else
                                                    elementor-size-xl
                                                @endif"
                                        >
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">
                                                    <i class="sl sl-icon-plus"></i>
                                                    {{ __('my-profile.views.show.span.add-document') }}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($profile->documents->count() <= 0)
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-widget elementor-widget-button">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text margin-top-25">
                                                    <span>{{ __('my-profile.views.show.span.add-cv') }}</span><br>
                                                    <span><i>{{ __('my-profile.views.show.span.first-image') }}</i></span>
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
    {{-- End Section button add document --}}

    {{-- Section documents --}}
    <div id="dokan-seller-listing-wrap" class="grid-view">
        <div class="seller-listing-content">
            <ul class="dokan-seller-wrap">
                @foreach ($profile->documents()->orderBy('order_column')->get() as $myDocument)
                    <li class="dokan-single-seller woocommerce coloum-3">
                        <a
                            @if ($profile->isProfile())
                                href="{{ route('my-profile.my-documents.show',[
                                    'my_profile' => $profile->id,
                                    'my_document' => $myDocument->id
                                ]) }}"
                            @elseif ($profile->isGroup())
                                href="{{ route('my-group.my-documents.show',[
                                    'my_group' => $profile->id,
                                    'my_document' => $myDocument->id
                                ]) }}"
                            @endif
                        >
                            <div class="store-wrapper">
                                <div class="store-header">
                                    <div class="store-banner">
                                        @include('components.media.document', [
                                            'document' => $myDocument
                                        ])
                                    </div>
                                </div>
                                <div class="store-content ">
                                    <div class="store-data-container">
                                        @if ($myDocument->isEnabled())
                                            <span
                                                class="dokan-store-is-open-close-status"
                                                title="Document is published"
                                            >{{ __('my-profile.views.show.ul.li.span.published') }}</span>
                                        @else
                                            <span
                                                class="dokan-store-is-open-close-status dokan-store-is-closed-status"
                                                title="Document is unpublished"
                                            >{{ __('my-profile.views.show.ul.li.span.unpublished') }}</span>
                                        @endif
                                        <div class="featured-favourite"></div>
                                        <div class="store-data">
                                            <h2>{{ $myDocument->name }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="store-footer">
                                    @if ($myDocument->getFirstMedia())
                                        <a href="{{ $myDocument->getFirstMedia()->getFullUrl() }}"
                                            class="button download"
                                            download
                                        >
                                            <i class="fa fa-download"></i>
                                            {{-- {{ __('my-profile.views.show.ul.li.download') }} --}}
                                        </a>
                                    @endif
                                    @if ($profile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($profile))
                                        <a
                                            @if ($profile->isProfile())
                                                href="{{ route('my-profile.my-documents.toggle-enable',[
                                                    'my_profile' => $profile->id,
                                                    'my_document' => $myDocument->id
                                                ]) }}"
                                            @elseif ($profile->isGroup())
                                                href="{{ route('my-group.my-documents.toggle-enable',[
                                                    'my_group' => $profile->id,
                                                    'my_document' => $myDocument->id
                                                ]) }}"
                                            @endif
                                            class="button publish"
                                        >
                                            @if ($myDocument->isEnabled())
                                                <i class="sl sl-icon-close"></i> {{ __('my-profile.views.show.ul.li.button.unpublish') }}
                                            @else
                                                <i class="sl sl-icon-check"></i> {{ __('my-profile.views.show.ul.li.button.publish') }}
                                            @endif
                                        </a>

                                        <a href="#delete-row-dialog-{{ $myDocument->id }}" class="button delete popup-delete-row">
                                            <i class="sl sl-icon-trash"></i>
                                            {{-- {{ __('my-profile.views.show.ul.li.button.delete') }} --}}
                                        </a>
                                        <div id="delete-row-dialog-{{ $myDocument->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                            <div class="small-dialog-header">
                                                <h3>{{ __('my-profile.views.show.ul.li.button.h3.delete-document') }}</h3>
                                            </div>
                                            <div class="sign-in-form style-1">
                                                <p>{{ __('my-profile.views.show.ul.li.button.p.sure') }}</p>
                                                <form
                                                    method="post"
                                                    @if ($profile->isProfile())
                                                        action="{{ route('my-profile.my-documents.destroy',[
                                                            'my_profile' => $profile->id,
                                                            'my_document' => $myDocument->id
                                                        ]) }}"
                                                    @elseif ($profile->isGroup())
                                                        action="{{ route('my-group.my-documents.destroy',[
                                                            'my_group' => $profile->id,
                                                            'my_document' => $myDocument->id
                                                        ]) }}"
                                                    @endif
                                                >
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button class="button">
                                                        {{ __('my-profile.views.show.ul.li.button.form.button.delete') }}
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
                                            @for ($position = 1; $position <= $profile->documents->count(); $position++)
                                                <option
                                                    @if ($myDocument->order_column == $position) selected @endif
                                                    @if ($profile->isProfile())
                                                        value="{{ route('my-profile.my-documents.change-position',[
                                                            'my_profile' => $profile->id,
                                                            'my_document' => $myDocument->id,
                                                            'position' => $position
                                                        ]) }}"
                                                    @elseif ($profile->isGroup())
                                                        value="{{ route('my-group.my-documents.change-position',[
                                                            'my_group' => $profile->id,
                                                            'my_document' => $myDocument->id,
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
    {{-- End Section documents --}}

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
