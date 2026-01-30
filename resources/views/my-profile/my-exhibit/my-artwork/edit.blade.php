@extends('layouts.main')

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
        __('my-exhibit.views.edit.breadcrumbs.my-exhibits') => route('my-profile.my-exhibits.index',[
            'my_profile' => $myProfile->id
        ]),
        $myExhibit->name => route('my-profile.my-exhibits.show',[
            'my_profile' => $myProfile->id,
            'my_exhibit' => $myExhibit->id
        ]),
        ' '.$myArtwork->name => route('my-profile.my-exhibits.my-artworks.show',[
            'my_profile' => $myProfile->id,
            'my_exhibit' => $myExhibit->id,
            'my_artwork' => $myArtwork->id
        ]),
        __('my-artwork.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')
    
    @include('my-profile.my-exhibit.my-artwork.edit-form',['myArtwork' => $myArtwork])
@stop

@section('app_scripts')

@stop
