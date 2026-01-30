@extends('layouts.my-profile')

@section('header_styles')

@stop

@section('title')
    {{ __('my-exhibit.views.index.title.artist-profile') }} - {{ $myProfile->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $myProfile->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-exhibit.views.index.breadcrumbs.my-exhibits')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-exhibit.list',['myProfile' => $myProfile])
@stop

@section('app_scripts')

@stop
