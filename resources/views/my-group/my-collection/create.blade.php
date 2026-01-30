@extends('layouts.main')

@section('title')
    {{ __('my-group-collection.views.create.title.add-collection') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-group-collection.views.create.page-title.add-collection') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-collection.views.create.breadcrumbs.my-collections') => route('my-group.my-collections.index',['my_group' => $myGroup->id]),
        __('my-group-collection.views.create.breadcrumbs.add-collection')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-collection.create-form', ['myProfile' => $myGroup])
@stop

@section('app_scripts')

@stop
