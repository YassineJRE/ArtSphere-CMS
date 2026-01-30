@extends('layouts.main')

@section('title')
    {{ __('my-artwork.views.create.title.add-artwork') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-artwork.views.create.page-title.add-artwork') }}
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
        __('my-artwork.views.create.breadcrumbs.add-artwork')
    ]])
@stop

@section('content')
    @include('components.notifications')
    
    @include('my-profile.my-exhibit.my-artwork.create-form',['myExhibit' => $myExhibit])
@stop

@section('app_scripts')

@stop
