@extends('layouts.profile')

@section('header_styles')
    <meta property="og:title" content="{{ $profile->getName() }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($profile->hasMedia())
        @if ($profile->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <meta property="og:image" content="{{ asset('img/documents/pdf2.png') }}">
        @elseif (str_contains($profile->getFirstMedia()->file_name, '.doc'))
            <meta property="og:image" content="{{ asset('img/documents/doc.png') }}">
        @else
            <meta property="og:image" content="{{ $profile->getFirstMedia()->getUrl() }}">
        @endif
    @else
        <meta property="og:image" content="{{ asset('img/grey.png') }}">
    @endif
@stop

@section('title')
    {{ $profile->getName() }}
    @parent
@endsection

@section('page-title')
    <a
        href="{{ request()->discover ?
            route('app.exhibits.show',[
                'exhibit' => request()->discover,
                'discover' => request()->discover,
            ]) :
            route('app.profiles.show',[
                'profile' => $profile->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ])
        }}"
    >
        <i class="sl sl-icon-arrow-left"></i>
        @php
            $words = explode(' ', $profile->getName());
            if (count($words) > 3) {
                $truncatedName = implode(' ', array_slice($words, 0, 3)) . '...';
            } else {
                $truncatedName = $profile->getName();
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
            ])
        ]
    ) ])
@stop

@section('content')
    @include('components.notifications')

    @include('profile.documents',['documents' => $profile->documents()])

    @include('profile.main-information',['profile' => $profile])
@stop

@section('external')
    @include('profile.more-information', ['profile' => $profile, 'showContactForm' => true])

    <div class="container full-width">
        <div class="row margin-top-10 margin-left-15 margin-right-15">
            @include('components.carousels.profiles', ['groups' => $profile->groups()->filter()->get()])
            @include('components.carousels.exhibits', ['exhibits' => $profile->exhibits()->filter()->get()])
            @include('components.carousels.artworks', ['artworks' => $profile->artworks()->filter()->get()])
            @include('components.carousels.websites', ['websiteGroups' => $profile->websiteGroups()->filter()->get()])
            @include('components.carousels.collections', ['collections' => $profile->collections()->filter()->get()])
        </div>
    </div>
@endsection

@section('app_scripts')

@stop
