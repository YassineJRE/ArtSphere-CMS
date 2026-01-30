@isset($group)
    @isset($displaySecondImage)
        @if ($group->hasMedia())
            @if ($group->hasSecondMedia())
                @if ($group->getSecondMedia()->getTypeFromExtension() == 'pdf')
                    <img
                        src="{{ asset('img/documents/pdf2.png') }}"
                        alt="{{ $group->getName() }}"
                        class="image1"
                    >
                @elseif (str_contains($group->getSecondMedia()->file_name, '.doc'))
                    <img
                        src="{{ asset('img/documents/doc.png') }}"
                        alt="{{ $group->getName() }}"
                        class="image1"
                    />
                @else
                    <img
                        src="{{ $group->getSecondMedia()->getUrl() }}"
                        alt="{{ $group->getName() }}"
                        class="image1"
                    >
                @endif
            @else
                <img
                    src="{{ asset('img/grey.png') }}"
                    class="image1"
                    alt="{{ $group->getName() }}"
                />
            @endif

            @if ($group->getFirstMedia()->getTypeFromExtension() == 'pdf')
                <img
                    src="{{ asset('img/documents/pdf2.png') }}"
                    alt="{{ $group->getName() }}"
                    class="image2"
                >
            @elseif (str_contains($group->getFirstMedia()->file_name, '.doc'))
                <img
                    src="{{ asset('img/documents/doc.png') }}"
                    alt="{{ $group->getName() }}"
                    class="image2"
                />
            @else
                <img
                    src="{{ $group->getFirstMedia()->getUrl() }}"
                    alt="{{ $group->getName() }}"
                    class="image2"
                >
            @endif
        @else
            <img
                src="{{ asset('img/grey.png') }}"
                alt="{{ $group->getName() }}"
                class="image1"
            >
            <img
                src="{{ asset('img/grey.png') }}"
                class="image2"
                alt="{{ $group->getName() }}"
            />
        @endif
    @else
        @if ($group->hasMedia())
            @if ($group->getFirstMedia()->getTypeFromExtension() == 'pdf')
                <img
                    src="{{ asset('img/documents/pdf2.png') }}"
                    alt="{{ $group->getName() }}"
                    class="image1"
                >
            @elseif (str_contains($group->getFirstMedia()->file_name, '.doc'))
                <img
                    src="{{ asset('img/documents/doc.png') }}"
                    alt="{{ $group->getName() }}"
                    class="image1"
                />
            @else
                <img
                    src="{{ $group->getFirstMedia()->getUrl() }}"
                    alt="{{ $group->getName() }}"
                    class="image1"
                >
            @endif
        @else
            <img
                src="{{ asset('img/grey.png') }}"
                alt="{{ $group->getName() }}"
                class="image1"
            >
        @endif
    @endisset

    @if ($group->documents()->count() > 1 && (!isset($displaySecondImage) || $displaySecondImage === false))
        <div class="overlay-indicator">
            <img src="{{ asset('img/icon-multimedia.png') }}" alt="Multiple documents">
        </div>
    @endif
@endisset
