@isset($myWebsite)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="col-md-12 my-profile-content add-file margin-top-20 margin-bottom-20">
                @include('components.media.website', [
                    'website' => $myWebsite
                ])
            </div>
            <div class="col-md-6 my-profile-content margin-bottom-20">
                {{ __('my-website.views.show.footer.title') }} <b>{{ $myWebsite->title }}</b><br>
                {{ __('my-website.views.show.footer.type') }} <b>{{ $myWebsite->type }}</b><br>
            </div>
            <div class="col-md-6 my-profile-content margin-bottom-20">
                {{ __('my-website.views.show.footer.url') }} <b>{{ $myWebsite->url }}</b><br>
                {{ __('my-website.views.show.footer.description') }} <b>{!! nl2br($myWebsite->description) !!}</b><br>
                {{ __('my-website.views.show.footer.owner') }}
                <b>
                    <u><a href="{{ $myWebsite->owner_link }}" target="_blank">{{ $myWebsite->owner_name }}</a></u>
                </b><br>
                {{ $myWebsite->additional_information_title }} <b>{!! nl2br($myWebsite->additional_information_content) !!}</b><br>
            </div>
        </div>
    </div>
@endisset
