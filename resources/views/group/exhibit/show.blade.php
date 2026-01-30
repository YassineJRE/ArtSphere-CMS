@extends('layouts.group')

@section('header_styles')
    <meta property="og:title" content="{{ $exhibit->name }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($exhibit->hasMedia())
        @if ($exhibit->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <meta property="og:image" content="{{ asset('img/documents/pdf2.png') }}">
        @elseif (str_contains($exhibit->getFirstMedia()->file_name, '.doc'))
            <meta property="og:image" content="{{ asset('img/documents/doc.png') }}">
        @else
            <meta property="og:image" content="{{ $exhibit->getFirstMedia()->getUrl() }}">
        @endif
    @elseif ($exhibit->artworks()->exists() && $exhibit->artworks()->first()->hasVideo())
        <meta property="og:image" content="{{ $exhibit->artworks()->first()->getVideoThumbnail() }}">
    @else
        <meta property="og:image" content="{{ asset('img/grey.png') }}">
    @endif
@stop

@section('title')
    {{ $exhibit->name }}
    @parent
@endsection

@section('page-title')
    <a 
        href="{{ route('app.groups.exhibits.index',[
            'group' => $group,
            'search' => request()->search,
            'discover' => request()->discover,
        ]) }}"
    >
        <i class="sl sl-icon-arrow-left"></i>
        {{ $exhibit->name }}
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
        ]
    ) ])    
@stop

@section('navigation-right-side')
    <a
        @if ($exhibit->belongsToProfile())
            href="{{ route('app.profiles.show',[
                'profile' => $exhibit->owner_id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]) }}" 
        @elseif ($exhibit->belongsToGroup())
            href="{{ route('app.groups.show',[
                'group' => $exhibit->owner_id, 
                'search' => request()->search,
                'discover' => request()->discover,
            ]) }}"
        @endif
    >{{ $exhibit->owner->getName() }}</a>
@stop

@section('content')
    @include('components.notifications')

    @include('profile.exhibit.artworks',[
        'exhibit' => $exhibit,
        'hasArtworksPagination' => true,
    ])

    @include('profile.exhibit.main-information',['exhibit' => $exhibit])

    @include('profile.exhibit.comments',['exhibit' => $exhibit])
@stop

@section('external')
    @include('profile.exhibit.more-information', ['exhibit' => $exhibit])
@endsection

@section('app_scripts')

@stop
