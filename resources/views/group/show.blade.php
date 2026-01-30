@extends('layouts.group')

@section('header_styles')
    <meta property="og:title" content="{{ $group->getName() }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($group->hasMedia())
        @if ($group->getFirstMedia()->getTypeFromExtension() == 'pdf')
            <meta property="og:image" content="{{ asset('img/documents/pdf2.png') }}">
        @elseif (str_contains($group->getFirstMedia()->file_name, '.doc'))
            <meta property="og:image" content="{{ asset('img/documents/doc.png') }}">
        @else
            <meta property="og:image" content="{{ $group->getFirstMedia()->getUrl() }}">
        @endif
    @else
        <meta property="og:image" content="{{ asset('img/grey.png') }}">
    @endif
@stop

@section('title')
    {{ $group->getName() }}
    @parent
@endsection

@section('page-title')
    <a
        href="{{ request()->discover ?
            route('app.exhibits.show',[
                'exhibit' => request()->discover,
                'discover' => request()->discover,
            ]) :
            route('app.groups.show',[
                'group' => $group->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ])
        }}"
    >
        <i class="sl sl-icon-arrow-left"></i>
        {{ $group->getName() }}
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
            ])
        ]
    ) ])
@stop

@section('content')
    @include('components.notifications')

    @include('profile.documents',['documents' => $group->documents()])

    @include('group.main-information',['group' => $group])
@stop

@section('external')
    @include('group.more-information', ['group' => $group])

    <div class="container full-width">
        <div class="row margin-top-10 margin-left-15 margin-right-15">
            @include('components.carousels.profiles', ['profiles' => $group->memberProfiles()->filter()->get()])
            @include('components.carousels.exhibits', ['exhibits' => $group->exhibits()->filter()->get()])
            @include('components.carousels.artworks', ['artworks' => $group->artworks()->filter()->get()])
            @include('components.carousels.websites', ['websites' => $group->websiteGroups()->filter()->get()])
            @include('components.carousels.collections', ['collections' => $group->collections()->filter()->get()])
        </div>
    </div>
@endsection

@section('app_scripts')

@stop
