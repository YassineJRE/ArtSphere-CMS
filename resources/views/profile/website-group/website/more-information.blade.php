@isset($website)
    <section class="fullwidth" data-background-color="#f9f9f9">
        <div class="container" id="more-information">
            <div class="row">
                <div class="col-md-12 my-profile">
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        @if ($website->type)
                            <b>{{ __('profile.views.more-information.type') }}</b> {{ $website->type }}<br>                            
                        @endif
                        @if ($website->title)
                            <b>{{ __('profile.views.more-information.title') }}</b> {{ $website->title }}<br>                            
                        @endif
                        @if ($website->description)
                            <b>{{ __('profile.views.more-information.description') }}</b> {!! nl2br($website->description) !!}<br>
                        @endif
                    </div>
                    @if ($website->owner_name)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{{ __('profile.views.more-information.owner') }}</b>
                            <a href="{{ $website->owner_link }}" target="_blank">
                                <u>{{ $website->owner_name }}</u>
                            </a>
                        </div>
                    @endif
                    @if ($website->additional_information_title)
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        <b>{!! nl2br($website->additional_information_title) !!}</b> {!! nl2br($website->additional_information_content) !!}<br> 
                    </div>                        
                @endif
                </div>
            </div>
        </div>
    </section>
@endisset