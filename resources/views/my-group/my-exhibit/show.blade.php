@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ $myExhibit->name }}
    @parent
@endsection

@section('page-title')
    {{ $myExhibit->name }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-exhibit.views.show.breadcrumbs.my-exhibits') => route('my-group.my-exhibits.index',[
            'my_group' => $myGroup->id
        ]),
        $myExhibit->name => route('my-group.my-exhibits.show',[
            'my_group' => $myGroup->id,
            'my_exhibit' => $myExhibit->id
        ]),
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-group-exhibit.views.show.content.back'),
                'link' => route('my-group.my-exhibits.index',['my_group' => $myGroup->id]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [
            ( app('profile.session')->isAdministratorOfThisGroup($myGroup) && $myExhibit->artworks->count() > 0 ? [
                    'label' => __('my-group-exhibit.views.show.span.add-artwork'),
                    'link' => route('my-group.my-exhibits.my-artworks.create',['my_group' => $myGroup->id,'my_exhibit' => $myExhibit->id]),
                    'icon' => 'plus'
                ] : []
            )
        ]
    ])

    @include('components.notifications')

    @include('my-profile.my-exhibit.artworks',['myExhibit' => $myExhibit])

    @include('my-profile.my-exhibit.main-information',['myExhibit' => $myExhibit])

    @include('my-profile.my-exhibit.bottom-buttons',['myExhibit' => $myExhibit])
@stop

@section('app_scripts')

@stop
