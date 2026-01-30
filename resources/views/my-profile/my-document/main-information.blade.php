@isset($myDocument)
    <div class="row">
        <div class="my-profile">
            <div class="my-profile-content add-file margin-top-20 margin-bottom-20">
                @include('components.media.document', [
                    'document' => $myDocument
                ])
            </div>
            <div class="col-md-6 my-profile-content margin-bottom-20">
                {{ __('my-document.views.show.footer.name') }} <b>{{ $myDocument->name }}</b><br>
                {{ __('my-document.views.show.footer.description') }} <b>{!! nl2br($myDocument->description) !!}</b><br>
                {{ __('my-document.views.show.footer.status') }} <b>@if ($myDocument->isEnabled()) {{ __('my-document.views.show.footer.published') }} @else {{ __('my-document.views.show.footer.unpublished') }} @endif</b><br>
            </div>
        </div>
    </div>
@endisset