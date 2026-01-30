@isset($document)
    @empty($document->getFirstMedia())
        <img 
            src="{{ asset('img/grey.png') }}" 
            alt="{{ $document->name }}"
            class="image1"
        />
    @else
        @if ($document->getFirstMedia()->getTypeFromExtension() == 'pdf')        
            @if (in_array(request()->route()->getName(), ['app.profiles.documents.show','app.groups.documents.show']))
                <a href="{{ $document->getFirstMedia()->getFullUrl() }}" download>
                    <img 
                        src="{{ asset('img/documents/pdf2.png') }}" 
                        alt="{{ $document->name }}"
                        class="image1"
                    />
                </a>
            @else
                <img 
                    src="{{ asset('img/documents/pdf2.png') }}" 
                    alt="{{ $document->name }}"
                    class="image1"
                />
            @endif
        @elseif (str_contains($document->getFirstMedia()->file_name, '.doc'))
            @if (in_array(request()->route()->getName(), ['app.profiles.documents.show','app.groups.documents.show']))
                <a href="{{ $document->getFirstMedia()->getFullUrl() }}" download>
                    <img 
                        src="{{ asset('img/documents/doc.png') }}"
                        alt="{{ $document->name }}"
                        class="image1"
                    />
                </a>
            @else
                <img
                    src="{{ asset('img/documents/doc.png') }}"
                    alt="{{ $document->name }}"
                    class="image1"
                />
            @endif
        @else    
            @if (in_array(request()->route()->getName(), ['app.profiles.documents.show','app.groups.documents.show']))
                <a href="{{ $document->getFirstMedia()->getFullUrl() }}" download>
                    <img 
                        src="{{ $document->getFirstMediaUrl() }}" 
                        alt="{{ $document->name }}"
                        class="image1" 
                    />
                </a>
            @else
                <img 
                    src="{{ $document->getFirstMediaUrl() }}" 
                    alt="{{ $document->name }}"
                    class="image1" 
                />
            @endif
        @endif
    @endempty
@endisset