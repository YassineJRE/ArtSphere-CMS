@if (isset($artworks) && $artworks->count() > 0)
    <section class="elementor-section elementor-element elementor-section-stretched">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget">
                                <div class="elementor-widget-container">
                                    <h3 class="headline headline-aligned-to-left headline-box">
                                        {{ __('components.views.artworks.title') }}
                                    </h3>
                                </div>
                                <div class="elementor-widget-container">

                                    <div class="profiles-grid">
                                        @foreach ($artworks as $artwork)
                                            @php
                                                $artworkUrl = $artwork->getRoute([
                                                    'search' => request()->search,
                                                    'discover' => request()->discover,
                                                ]);
                                            @endphp

                                            <div class="fw-carousel-item">
                                                <div class="product">
                                                    <div class="mediaholder">
                                                        <a href="{{ $artworkUrl }}">
                                                            @include('components.media.artwork', ['artwork' => $artwork])
                                                        </a>
                                                        <a href="{{ $artworkUrl }}" class="button">
                                                            {{ __('components.views.artworks.button.see-artwork') }}
                                                        </a>
                                                    </div>
                                                    <section>
                                                        <h5>
                                                            <a href="{{ $artworkUrl }}">{{ $artwork->name }}</a>
                                                        </h5>
                                                        <span>
                                                            <bdi>
                                                                <a href="{{ $artworkUrl }}">{{ $artwork->location }}</a>
                                                            </bdi>
                                                        </span>
                                                    </section>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <x-carousels.pagination :items="$artworks" type="artworks" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
