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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-document.views.show.breadcrumbs.my-documents') => route('my-profile.show',['my_profile' => $myProfile->id]),
        $myDocument->name => route('my-profile.my-documents.show',[
            'my_profile' => $myProfile->id,
            'my_document' => $myDocument->id
        ])
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-document.views.show.content.back'),
                'link' => route('my-profile.show',['my_profile' => $myProfile->id]),
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
