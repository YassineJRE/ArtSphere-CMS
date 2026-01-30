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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-collection.views.edit.breadcrumbs.my-collections') => route('my-profile.my-collections.index',[
            'my_profile' => $myProfile->id
        ]),
        $myCollection->title => route('my-profile.my-collections.show',[
            'my_profile' => $myProfile->id,
            'my_collection' => $myCollection->id
        ]),
        __('my-collection.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-collection.edit-form', ['myCollection' => $myCollection])
@stop

@section('app_scripts')

@stop
