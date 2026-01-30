@isset($artwork)
    @empty($artwork->getFirstMedia())
        @if ($artwork->hasVideo())
            @isset($showIFrame)
                <p class="iframe-container">
                    <iframe 
                        width="560" 
                        height="315" 
                        title="{{ $artwork->name }}" 
                        src="{{ $artwork->getVideoPreview() }}"
                        frameborder="0" 
                        allow="accelerometer; autoplay; encrypted-media; gyroscope;" 
                        allowfullscreen
                    ></iframe>
                </p>
            @else
                <img 
                    src="{{ $artwork->getVideoThumbnail() }}"
                    alt="{{ $artwork->name }}"
                    class="image1"
                />
            @endisset
        @else
            <img 
                src="{{ asset('img/grey.png') }}" 
                alt="{{ $artwork->name }}"
                class="image1"
            />
        @endif
    @else
        @if ($artwork->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <img 
                src="{{ asset('img/documents/pdf2.png') }}" 
                alt="{{ $artwork->name }}"
                class="image1"
            />
        @elseif (str_contains($artwork->getFirstMedia()->file_name, '.doc'))
            <img 
                src="{{ asset('img/documents/doc.png') }}"
                alt="{{ $artwork->name }}"
                class="image1"
            />  
        @else
            <img 
                src="{{ $artwork->getFirstMediaUrl() }}" 
                alt="{{ $artwork->name }}"
                class="image1" 
            />
        @endif
    @endempty
@endisset