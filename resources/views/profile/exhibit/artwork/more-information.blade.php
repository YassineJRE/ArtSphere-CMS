@isset($artwork)
    <section class="fullwidth" data-background-color="#f9f9f9">
        <div class="container" id="more-information">
            <div class="row">
                <div class="col-md-12 my-profile">
                    @if ($artwork->exhibit->name)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{{ $artwork->exhibit->owner->getName() }} - {{ $artwork->exhibit->name }}</b><br>
                        </div>                        
                    @endif
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        @if ($artwork->name)
                            <b>{{ __('profile.views.more-information.artwork-name') }}</b> {{ $artwork->name }}<br>                            
                        @endif
                        @if ($artwork->description)
                            <b>{{ __('profile.views.more-information.description') }}</b> {!! nl2br($artwork->description) !!}<br>
                        @endif
                    </div>
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        @if ($artwork->date)
                            <b>{{ __('profile.views.more-information.date') }}</b> {{ $artwork->date }}<br>                            
                        @endif
                        @if ($artwork->photographer)
                            <b>{{ __('profile.views.more-information.photographer') }}</b> <u><a href="{{ $artwork->photographer_link }}" target="_blank">{{ $artwork->photographer }}</a></u><br>                            
                        @endif
                        @if ($artwork->medium)
                            <b>{{ __('profile.views.more-information.medium') }}</b> {{ $artwork->medium }}<br>                            
                        @endif
                        @if ($artwork->hasSize())
                            <b>{{ __('profile.views.more-information.size') }}</b> {{ $artwork->size_lenght ?? '_' }}cm x {{ $artwork->size_width ?? '_' }}cm x {{ $artwork->size_height ?? '_' }}cm<br>
                        @endif
                        @if ($artwork->location)
                            <b>{{ __('profile.views.more-information.location') }}</b> {{ $artwork->location }}<br>                            
                        @endif
                        @if ($artwork->exhibit->special_thanks)
                            <b>{{ __('profile.views.more-information.special-thanks') }}</b></b> {{ $artwork->exhibit->special_thanks }}<br>                            
                        @endif
                        @if ($artwork->additional_information_title)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{!! nl2br($artwork->additional_information_title) !!}</b> {!! nl2br($artwork->additional_information_content) !!}<br> 
                        </div>                        
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endisset