@extends('layouts.profile')

@section('header_styles')
    <meta property="og:title" content="{{ $websiteGroup->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($websiteGroup->hasMedia())
        @if ($websiteGroup->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <meta property="og:image" content="{{ asset('img/documents/pdf2.png') }}">
        @elseif (str_contains($websiteGroup->getFirstMedia()->file_name, '.doc'))
            <meta property="og:image" content="{{ asset('img/documents/doc.png') }}">
        @else
            <meta property="og:image" content="{{ $websiteGroup->getFirstMedia()->getUrl() }}">
        @endif
    @else
        <meta property="og:image" content="{{ asset('img/grey.png') }}">
    @endif
@stop

@section('title')
    {{ $websiteGroup->title }}
    @parent
@endsection

@section('page-title')
    <a 
        href="{{ route('app.profiles.website-groups.index',[
            'profile' => $profile->id,
            'search' => request()->search,
            'discover' => request()->discover,
        ]) }}"
    >
        <i class="sl sl-icon-arrow-left"></i>
        @php
            $words = explode(' ', $websiteGroup->title);
            if (count($words) > 3) {
                $truncatedName = implode(' ', array_slice($words, 0, 3)) . '...';
            } else {
                $truncatedName = $websiteGroup->title;
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

    @include('profile.website-group.websites',['websiteGroup' => $websiteGroup])

    @include('profile.website-group.main-information',['websiteGroup' => $websiteGroup])
@stop

@section('external')
    @include('profile.website-group.more-information', ['websiteGroup' => $websiteGroup])
@endsection

@section('app_scripts')

@stop
