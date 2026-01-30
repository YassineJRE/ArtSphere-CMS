@isset($document)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="col-md-12 my-profile-content add-file margin-top-20 margin-bottom-20">
                @include('components.media.document', ['document' => $document])
            </div>
            <div class="col-md-6 my-profile-content margin-bottom-20">
                {{ __('my-document.views.show.footer.name') }} <b>{{ $document->name }}</b><br>
                {{ __('my-document.views.show.footer.description') }} <b>{!! nl2br(e($document->description)) !!}</b><br>
            </div>
        </div>
    </div>
@endisset
