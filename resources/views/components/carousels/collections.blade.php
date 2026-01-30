@if (isset($collections) && $collections->count() > 0)
    <section class="elementor-section elementor-element elementor-section-stretched">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget">
                                <div class="elementor-widget-container">
                                    <h3 class="headline headline-aligned-to-left headline-box">
                                        {{ __('components.views.collections.title') }}
                                    </h3>
                                </div>
                                <div class="elementor-widget-container">

                                    <div class="profiles-grid">
                                        @foreach ($collections as $collection)
                                            @php
                                                $collectionUrl = $collection->getRoute([
                                                    'search' => request()->search,
                                                    'discover' => request()->discover,
                                                ]);
                                            @endphp

                                            <div class="fw-carousel-item">
                                                <div class="product">
                                                    <div class="mediaholder">
                                                        <a href="{{ $collectionUrl }}">
                                                            @include('components.media.collection', [
                                                                'collection' => $collection,
                                                                'displaySecondImage' => true,
                                                            ])
                                                        </a>
                                                        <a href="{{ $collectionUrl }}" class="button">
                                                            {{ __('components.views.collections.button.see-collection') }}
                                                        </a>
                                                    </div>
                                                    <section>
                                                        <h5>
                                                            <a href="{{ $collectionUrl }}">{{ $collection->getTitle() }}</a>
                                                        </h5>
                                                        <span>
                                                            <bdi>
                                                                <a href="{{ $collectionUrl }}">{{ $collection->owner->getName() }}</a>
                                                            </bdi>
                                                        </span>
                                                    </section>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <x-carousels.pagination :items="$collections" type="collections" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
