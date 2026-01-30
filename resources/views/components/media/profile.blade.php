@isset($profile)
    @if ($profile->hasMedia())
        @if ($profile->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <img 
                src="{{ asset('img/documents/pdf2.png') }}" 
                alt="{{ $profile->getName() }}"
                class="image1"
            >
        @elseif (str_contains($profile->getFirstMedia()->file_name, '.doc'))
            <img 
                src="{{ asset('img/documents/doc.png') }}"
                alt="{{ $profile->getName() }}"
                class="image1"
            />
        @else
            <img 
                src="{{ $profile->getFirstMedia()->getUrl() }}" 
                alt="{{ $profile->getName() }}"
                class="image1"
            >
        @endif
    @else
        <img 
            src="{{ asset('img/grey.png') }}"
            alt="{{ $profile->getName() }}"
            class="image1"
        >
    @endif
@endisset