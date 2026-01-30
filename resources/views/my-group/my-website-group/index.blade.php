@extends('layouts.my-group')

@section('header_styles')

@stop

@section('title')
    {{ __('my-group-website-group.views.index.title.artist-group') }} - {{ $myGroup->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $myGroup->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-website-group.views.index.breadcrumbs.my-websites')
    ]])
@stop

@section('content')
    @include('my-profile.my-website-group.list',['myProfile' => $myGroup])
@stop

@section('app_scripts')

@stop
