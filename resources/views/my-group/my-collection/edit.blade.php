@extends('layouts.main')

@section('title')
    {{ $myCollection->title }}
    @parent
@endsection

@section('page-title')
    {{ $myCollection->title }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-collection.views.edit.breadcrumbs.my-collections') => route('my-group.my-collections.index',[
            'my_group' => $myGroup->id
        ]),
        $myCollection->title => route('my-group.my-collections.show',[
            'my_group' => $myGroup->id,
            'my_collection' => $myCollection->id
        ]),
        __('my-group-collection.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-collection.edit-form', ['myCollection' => $myCollection])
@stop

@section('app_scripts')

@stop
