@isset($websiteGroup)
    <section class="fullwidth" data-background-color="#f9f9f9">
        <div class="container" id="more-information">
            <div class="row">
                <div class="col-md-12 my-profile">
                    <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                        @if ($websiteGroup->getType())
                            <b>{{ __('profile.views.more-information.type') }}</b> {{ $websiteGroup->getType() }}<br>                            
                        @endif
                        @if ($websiteGroup->title)
                            <b>{{ __('profile.views.more-information.title') }}</b> {{ $websiteGroup->title }}<br>                            
                        @endif
                        @if ($websiteGroup->description)
                            <b>{{ __('profile.views.more-information.description') }}</b> {{ $websiteGroup->description }}<br>                            
                        @endif
                    </div>
                    @if ($websiteGroup->websites->count() > 0)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{{ __('profile.views.more-information.owners') }}</b>
                            @foreach ($websiteGroup->websites as $website)
                                @if ($website->owner_name)
                                    <a href="{{ $website->owner_link }}" target="_blank">
                                        <u>{{ $website->owner_name }}</u>
                                    </a>@if (!$loop->last), @endif                        
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if ($websiteGroup->additional_information_title)
                        <div class="col-md-12 my-profile-content margin-top-20 margin-bottom-20">
                            <b>{!! nl2br($websiteGroup->additional_information_title) !!}</b> {!! nl2br($websiteGroup->additional_information_content) !!}<br> 
                        </div>                        
                    @endif
                </div>
            </div>
        </div>
    </section>
@endisset