@if (isset($leftButtons) || isset($rightButtons))
    <div class="padding-bottom-5">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                @isset($leftButtons)            
                    <div class="elementor-column elementor-col-{{ isset($rightButtons) ? 50 : 100 }} elementor-element">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-widget elementor-widget-button">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            @foreach ($leftButtons as $button)
                                                @empty(!$button)
                                                    <a href="{{ $button['link'] }}"
                                                        role="button"
                                                        class="elementor-button {{ $button['type'] ?? '' }}" 
                                                    >
                                                        <span class="elementor-button-content-wrapper">
                                                            <span class="elementor-button-text">
                                                                @isset($button['icon'])
                                                                    <i class="sl sl-icon-{{ $button['icon'] }}"></i>
                                                                @endisset
                                                                {{ $button['label'] }}
                                                            </span>
                                                        </span>
                                                    </a>
                                                @endempty
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
                @isset($rightButtons)
                    <div class="elementor-column elementor-col-{{ isset($leftButtons) ? 50 : 100 }} elementor-element elementor-align-right">
                        <div class="elementor-column-wrap elementor-element-populated">
                            <div class="elementor-widget-wrap">
                                <div class="elementor-element elementor-widget elementor-widget-button">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            @foreach ($rightButtons as $button)
                                                @empty(!$button)
                                                    <a href="{{ $button['link'] }}"
                                                        role="button"
                                                        class="elementor-button {{ $button['type'] ?? '' }}" 
                                                    >
                                                        <span class="elementor-button-content-wrapper">
                                                            <span class="elementor-button-text">
                                                                @isset($button['icon'])
                                                                    <i class="sl sl-icon-{{ $button['icon'] }}"></i>
                                                                @endisset
                                                                {{ $button['label'] }}
                                                            </span>
                                                        </span>
                                                    </a>
                                                @endempty
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endif