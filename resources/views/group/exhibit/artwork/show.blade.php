@extends('layouts.group')

@section('header_styles')
    <meta property="og:title" content="{{ $artwork->name }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @empty($artwork->getFirstMedia())
        @if ($artwork->hasVideo())
            <meta property="og:image" content="{{ $artwork->getVideoThumbnail() }}">
        @else
            <meta property="og:image" content="{{ asset('img/grey.png') }}">
        @endif
    @else
        @if ($artwork->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <meta property="og:image" content="{{ asset('img/documents/pdf2.png') }}">
        @elseif (str_contains($artwork->getFirstMedia()->file_name, '.doc'))
            <meta property="og:image" content="{{ asset('img/documents/doc.png') }}">
        @else
            <meta property="og:image" content="{{ $artwork->getFirstMediaUrl() }}">
        @endif
    @endempty
@stop

@section('title')
    {{ $artwork->name }}
    @parent
@endsection

@section('page-title')
    <a 
        href="{{ route('app.groups.exhibits.show',[
            'group' => $group->id,
            'exhibit' => $exhibit->id,
            'search' => request()->search,
            'discover' => request()->discover,
        ]) }}"
    >
        <i class="sl sl-icon-arrow-left"></i>
        {{ $artwork->name }}
    </a>
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => array_merge(
        request()->search ? [ __('research.views.index.page-title.search-result', ['search' => request()->search]) =>  route('app.research',['search' => request()->search])] : (request()->discover ? [ __('components.views.banner.h4.discover') =>  route('app.exhibits.show',['exhibit' => request()->discover, 'discover' => request()->discover]) ] : []),
        [
            __('profile.views.breadcrumbs.profiles'),
            $group->getName() => route('app.groups.show',[
                'group' => $group->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            'Exhibits' => route('app.groups.exhibits.index',[
                'group' => $group->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            $exhibit->name => route('app.groups.exhibits.show',[
                'group' => $group->id,
                'exhibit' => $exhibit->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            ' '.$artwork->name => route('app.groups.exhibits.artworks.show',[
                'group' => $group->id,
                'exhibit' => $exhibit->id,
                'artwork' => $artwork->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ])
        ]
    ) ])        
@stop

@section('navigation-right-side')
    <a
        @if ($artwork->exhibit->belongsToProfile())
            href="{{ route('app.profiles.show',[
                'profile' => $artwork->exhibit->owner_id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]) }}" 
        @elseif ($artwork->exhibit->belongsToGroup())
            href="{{ route('app.groups.show',[
                'group' => $artwork->exhibit->owner_id, 
                'search' => request()->search,
                'discover' => request()->discover,
            ]) }}"
        @endif
    >{{ $artwork->exhibit->owner->getName() }}</a>
@stop

@section('content')
    @include('profile.exhibit.artwork.main-information',['artwork' => $artwork])

    @auth
        @include('profile.exhibit.artwork.comments', ['artwork' => $artwork])
    @endauth
@stop

@section('external')
    @include('profile.exhibit.artwork.more-information', ['artwork' => $artwork])
@endsection

@section('app_scripts')

@stop
