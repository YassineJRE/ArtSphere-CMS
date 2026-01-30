@extends('layouts.main')

@section('title')
    {{ __('my-exhibit.views.create.title.add-exhibit') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-exhibit.views.create.page-title.add-exhibit') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-exhibit.views.create.breadcrumbs.my-exhibits') => route('my-profile.my-exhibits.index',['my_profile' => $myProfile->id]),
        __('my-exhibit.views.create.breadcrumbs.add-exhibit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-exhibit.create-form', ['myProfile' => $myProfile])
@stop

@section('app_scripts')

@stop

