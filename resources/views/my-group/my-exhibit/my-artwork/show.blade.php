@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ $myArtwork->name }}
    @parent
@endsection

@section('page-title')
    {{ $myArtwork->name }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-exhibit.views.show.breadcrumbs.my-exhibits') => route('my-group.my-exhibits.index',[
            'my_group' => $myGroup->id
        ]),
        $myExhibit->name => route('my-group.my-exhibits.show',[
            'my_group' => $myGroup->id,
            'my_exhibit' => $myExhibit->id
        ]),
        ' '.$myArtwork->name => route('my-group.my-exhibits.my-artworks.edit',[
            'my_group' => $myGroup->id,
            'my_exhibit' => $myExhibit->id,
            'my_artwork' => $myArtwork->id
        ])
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-group-artwork.views.show.content.back'),
                'link' => route('my-group.my-exhibits.show',[
            		'my_group' => $myGroup->id,
            		'my_exhibit' => $myExhibit->id
        		]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [
        ]
    ])

    @include('my-profile.my-exhibit.my-artwork.main-information',['myArtwork' => $myArtwork])

    @include('my-profile.my-exhibit.my-artwork.bottom-buttons',['myArtwork' => $myArtwork])
@stop

@section('app_scripts')

@stop
