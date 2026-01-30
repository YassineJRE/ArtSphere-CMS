@extends('layouts.main')

@section('title')
    {{ __('my-group-artwork.views.create.title.add-artwork') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-group-artwork.views.create.page-title.add-artwork') }}
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
        __('my-group-artwork.views.create.breadcrumbs.add-artwork')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-exhibit.my-artwork.create-form',['myExhibit' => $myExhibit])
@stop

@section('app_scripts')

@stop
