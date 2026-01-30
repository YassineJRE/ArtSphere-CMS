@extends('layouts.main')

@section('title')
    {{ __('my-collection.views.create.title.add-collection') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-collection.views.create.page-title.add-collection') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-collection.views.create.breadcrumbs.my-collections') => route('my-profile.my-collections.index',['my_profile' => $myProfile->id]),
        __('my-collection.views.create.breadcrumbs.add-collection')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-collection.create-form', ['myProfile' => $myProfile])
@stop

@section('app_scripts')

@stop
