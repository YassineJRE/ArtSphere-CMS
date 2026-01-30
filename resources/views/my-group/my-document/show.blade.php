@extends('layouts.main')

@section('title')
    {{ $myDocument->name }}
    @parent
@endsection

@section('page-title')
    {{ $myDocument->name }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-document.views.show.breadcrumbs.my-documents') => route('my-group.show',['my_group' => $myGroup->id]),
        $myDocument->name => route('my-group.my-documents.show',[
            'my_group' => $myGroup->id,
            'my_document' => $myDocument->id
        ])
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-group-document.views.show.content.back'),
                'link' => route('my-group.show',['my_group' => $myGroup->id]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [
        ]
    ])

    @include('my-profile.my-document.main-information',['myDocument' => $myDocument])

    @include('my-profile.my-document.bottom-buttons',['myDocument' => $myDocument])
@stop

@section('app_scripts')

@stop
