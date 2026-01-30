@extends('layouts.profile')

@section('header_styles')
    <meta property="og:title" content="{{ $collection->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($collection->hasMedia())
        @if ($collection->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <meta property="og:image" content="{{ asset('img/documents/pdf2.png') }}">
        @elseif (str_contains($collection->getFirstMedia()->file_name, '.doc'))
            <meta property="og:image" content="{{ asset('img/documents/doc.png') }}">
        @else
            <meta property="og:image" content="{{ $collection->getFirstMedia()->getUrl() }}">
        @endif
    @else
        <meta property="og:image" content="{{ asset('img/grey.png') }}">
    @endif    
@stop

@section('title')
    {{ $collection->title }}
    @parent
@endsection

@section('page-title')
    <a 
        href="{{ route('app.profiles.collections.index',[
            'profile' => $profile->id,
            'search' => request()->search,
            'discover' => request()->discover,
        ]) }}"
    >
        <i class="sl sl-icon-arrow-left"></i>
        @php
            $words = explode(' ', $collection->title);
            if (count($words) > 3) {
                $truncatedName = implode(' ', array_slice($words, 0, 3)) . '...';
            } else {
                $truncatedName = $collection->title;
            }
        @endphp
        {{ $truncatedName }}
    </a>
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => array_merge(
        request()->search ? [ __('research.views.index.page-title.search-result', ['search' => request()->search]) =>  route('app.research',['search' => request()->search])] : (request()->discover ? [ __('components.views.banner.h4.discover') =>  route('app.exhibits.show',['exhibit' => request()->discover, 'discover' => request()->discover]) ] : []),
        [
            __('profile.views.breadcrumbs.profiles'),
            $profile->getName() => route('app.profiles.show',[
                'profile' => $profile->id, 
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            __('my-collection.views.show.breadcrumbs.my-collections') => route('app.profiles.collections.index',[
                'profile' => $profile->id, 
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            $collection->title => route('app.profiles.collections.show',[
                'profile' => $profile->id,
                'collection' => $collection->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
        ]
    ) ])
@stop

@section('navigation-right-side')
    <a
        @if ($collection->belongsToProfile())
            href="{{ route('app.profiles.show',[
                'profile' => $collection->owner_id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]) }}" 
        @elseif ($collection->belongsToGroup())
            href="{{ route('app.groups.show',[
                'group' => $collection->owner_id, 
                'search' => request()->search,
                'discover' => request()->discover,
            ]) }}"
        @endif
    >{{ $collection->owner->getName() }}</a>
@stop

@section('content')
    @include('components.notifications')

    @include('profile.collection.items',['collection' => $collection])

    @include('profile.collection.main-information',['collection' => $collection])

    @include('profile.collection.comments', ['collection' => $collection])
@stop

@section('external')
    @include('profile.collection.more-information', ['collection' => $collection])
@endsection

@section('app_scripts')

@stop