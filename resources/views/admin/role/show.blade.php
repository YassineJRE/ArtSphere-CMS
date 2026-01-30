@extends('admin.layouts.default')

@section('title')
    {{ $role->name }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-role.views.show.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-role.views.show.breadcrumbs.roles') => route('admin.roles.index'),
        $role->name
    ]])
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2>{{ __('admin-role.views.show.h2.name') }}</h2>
            <p>{{ $role->name }}</p>
        </div>
        <div class="col-md-6">
            <h2>{{ __('admin-role.views.show.h2.guard-name') }}</h2>
            <p>{{ $role->guard_name }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>{{ __('admin-role.views.show.h2.permission') }}</h2>
        </div>
        @foreach ($role->permissions as $permission)
            <div class="col-md-3">
                {{ __($permission->name) }}
            </div>
        @endforeach
    </div>
@stop

@section('app_scripts')

@stop
