@extends('layouts.my-profile')

@section('header_styles')

@stop

@section('title')
    {{ __('my-collection.views.index.title.artist-profile') }} - {{ $myProfile->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $myProfile->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-collection.views.index.breadcrumbs.my-collections')
    ]])
@stop

@section('content')
    @include('my-profile.my-collection.list',['myProfile' => $myProfile])
@stop

@section('app_scripts')

@stop
