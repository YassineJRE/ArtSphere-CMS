@extends('layouts.my-group')

@section('header_styles')

@stop

@section('title')
    {{ __('my-group-collection.views.index.title.artist-group') }} - {{ $myGroup->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $myGroup->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-collection.views.index.breadcrumbs.my-collections')
    ]])
@stop

@section('content')
    @include('my-profile.my-collection.list',['myProfile' => $myGroup])
@stop

@section('app_scripts')

@stop
