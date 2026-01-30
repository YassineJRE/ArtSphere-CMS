@if (isset($profiles) && $profiles->count() > 0)
    <section class="elementor-section elementor-element elementor-section-stretched">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget">
                                <div class="elementor-widget-container">
                                    <h3 class="headline headline-aligned-to-left headline-box">
                                        {{ __('components.views.profiles.title') }}
                                    </h3>
                                </div>

                                <div class="elementor-widget-container">
                                    <div class="profiles-grid">
                                        @foreach ($profiles as $item)
                                            @php
                                                $profileUrl = $item->getRoute([
                                                    'search' => request()->search,
                                                    'discover' => request()->discover,
                                                ]);
                                                $isGroup = $item instanceof \App\Models\Group;
                                            @endphp

                                            <div class="fw-carousel-item">
                                                <div class="product {{ $isGroup ? '' : 'first' }}">
                                                    <div class="mediaholder">
                                                        <a href="{{ $profileUrl }}">
                                                            @if ($isGroup)
                                                                @include('components.media.group', [
                                                                    'group' => $item,
                                                                    'displaySecondImage' => true,
                                                                ])
                                                            @else
                                                                @include('components.media.profile', [
                                                                    'profile' => $item
                                                                ])
                                                            @endif
                                                        </a>
                                                        <a href="{{ $profileUrl }}" class="button">
                                                            {{ __('components.views.profiles.button.see-profile') }}
                                                        </a>
                                                    </div>

                                                    <section>
                                                        <h5>
                                                            <a href="{{ $profileUrl }}">{{ $item->getName() }}</a>
                                                        </h5>
                                                        <span>
                                                            <bdi>
                                                                <a href="{{ $profileUrl }}">
                                                                    {{ $isGroup ? $item->country : $item->user->country }}
                                                                </a>
                                                            </bdi>
                                                        </span>
                                                    </section>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <x-carousels.pagination :items="$profiles" type="profiles" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
