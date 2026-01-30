@isset($myWebsiteGroup)
    <div class="row">
        <div class="my-profile with-separator">
            <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('my-website-group.views.show.footer.type') }} <b>{{ $myWebsiteGroup->getType() }}</b><br>
                {{ __('my-website-group.views.show.footer.title') }} <b>{{ $myWebsiteGroup->title }}</b><br>
                {{ __('my-website-group.views.show.footer.description') }} <b>{!! nl2br($myWebsiteGroup->description) !!}</b><br>
            </div>
            <div class="col-md-6 my-profile-content margin-top-20 margin-bottom-20">
                {{ __('my-website-group.views.show.footer.owner') }}
                @foreach ($myWebsiteGroup->websites as $website)
                    @if ($website->owner_name)
                        <a href="{{ $website->owner_link }}" target="_blank">
                            <b><u>{{ $website->owner_name }}</u></b>
                        </a>@if (!$loop->last), @endif
                    @endif
                @endforeach
                <br>
                {{ $myWebsiteGroup->additional_information_title }} <b>{!! nl2br($myWebsiteGroup->additional_information_content) !!}</b><br>
            </div>
        </div>
    </div>
@endisset
