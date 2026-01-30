@extends('layouts.group')

@section('header_styles')
    <meta property="og:title" content="{{ $collection->title }}">
    <meta property="og:url" content="{{ url()->current() }}">

    @php
        $media = $collection->getFirstMedia();
        $defaultImage = asset('img/grey.png');
        $ogImage = match (true) {
            !$collection->hasMedia() => $defaultImage,
            $media->getTypeFromExtension() === 'pdf' => asset('img/documents/pdf2.png'),
            str_contains($media->file_name, '.doc') => asset('img/documents/doc.png'),
            default => $media->getUrl(),
        };
    @endphp

    <meta property="og:image" content="{{ $ogImage }}">
@stop

@section('title')
    {{ $collection->title }}
    @parent
@endsection

@php
    $search = request()->search;
    $discover = request()->discover;

    $owner = $collection->owner;
    $ownerUrl = $owner->getRoute(['search' => $search, 'discover' => $discover]);

    $breadcrumbs = [];

    if ($search) {
        $breadcrumbs[__('research.views.index.page-title.search-result', ['search' => $search])] = route('app.research', ['search' => $search]);
    } elseif ($discover) {
        $breadcrumbs[__('components.views.banner.h4.discover')] = route('app.exhibits.show', ['exhibit' => $discover, 'discover' => $discover]);
    }

    $breadcrumbs += [
        __('profile.views.breadcrumbs.profiles'),
        $owner->getName() => $ownerUrl,
        __('my-collection.views.show.breadcrumbs.my-collections') => $owner instanceof \App\Models\Group
            ? route('app.groups.collections.index', ['group' => $owner->id, 'search' => $search])
            : route('app.profiles.collections.index', ['profile' => $owner->id, 'search' => $search]),

        $collection->title => $collection->getRoute(['search' => $search, 'discover' => $discover]),
    ];
@endphp

@section('page-title')
    <a href="{{ $owner instanceof \App\Models\Group
        ? route('app.groups.collections.index', ['group' => $owner->id, 'search' => $search])
        : route('app.profiles.collections.index', ['profile' => $owner->id, 'search' => $search]) }}">
        <i class="sl sl-icon-arrow-left"></i>
        {{ $collection->title }}
    </a>
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@stop

@section('navigation-right-side')
    <a href="{{ $ownerUrl }}">{{ $owner->getName() }}</a>
@stop

@section('content')
    @include('components.notifications')

    @include('profile.collection.items', ['collection' => $collection])

    @include('profile.collection.main-information', ['collection' => $collection])

    @include('profile.collection.comments', ['collection' => $collection])
@stop

@section('external')
    @include('profile.collection.more-information', ['collection' => $collection])
@endsection

@section('app_scripts')
@stop
