@extends('admin.layouts.default')

@section('title')
    {{ __('admin-my-profile.views.index.title') }}
    @parent
@stop

@section('content')
    <div class="row">
        @include('admin.my-profile.details')
        @include('admin.my-profile.change-password')
    </div>
@stop

@section('app_scripts')

@stop
