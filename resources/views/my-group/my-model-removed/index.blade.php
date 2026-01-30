@extends('layouts.my-group')

@section('header_styles')

@stop

@section('title')
    {{ __('my-model-removed.views.index.title.artist-group') }} - {{ $myGroup->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $myGroup->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-model-removed.views.index.breadcrumbs.my-model-removed')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-model-removed.list',['myProfile' => $myGroup])
@stop

@section('app_scripts')

@stop