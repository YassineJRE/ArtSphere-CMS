@isset($collection)
    @isset($displaySecondImage)
        @foreach ($collection->items()->orderBy('order_column')->take(1)->get() as $item)
            @if ($item->isExhibit())
                @include('components.media.exhibit', [
                    'exhibit' => $item->model,
                    'displaySecondImage' => true
                ])
            @elseif ($item->isArtwork())
                @include('components.media.artwork', [
                    'artwork' => $item->model,
                    'displaySecondImage' => true
                ])
            @elseif ($item->isCollection())
                @include('components.media.collection', [
                    'collection' => $item->model,
                    'displaySecondImage' => true
                ])
            @elseif ($item->isCollectionItem())
                @include('components.media.item', [
                    'item' => $item->model,
                    'displaySecondImage' => true
                ])
            @elseif ($item->isWebsiteGroup())
                @include('components.media.website-group', [
                    'websiteGroup' => $item->model,
                    'displaySecondImage' => true
                ])
            @elseif ($item->isWebsite())
                @include('components.media.website', [
                    'website' => $item->model,
                    'displaySecondImage' => true
                ])
            @endif
        @endforeach
    @else
        @foreach ($collection->items()->orderBy('order_column')->take(1)->get() as $item)
            @if ($item->isExhibit())
                @include('components.media.exhibit', [
                    'exhibit' => $item->model
                ])
            @elseif ($item->isArtwork())
                @include('components.media.artwork', [
                    'artwork' => $item->model
                ])
            @elseif ($item->isCollection())
                @include('components.media.collection', [
                    'collection' => $item->model
                ])
            @elseif ($item->isCollectionItem())
                @include('components.media.item', [
                    'item' => $item->model
                ])
            @elseif ($item->isWebsiteGroup())
                @include('components.media.website-group', [
                    'websiteGroup' => $item->model
                ])
            @elseif ($item->isWebsite())
                @include('components.media.website', [
                    'website' => $item->model
                ])
            @endif
        @endforeach
    @endisset

    @if ($collection->items()->count() > 1 && (!isset($displaySecondImage) || $displaySecondImage === false))
        <div class="overlay-indicator">
            <img src="{{ asset('img/icon-multimedia.png') }}" alt="Multiple items">
        </div>
    @endif
@endisset
