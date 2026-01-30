@if (isset($websites) && $websites->count() > 0)
    <section class="elementor-section elementor-element elementor-section-stretched">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget">
                                <div class="elementor-widget-container">
                                    <h3 class="headline headline-aligned-to-left headline-box">
                                        {{ __('components.views.websites.title') }}
                                    </h3>
                                </div>
                                <div class="elementor-widget-container">
                                    <div class="profiles-grid">
                                        @foreach ($websites as $item)
                                            @php
                                                $url = $item->getRoute([
                                                    'search' => request()->search,
                                                    'discover' => request()->discover,
                                                ]);
                                                $isWebsiteGroup = $item instanceof \App\Models\WebsiteGroup;
                                            @endphp

                                            <div class="fw-carousel-item">
                                                <div class="product {{ $isWebsiteGroup ? '' : 'first' }}">
                                                    <div class="mediaholder">
                                                        <a href="{{ $url }}">
                                                            @if ($isWebsiteGroup)
                                                                @include('components.media.website-group', [
                                                                    'websiteGroup' => $item,
                                                                    'displaySecondImage' => true,
                                                                ])
                                                            @else
                                                                @include('components.media.website', [
                                                                    'website' => $item,
                                                                    'thumbnail' => true,
                                                                ])
                                                            @endif
                                                        </a>
                                                        <a href="{{ $url }}" class="button">
                                                            {{ __('components.views.websites.button.see-website') }}
                                                        </a>
                                                    </div>
                                                    <section>
                                                        <h5>
                                                            <a href="{{ $url }}">{{ $item->getTitle() }}</a>
                                                        </h5>
                                                        <span>
                                                            <bdi>
                                                                <a href="{{ $url }}">{{ $item->getType() }}</a>
                                                            </bdi>
                                                        </span>
                                                    </section>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <x-carousels.pagination :items="$websites" type="websites" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
