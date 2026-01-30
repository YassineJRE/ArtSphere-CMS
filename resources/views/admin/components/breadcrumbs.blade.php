<nav id="breadcrumbs">
    <ul>
        @foreach ($breadcrumbs as $label => $link)
            <li>
                @if (is_int($label) && ! is_int($link))
                    {{ $link }}
                @else
                    <a href="{{ $link }}">{{ $label }}</a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
