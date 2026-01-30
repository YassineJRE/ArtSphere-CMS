@isset($website)
    @if ($website->getFirstMedia())
        @if ($website->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <img 
                src="{{ asset('img/documents/pdf2.png') }}" 
                alt="{{ $website->title }}"
                class="image1"
            />
        @elseif (str_contains($website->getFirstMedia()->file_name, '.doc'))
            <img 
                src="{{ asset('img/documents/doc.png') }}"
                alt="{{ $website->title }}"
                class="image1"
            />
        @else
            <img src="{{ $website->getFirstMediaUrl() }}" alt="{{ $website->title }}">
        @endif
    @elseif ($website->url)
        @isset($thumbnail)
            <div class="image1 website_preview">
                <iframe src="{{ $website->url }}"></iframe>
            </div>
        @else
            <div class="video-preview website_preview">
                <iframe src="{{ $website->url }}"></iframe>
            </div>
        @endisset        
    @else
        <img 
            src="{{ asset('img/grey.png') }}" 
            alt="{{ $website->title }}"
            class="image1"
        />
    @endif
@endisset

@push('scripts')
<script type="text/javascript">
    $(document).ready(function (e) {
        if ($('.website_preview').length > 0) {
            $('.website_preview').show();
        }
    });
</script>
@endpush