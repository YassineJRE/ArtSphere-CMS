@isset($exhibit)
    <section class="fullwidth" data-background-color="#f9f9f9">
        <div class="container" id="more-information">
            <div class="row">
                <div class="col-md-12 my-profile">
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        <b>{{ $exhibit->owner->getName() }}</b><br>
                        @if ($exhibit->name)
                            <b>{{ __('profile.views.more-information.exhibit-name') }}</b> {{ $exhibit->name }}<br>
                        @endif
                        @if ($exhibit->description)
                            <b>{{ __('profile.views.more-information.exhibit-description') }}</b> {!! nl2br($exhibit->description) !!}<br>!! 
                        @endif                        
                    </div>
                    @if ($exhibit->artworks->count() > 0)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{{ __('profile.views.more-information.location') }}</b><br>
                            @foreach ($exhibit->artworks as $artwork)
                                @if ($artwork->location)
                                    <div class="col-md-6">
                                        <u>{{ $artwork->location }}</u>
                                    </div>
                                    <div class="col-md-6">
                                        {{ __('profile.views.more-information.date') }} {{ \Carbon\Carbon::parse($artwork->date)->format('Y') }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        @if ($exhibit->special_thanks)
                            <b>{{ __('profile.views.more-information.special-thanks-to') }}</b> {{ $exhibit->special_thanks }}<br>
                        @endif
                        @if ($exhibit->grant_acknowledgement)
                            <b>{{ __('profile.views.more-information.grant-acknowledgement') }}</b> {{ $exhibit->grant_acknowledgement }}<br>
                        @endif
                    </div>
                    @if ($exhibit->additional_information_title)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{!! nl2br($exhibit->additional_information_title) !!}</b> {!! nl2br($exhibit->additional_information_content) !!}<br> 
                        </div>                        
                    @endif
                </div>
            </div>
        </div>
    </section>
@endisset