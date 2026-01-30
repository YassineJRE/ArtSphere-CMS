@if (isset($exhibits) && $exhibits->count() > 0)
    <section class="elementor-section elementor-element elementor-section-stretched">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget">
                                <div class="elementor-widget-container">
                                    <h3 class="headline headline-aligned-to-left headline-box">
                                        {{ __('components.views.exhibits.title') }}
                                    </h3>
                                </div>

                                <div class="elementor-widget-container">
                                    <div class="profiles-grid">
                                        @foreach ($exhibits as $exhibit)
                                            @php
                                                $exhibitUrl = $exhibit->getRoute([
                                                    'search' => request()->search,
                                                    'discover' => request()->discover,
                                                ]);
                                            @endphp

                                            <div class="fw-carousel-item">
                                                <div class="product">
                                                    <div class="mediaholder">
                                                        <a href="{{ $exhibitUrl }}">
                                                            @include('components.media.exhibit', [
                                                                'exhibit' => $exhibit,
                                                                'displaySecondImage' => true,
                                                            ])
                                                        </a>

                                                        <a href="{{ $exhibitUrl }}" class="button">
                                                            {{ __('components.views.exhibits.button.see-exhibit') }}
                                                        </a>
                                                    </div>

                                                    <section>
                                                        <h5>
                                                            <a href="{{ $exhibitUrl }}">{{ $exhibit->name }}</a>
                                                        </h5>
                                                        <span>
                                                            <bdi>
                                                                <a href="{{ $exhibitUrl }}">{{ $exhibit->owner->getName() }}</a>
                                                            </bdi>
                                                        </span>
                                                    </section>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <x-carousels.pagination :items="$exhibits" type="exhibits" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
