@isset($myArtwork)
    <div class="row">
        <div class="my-profile">
            <div class="my-profile-content add-file margin-top-20 margin-bottom-20">
                @include('components.media.artwork', [
                    'artwork' => $myArtwork,
                    'showIFrame' => true
                ])
            </div>
            <div class="col-md-6 my-profile-content margin-bottom-20">
                {{ __('my-artwork.views.show.footer.name') }} <b>{{ $myArtwork->name }}</b><br>
                {{ __('my-artwork.views.show.footer.description') }} <b>{!! nl2br($myArtwork->description) !!}</b><br>
                {{ __('my-artwork.views.show.footer.medium') }} <b>{{ $myArtwork->medium }}</b><br>
                {{ __('my-artwork.views.show.footer.grant-acknowledgement') }} <b>{{ $myArtwork->grant_acknowledgement }}</b><br>
                {{ __('my-artwork.views.show.footer.other-acknoledgements') }} <b>{{ $myArtwork->other_acknoledgements }}</b><br>
            </div>
            <div class="col-md-6 my-profile-content margin-bottom-20">
                {{ __('my-artwork.views.show.footer.location') }} <b>{{ $myArtwork->location }}</b><br>
                {{ __('my-artwork.views.show.footer.date') }} <b>{{ $myArtwork->date }}</b><br>
                {{ __('my-artwork.views.show.footer.size') }} <b>{{ $myArtwork->size_lenght }}</b>:<b>{{ $myArtwork->size_width }}</b>:<b>{{ $myArtwork->size_height }}</b><br>
                {{ __('my-artwork.views.show.footer.photographer') }}
                <b>
                    <u>
                        <a href="{{ $myArtwork->photographer_link }}">{{ $myArtwork->photographer }}<a>
                    </u>
                </b><br>

            </div>
        </div>
    </div>
@endisset
