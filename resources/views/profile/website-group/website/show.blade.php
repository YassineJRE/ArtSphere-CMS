@extends('layouts.profile')

@section('header_styles')
    <meta property="og:title" content="{{ $website->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($website->getFirstMedia())
        @if ($website->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <meta property="og:image" content="{{ asset('img/documents/pdf2.png') }}">
        @elseif (str_contains($website->getFirstMedia()->file_name, '.doc'))
            <meta property="og:image" content="{{ asset('img/documents/doc.png') }}">
        @else
            <meta property="og:image" content="{{ $website->getFirstMediaUrl() }}">
        @endif
    @else
        <meta property="og:image" content="{{ asset('img/grey.png') }}">
    @endif
@stop

@section('title')
    {{ $website->title }}
    @parent
@endsection

@section('page-title')
    <a 
        href="{{ route('app.profiles.website-groups.show',[
            'profile' => $profile->id,
            'website_group' => $websiteGroup->id,
            'search' => request()->search,
            'discover' => request()->discover,
        ]) }}"
    >
        <i class="sl sl-icon-arrow-left"></i>
        {{ $website->title }}
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
            __('my-website-group.views.show.breadcrumbs.my-websites') => route('app.profiles.website-groups.index',[
                'profile' => $profile->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            $websiteGroup->title => route('app.profiles.website-groups.show',[
                'profile' => $profile->id,
                'website_group' => $websiteGroup->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
            $website->title => route('app.profiles.website-groups.websites.show',[
                'profile' => $profile->id,
                'website_group' => $websiteGroup->id,
                'website' => $website->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
        ]
    ) ])  
@stop

@section('navigation-right-side')
    <a
        @if ($websiteGroup->belongsToProfile())
            href="{{ route('app.profiles.show',[
                'profile' => $websiteGroup->owner_id,
                'search' => request()->search,
                'discover' => request()->discover,
            ]) }}" 
        @elseif ($websiteGroup->belongsToGroup())
            href="{{ route('app.groups.show',[
                'group' => $websiteGroup->owner_id, 
                'search' => request()->search,
                'discover' => request()->discover,
            ]) }}"
        @endif
    >{{ $websiteGroup->owner->getName() }}</a>
@stop

@section('content')
    @include('components.notifications')

    @include('profile.website-group.website.main-information',['website' => $website])
@stop

@section('external')
    @include('profile.website-group.website.more-information', ['website' => $website])
@endsection

@section('app_scripts')

@stop
