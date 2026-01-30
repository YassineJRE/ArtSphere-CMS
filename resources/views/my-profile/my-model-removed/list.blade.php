@isset($myProfile)
    {{-- Section button add models removed --}}
    @if ($myProfile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($myProfile))
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element">
                    @if ($myProfile->modelsRemovedFromDB->count() <= 0)
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-widget elementor-widget-button">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text margin-top-20">
                                                    {{ __('my-model-removed.views.index.span.add-models') }}
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
    {{-- End Section button add models removed --}}


    @if ($myProfile->modelsRemovedFromDB->count() > 0)
        @php
            $modelsRemovedFromDBPaginated = $myProfile->modelsRemovedFromDB()->paginate(6);
        @endphp
        <div id="dokan-seller-listing-wrap" class="grid-view">
            <div class="seller-listing-content">
                <ul class="dokan-seller-wrap">
                    @foreach ($modelsRemovedFromDBPaginated as $modelRemoved)
                        <li class="dokan-single-seller woocommerce coloum-3">
                            <a href="">
                                <div class="store-wrapper">
                                    <div class="store-header">
                                        <div class="store-banner">
                                            @if ($modelRemoved->isExhibit())
                                                @include('components.media.exhibit', [
                                                    'exhibit' => $modelRemoved->model
                                                ])      
                                            @elseif ($modelRemoved->isArtwork())
                                                @include('components.media.artwork', [
                                                    'artwork' => $modelRemoved->model
                                                ])                                                                                        
                                            @endif
                                        </div>
                                    </div>
                                    <div class="store-content ">
                                        <div class="store-data-container">
                                            <div class="store-data">
                                                <h2>{{ $modelRemoved->getTitle() }}</h2>
                                                <p>{{ $modelRemoved->getDescription() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store-footer">
                                        @if ($myProfile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($myProfile))
                                            <a href="#delete-row-dialog-{{ $modelRemoved->id }}" class="button delete popup-delete-row">
                                                <i class="sl sl-icon-arrow-up-circle"></i>
                                                {{ __('my-model-removed.views.index.ul.li.button.restore') }}
                                            </a>
                                            <div id="delete-row-dialog-{{ $modelRemoved->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                                <div class="small-dialog-header">
                                                    <h3>{{ __('my-model-removed.views.index.ul.li.button.h3.restore-model') }}</h3>
                                                </div>
                                                <div class="sign-in-form style-1">
                                                    <p>{{ __('my-model-removed.views.index.ul.li.button.p.sure') }}</p>
                                                    <form 
                                                        method="post"
                                                        @if ($modelRemoved->belongsToProfile())
                                                            action="{{ route('my-profile.my-model-removed.destroy',[
                                                                'my_profile' => $modelRemoved->owner_id,
                                                                'my_model_removed' => $modelRemoved->id
                                                            ]) }}"
                                                        @elseif ($modelRemoved->belongsToGroup())
                                                            action="{{ route('my-group.my-model-removed.destroy',[
                                                                'my_group' => $modelRemoved->owner_id,
                                                                'my_model_removed' => $modelRemoved->id
                                                            ]) }}"
                                                        @endif
                                                    >
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button class="button">
                                                            {{ __('my-model-removed.views.index.ul.li.button.form.button.restore') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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

        {{-- Section pagination Models removed--}}
        @include('components.main-buttons', [
            'rightButtons' => [
                ( $modelsRemovedFromDBPaginated->previousPageUrl() ? [
                    'label' => '',
                    'link' => $modelsRemovedFromDBPaginated->previousPageUrl(),
                    'icon' => 'arrow-left',
                    'type' => 'outline'
                    ] : []
                ),
                ( $modelsRemovedFromDBPaginated->nextPageUrl() ? [
                    'label' => '',
                    'link' => $modelsRemovedFromDBPaginated->nextPageUrl(),
                    'icon' => 'arrow-right',
                    'type' => 'outline'
                    ] : []
                )
            ]
        ])
        {{-- End Section pagination Models removed--}}
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