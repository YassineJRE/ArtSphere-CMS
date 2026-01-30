@isset($exhibit)
    <div class="col-md-12 padding-bottom-5">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-50 elementor-element">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget elementor-widget-button">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <h3>{{ $exhibit->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-column elementor-col-50 elementor-element elementor-align-right">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element elementor-widget elementor-widget-button">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <h3>
                                            <a
                                                style="text-decoration: underline;"
                                                @if ($exhibit->belongsToProfile())
                                                    href="{{ route('app.profiles.show',[
                                                        'profile' => $exhibit->owner_id,
                                                        'search' => request()->search,
                                                        'discover' => request()->discover,
                                                    ]) }}" 
                                                @elseif ($exhibit->belongsToGroup())
                                                    href="{{ route('app.groups.show',[
                                                        'group' => $exhibit->owner_id, 
                                                        'search' => request()->search,
                                                        'discover' => request()->discover,
                                                    ]) }}"
                                                @endif
                                            >{{ $exhibit->owner->getName() }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset