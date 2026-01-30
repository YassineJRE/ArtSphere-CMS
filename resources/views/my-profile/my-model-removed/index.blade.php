@extends('layouts.my-profile')

@section('header_styles')

@stop

@section('title')
    {{ __('my-model-removed.views.index.title.artist-profile') }} - {{ $myProfile->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $myProfile->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-model-removed.views.index.breadcrumbs.my-model-removed')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-model-removed.list',['myProfile' => $myProfile])
@stop

@section('app_scripts')

@stop
