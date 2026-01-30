@if (!empty($breadcrumbs))
<nav id="breadcrumbs">
    <ul class="breadcrumbs-list">
        @foreach ($breadcrumbs as $label => $link)
            @if (is_int($label) && ! is_int($link))
                <li class="post post-page current-item breadcrumb-item">
                    <span property="itemListElement" typeof="ListItem">
                        <span property="name" class="breadcrumb-text">{{ $link }}</span>
                        <meta property="url" content="{{ url()->current() }}">
                        <meta property="position" content="{{ $loop->index + 1 }}">
                    </span>
                </li>
            @else
                <li class="home breadcrumb-item">
                    <span property="itemListElement" typeof="ListItem">
                        <a 
                            property="item" 
                            typeof="WebPage" 
                            title="Go to {{ $label }}." 
                            href="{{ $link }}" 
                            class="home breadcrumb-link"
                        >
                            <span property="name">{{ $label }}</span>
                        </a>
                        <meta property="position" content="{{ $loop->index + 1 }}">
                    </span>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
@endif
