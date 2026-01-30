@extends('layouts.main')

@section('title')
    {{ __('my-group-exhibit.views.create.title.add-exhibit') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-group-exhibit.views.create.page-title.add-exhibit') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-exhibit.views.create.breadcrumbs.my-exhibits') => route('my-group.my-exhibits.index',['my_group' => $myGroup->id]),
        __('my-group-exhibit.views.create.breadcrumbs.add-exhibit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-exhibit.create-form', ['myProfile' => $myGroup])
@stop

@section('app_scripts')

@stop

