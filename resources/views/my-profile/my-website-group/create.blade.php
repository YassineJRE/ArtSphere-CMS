@extends('layouts.main')

@section('title')
    {{ __('my-website-group.views.create.title.add-website') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-website-group.views.create.page-title.add-website') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-website-group.views.create.breadcrumbs.my-websites') => route('my-profile.my-website-groups.index',['my_profile' => $myProfile->id]),
        __('my-website-group.views.create.breadcrumbs.add-website')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-website-group.create-form',['myProfile' => $myProfile])
@stop

@section('app_scripts')

@stop
