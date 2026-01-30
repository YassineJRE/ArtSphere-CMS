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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-collection.views.show.breadcrumbs.my-collections') => route('my-profile.my-collections.index',[
            'my_profile' => $myProfile->id
        ]),
        $myCollection->title => route('my-profile.my-collections.show',[
            'my_profile' => $myProfile->id,
            'my_collection' => $myCollection->id
        ]),
        $item->getTitle()
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => 'Back to My collection',
                'link' => route('my-profile.my-collections.show',[
                    'my_profile' => $myProfile->id,
                    'my_collection' => $myCollection->id
                ]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [

        ]
    ])

    @include('components.notifications')

    @include('my-profile.my-collection.item.main-information',['item' => $item])
@stop

@section('app_scripts')

@stop
