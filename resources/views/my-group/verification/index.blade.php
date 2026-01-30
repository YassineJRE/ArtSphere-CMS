@extends('layouts.my-group')

@section('header_styles')

@stop

@section('title')
    {{ __('my-group-verification.views.index.title.artist-group') }} - {{ $myGroup->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $myGroup->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-verification.views.index.breadcrumbs.verification')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-group.verification.list',['myGroup' => $myGroup])
@stop

@section('app_scripts')

@stop
