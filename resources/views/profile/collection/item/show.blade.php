@extends('layouts.profile')

@section('header_styles')
    <meta property="og:title" content="{{ $item->getTitle() }}">
    <meta property="og:url" content="{{ url()->current() }}">
@endsection

@section('title')
    {{ $item->getTitle() }}
    @parent
@endsection

@section('page-title')
    <a
        href="{{ route('app.profiles.collections.show', [
            'profile' => $profile->id,
            'collection' => $collection->id,
            'search' => request()->search,
            'discover' => request()->discover,
        ]) }}"
    >
        <i class="sl sl-icon-arrow-left"></i>
        {{ $item->getTitle() }}
    </a>
@endsection

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => array_merge(
        request()->search
            ? [ __('research.views.index.page-title.search-result', ['search' => request()->search]) => route('app.research', ['search' => request()->search]) ]
            : (request()->discover
                ? [ __('components.views.banner.h4.discover') => route('app.exhibits.show', ['exhibit' => request()->discover, 'discover' => request()->discover]) ]
                : []
            ),
        [
            __('profile.views.breadcrumbs.profiles'),
            $profile->getName() => route('app.profiles.show', [
                'profile' => $profile->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            __('my-collection.views.show.breadcrumbs.my-collections') => route('app.profiles.collections.index', [
                'profile' => $profile->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            $collection->title => route('app.profiles.collections.show', [
                'profile' => $profile->id,
                'collection' => $collection->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            $item->getTitle()
        ]
    ) ])
@endsection

@section('navigation-right-side')
    @if ($item->isExhibit() || $item->isCollection())
        <a
            @if ($item->model->belongsToProfile())
                href="{{ route('app.profiles.show', ['profile' => $item->model->owner_id, 'search' => request()->search, 'discover' => request()->discover]) }}"
            @elseif ($item->model->belongsToGroup())
                href="{{ route('app.groups.show', ['group' => $item->model->owner_id, 'search' => request()->search, 'discover' => request()->discover]) }}"
            @endif
        >{{ $item->model->owner->getName() }}</a>
    @elseif ($item->isArtwork())
        <a
            @if ($item->model->exhibit->belongsToProfile())
                href="{{ route('app.profiles.show', ['profile' => $item->model->exhibit->owner_id, 'search' => request()->search, 'discover' => request()->discover]) }}"
            @elseif ($item->model->exhibit->belongsToGroup())
                href="{{ route('app.groups.show', ['group' => $item->model->exhibit->owner_id, 'search' => request()->search, 'discover' => request()->discover]) }}"
            @endif
        >{{ $item->model->exhibit->owner->getName() }}</a>
    @endif
@endsection

@section('content')
    @include('components.notifications')

    @if ($item->isExhibit())
        @include('profile.exhibit.artworks', ['exhibit' => $item->model, 'hasArtworksPagination' => true])
        @include('profile.exhibit.main-information', ['exhibit' => $item->model])

    @elseif ($item->isArtwork())
        @include('profile.exhibit.artworks', ['artwork' => $item->model])
        @include('profile.exhibit.artwork.main-information', ['artwork' => $item->model])

    @elseif ($item->isWebsiteGroup())
        @include('profile.website-group.websites', ['websiteGroup' => $item->model, 'hasWebsitesPagination' => true])
        @include('profile.website-group.main-information', ['websiteGroup' => $item->model])

    @elseif ($item->isWebsite())
        @include('profile.website-group.websites', ['website' => $item->model])
        @include('profile.website-group.website.main-information', ['website' => $item->model])

    @elseif ($item->isCollection())
        @include('profile.collection.items', ['collection' => $item->model, 'hasItemsPagination' => true])
        @include('profile.collection.main-information', ['collection' => $item->model])

    @elseif ($item->isCollectionItem())
        @include('profile.collection.items', ['item' => $item->model])
        @include('profile.collection.item.main-information', ['item' => $item->model])

    @elseif ($item->isProfile())
        @include('profile.documents',['documents' => $item->model->documents()])
        @include('profile.main-information',['profile' => $item->model])

    @elseif ($item->isGroup())
        @include('profile.documents',['documents' => $item->model->documents()])
        @include('group.main-information',['group' => $item->model])
    @endif

    @include('profile.collection.item.comments', ['item' => $item])
@endsection

@section('external')
    @if ($item->isExhibit())
        @include('profile.exhibit.more-information', ['exhibit' => $item->model])
    @elseif ($item->isArtwork())
        @include('profile.exhibit.artwork.more-information', ['artwork' => $item->model])
    @endif
@endsection

@section('app_scripts')
@endsection
