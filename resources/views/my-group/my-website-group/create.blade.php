@extends('layouts.main')

@section('title')
    {{ __('my-group-website-group.views.create.title.add-website') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-group-website-group.views.create.page-title.add-website') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-website-group.views.create.breadcrumbs.my-website-groups') => route('my-group.my-website-groups.index',['my_group' => $myGroup->id]),
        __('my-group-website-group.views.create.breadcrumbs.add-website')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-website-group.create-form',['myProfile' => $myGroup])
@stop

@section('app_scripts')

@stop
