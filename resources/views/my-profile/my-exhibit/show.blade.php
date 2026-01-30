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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-exhibit.views.show.breadcrumbs.my-exhibits') => route('my-profile.my-exhibits.index',[
            'my_profile' => $myProfile->id
        ]),
        $myExhibit->name => route('my-profile.my-exhibits.show',[
            'my_profile' => $myProfile->id,
            'my_exhibit' => $myExhibit->id
        ]),
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-exhibit.views.show.content.back'),
                'link' => route('my-profile.my-exhibits.index',['my_profile' => $myProfile->id]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [
            ( $myExhibit->artworks->count() > 0 ? [
                    'label' => __('my-exhibit.views.show.span.add-artwork'),
                    'link' => route('my-profile.my-exhibits.my-artworks.create',['my_profile' => $myProfile->id,'my_exhibit' => $myExhibit->id]),
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

@section('external')

@stop

@section('app_scripts')

@stop
