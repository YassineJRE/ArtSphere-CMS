@extends('layouts.main')

@section('title')
    {{ __('my-document.views.create.title.add-document') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-document.views.create.page-title.add-document') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-document.views.create.breadcrumbs.add-document')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-document.create-form', ['myProfile' => $myProfile])
@stop

@section('app_scripts')

@stop
