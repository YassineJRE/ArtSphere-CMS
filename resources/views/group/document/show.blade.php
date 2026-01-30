@extends('layouts.group')

@section('title')
    {{ $document->name }}
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
        {{ $document->name }}
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
            __('my-document.views.show.breadcrumbs.my-documents') => route('app.groups.show',[
                'group' => $group->id, 
                'search' => request()->search,
                'discover' => request()->discover,
            ]),
                $document->name => route('app.groups.documents.show',[
                'group' => $group->id,
                'document' => $document->id,
                'search' => request()->search,
                'discover' => request()->discover,
            ])
        ]
    ) ])
@stop

@section('navigation-right-side')
    <a
        href="{{ route('app.groups.show',[
            'group' => $group->id, 
            'search' => request()->search,
            'discover' => request()->discover,
        ]) }}"
    >{{ $group->getName() }}</a>
@stop

@section('content')
    @include('profile.document.main-information',['document' => $document])
@stop

@section('app_scripts')

@stop
