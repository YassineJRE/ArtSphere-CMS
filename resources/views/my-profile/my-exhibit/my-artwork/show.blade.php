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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-exhibit.views.show.breadcrumbs.my-exhibits') => route('my-profile.my-exhibits.index',[
            'my_profile' => $myProfile->id
        ]),
        $myExhibit->name => route('my-profile.my-exhibits.show',[
            'my_profile' => $myProfile->id,
            'my_exhibit' => $myExhibit->id
        ]),
        ' '.$myArtwork->name => route('my-profile.my-exhibits.my-artworks.edit',[
            'my_profile' => $myProfile->id,
            'my_exhibit' => $myExhibit->id,
            'my_artwork' => $myArtwork->id
        ])
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-artwork.views.show.content.back'),
                'link' => route('my-profile.my-exhibits.show',[
            		'my_profile' => $myProfile->id,
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

@section('external')

@stop

@section('app_scripts')

@stop
