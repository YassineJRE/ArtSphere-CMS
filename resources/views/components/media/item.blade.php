@isset($item)
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
    @elseif ($item->isProfile())
        @include('components.media.profile', [
            'profile' => $item->model
        ])
    @elseif ($item->isGroup())
        @include('components.media.group', [
            'group' => $item->model
        ])
    @endif
@endisset
