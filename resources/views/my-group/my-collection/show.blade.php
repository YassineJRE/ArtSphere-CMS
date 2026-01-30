@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ $myCollection->title }}
    @parent
@endsection

@section('page-title')
    {{ $myCollection->title }}

@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-collection.views.show.breadcrumbs.my-collections') => route('my-group.my-collections.index',[
            'my_group' => $myGroup->id
        ]),
        $myCollection->title => route('my-group.my-collections.show',[
            'my_group' => $myGroup->id,
            'my_collection' => $myCollection->id
        ]),
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-group-collection.views.show.content.back'),
                'link' => route('my-group.my-collections.index',['my_group' => $myGroup->id]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [
        ]
    ])

    @include('components.notifications')

    @include('my-profile.my-collection.items',['myCollection' => $myCollection])

    @include('my-profile.my-collection.main-information',['myCollection' => $myCollection])

    @include('my-profile.my-collection.bottom-buttons',['myCollection' => $myCollection])
@stop

@section('app_scripts')

@stop
