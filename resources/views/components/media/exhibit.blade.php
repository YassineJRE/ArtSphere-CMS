@isset($exhibit)
    @isset($displaySecondImage)
        @if ($exhibit->hasMedia())
            @if ($exhibit->hasSecondMedia())
                @if ($exhibit->getSecondMedia()->getTypeFromExtension() == 'pdf')
                    <img
                        src="{{ asset('img/documents/pdf2.png') }}"
                        alt="{{ $exhibit->name }}"
                        class="image1"
                    >
                @elseif (str_contains($exhibit->getSecondMedia()->file_name, '.doc'))
                    <img
                        src="{{ asset('img/documents/doc.png') }}"
                        alt="{{ $exhibit->name }}"
                        class="image1"
                    />
                @else
                    <img
                        src="{{ $exhibit->getSecondMedia()->getUrl() }}"
                        alt="{{ $exhibit->name }}"
                        class="image1"
                    >
                @endif
            @else
                <img
                    src="{{ asset('img/grey.png') }}"
                    class="image1"
                    alt="{{ $exhibit->name }}"
                />
            @endif

            @if ($exhibit->getFirstMedia()->getTypeFromExtension() == 'pdf')
                <img
                    src="{{ asset('img/documents/pdf2.png') }}"
                    alt="{{ $exhibit->name }}"
                    class="image2"
                >
            @elseif (str_contains($exhibit->getFirstMedia()->file_name, '.doc'))
                <img
                    src="{{ asset('img/documents/doc.png') }}"
                    alt="{{ $exhibit->name }}"
                    class="image2"
                />
            @else
                <img
                    src="{{ $exhibit->getFirstMedia()->getUrl() }}"
                    alt="{{ $exhibit->name }}"
                    class="image2"
                >
            @endif
        @elseif ($exhibit->artworks()->exists() && $exhibit->artworks()->first()->hasVideo())
            @if ($exhibit->artworks()->skip(1)->first() && $exhibit->artworks()->skip(1)->first()->hasVideo())
                <img
                    src="{{ $exhibit->artworks()->skip(1)->first()->getVideoThumbnail() }}"
                    class="image1"
                    alt="{{ $exhibit->name }}"
                />
            @else
                <img
                    src="{{ asset('img/grey.png') }}"
                    alt="{{ $exhibit->name }}"
                    class="image1"
                />
            @endif
            <img
                src="{{ $exhibit->artworks()->first()->getVideoThumbnail() }}"
                class="image2"
                alt="{{ $exhibit->name }}"
            />
        @else
            <img
                src="{{ asset('img/grey.png') }}"
                alt="{{ $exhibit->name }}"
                class="image1"
            >
            <img
                src="{{ asset('img/grey.png') }}"
                class="image2"
                alt="{{ $exhibit->name }}"
            />
        @endif
    @else
        @if ($exhibit->hasMedia())
            @if ($exhibit->getFirstMedia()->getTypeFromExtension() == 'pdf')
                <img
                    src="{{ asset('img/documents/pdf2.png') }}"
                    alt="{{ $exhibit->name }}"
                    class="image1"
                >
            @elseif (str_contains($exhibit->getFirstMedia()->file_name, '.doc'))
                <img
                    src="{{ asset('img/documents/doc.png') }}"
                    alt="{{ $exhibit->name }}"
                    class="image1"
                />
            @else
                <img
                    src="{{ $exhibit->getFirstMedia()->getUrl() }}"
                    alt="{{ $exhibit->name }}"
                    class="image1"
                >
            @endif
        @elseif ($exhibit->artworks()->exists() && $exhibit->artworks()->first()->hasVideo())
            <img
                src="{{ $exhibit->artworks()->first()->getVideoThumbnail() }}"
                alt="{{ $exhibit->name }}"
                class="image1"
            />
        @else
            <img
                src="{{ asset('img/grey.png') }}"
                alt="{{ $exhibit->name }}"
                class="image1"
            >
        @endif
    @endisset

    @if ($exhibit->artworks()->count() > 1 && (!isset($displaySecondImage) || $displaySecondImage === false))
        <div class="overlay-indicator">
            <img src="{{ asset('img/icon-multimedia.png') }}" alt="Multiple artworks">
        </div>
    @endif
@endisset

