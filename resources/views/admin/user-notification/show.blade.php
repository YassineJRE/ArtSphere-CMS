@extends('admin.layouts.default')

@section('title')
    {{ __('admin-user-notification.views.show.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        {{ __('admin-user-notification.views.show.breadcrumbs.home') }} => route('admin.dashboard'),
        {{ __('admin-user-notification.views.show.breadcrumbs.user-notifications') }} => route('admin.user-notifications.index'),
        (string)$notification->id
    ]])
@stop

@section('content')
    <div class="row margin-25">
        {{ __('admin-user-notification.views.show.content.id') }} {{ $notification->id }}
    </div>
@stop

@section('app_scripts')

@stop
