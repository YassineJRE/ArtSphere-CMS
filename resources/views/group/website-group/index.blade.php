@extends('layouts.group')

@section('header_styles')

@stop

@section('title')
    {{ $group->getName() }}
    @parent
@endsection

@section('page-title')
    <a 
        href="{{ route('app.groups.show',[
            'group' => $group->id,
            'search' => request()->search,
            'discover' => request()->discover,
        ]) }}"
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
            ]),
            __('my-group-website-group.views.index.breadcrumbs.my-websites')
        ]
    ) ])
@stop

@section('content')
    @include('components.notifications')

    @include('profile.website-group.list',['websiteGroups' => $group->websiteGroups()])
@stop

@section('app_scripts')

@stop
