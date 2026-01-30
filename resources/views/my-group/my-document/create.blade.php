@extends('layouts.main')

@section('title')
    {{ __('my-group-document.views.create.title.add-document') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-group-document.views.create.page-title.add-document') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-document.views.create.breadcrumbs.add-document')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-document.create-form', ['myProfile' => $myGroup])
@stop

@section('app_scripts')

@stop
