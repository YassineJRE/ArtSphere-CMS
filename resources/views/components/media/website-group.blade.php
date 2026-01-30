@isset($websiteGroup)
    @isset($displaySecondImage)
        @if ($websiteGroup->hasMedia())
            @if ($websiteGroup->hasSecondMedia())
                @if ($websiteGroup->getSecondMedia()->getTypeFromExtension() == 'pdf')
                    <img
                        src="{{ asset('img/documents/pdf2.png') }}"
                        alt="{{ $websiteGroup->title }}"
                        class="image1"
                    >
                @elseif (str_contains($websiteGroup->getSecondMedia()->file_name, '.doc'))
                    <img
                        src="{{ asset('img/documents/doc.png') }}"
                        alt="{{ $websiteGroup->title }}"
                        class="image1"
                    />
                @else
                    <img
                        src="{{ $websiteGroup->getSecondMedia()->getUrl() }}"
                        alt="{{ $websiteGroup->title }}"
                        class="image1"
                    >
                @endif
            @else
                <img
                    src="{{ asset('img/grey.png') }}"
                    class="image1"
                    alt="{{ $websiteGroup->title }}"
                />
            @endif

            @if ($websiteGroup->getFirstMedia()->getTypeFromExtension() == 'pdf')
                <img
                    src="{{ asset('img/documents/pdf2.png') }}"
                    alt="{{ $websiteGroup->title }}"
                    class="image2"
                >
            @elseif (str_contains($websiteGroup->getFirstMedia()->file_name, '.doc'))
                <img
                    src="{{ asset('img/documents/doc.png') }}"
                    alt="{{ $websiteGroup->title }}"
                    class="image2"
                />
            @else
                <img
                    src="{{ $websiteGroup->getFirstMedia()->getUrl() }}"
                    alt="{{ $websiteGroup->title }}"
                    class="image2"
                >
            @endif
        @else
            <img
                src="{{ asset('img/grey.png') }}"
                alt="{{ $websiteGroup->title }}"
                class="image1"
            />
            <img
                src="{{ asset('img/grey.png') }}"
                class="image2"
                alt="{{ $websiteGroup->title }}"
            />
        @endif
    @else
        @if ($websiteGroup->hasMedia())
            @if ($websiteGroup->getFirstMedia()->getTypeFromExtension() == 'pdf')
                <img
                    src="{{ asset('img/documents/pdf2.png') }}"
                    alt="{{ $websiteGroup->title }}"
                    class="image1"
                >
            @elseif (str_contains($websiteGroup->getFirstMedia()->file_name, '.doc'))
                <img
                    src="{{ asset('img/documents/doc.png') }}"
                    alt="{{ $websiteGroup->title }}"
                    class="image1"
                />
            @else
                <img
                    src="{{ $websiteGroup->getFirstMedia()->getUrl() }}"
                    alt="{{ $websiteGroup->title }}"
                    class="image1"
                >
            @endif
        @else
            <img
                src="{{ asset('img/grey.png') }}"
                alt="{{ $websiteGroup->title }}"
                class="image1"
            />
        @endif
    @endisset

    @if ($websiteGroup->websites()->count() > 1 && (!isset($displaySecondImage) || $displaySecondImage === false))
        <div class="overlay-indicator">
            <img src="{{ asset('img/icon-multimedia.png') }}" alt="Multiple websites">
        </div>
    @endif
@endisset
