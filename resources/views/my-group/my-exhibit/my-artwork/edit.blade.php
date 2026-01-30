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
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-exhibit.views.edit.breadcrumbs.my-exhibits') => route('my-group.my-exhibits.index',[
            'my_group' => $myGroup->id
        ]),
        $myExhibit->name => route('my-group.my-exhibits.show',[
            'my_group' => $myGroup->id,
            'my_exhibit' => $myExhibit->id
        ]),
        ' '.$myArtwork->name => route('my-group.my-exhibits.my-artworks.show',[
            'my_group' => $myGroup->id,
            'my_exhibit' => $myExhibit->id,
            'my_artwork' => $myArtwork->id
        ]),
        __('my-group-artwork.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')
        
    @include('my-profile.my-exhibit.my-artwork.edit-form',['myArtwork' => $myArtwork])
@stop

@section('app_scripts')

@stop