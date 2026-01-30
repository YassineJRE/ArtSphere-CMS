@extends('admin.layouts.default')

@section('title')
    {{ __('admin-user.views.create.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-user.views.create.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-user.views.create.breadcrumbs.users') => route('admin.users.index'),
        __('admin-user.views.create.breadcrumbs.new-user')
    ]])
@stop

@section('content')
    <form method="post"
        action="{{ route('admin.users.store') }}">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.create.label.first-name') }}</label>
                    <input value="{{ @old('first_name') }}"
                        class="input-text @if ($errors->has('first_name')) invalid @endif"
                        name="first_name"
                        type="text"  required>
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.create.label.last-name') }}</label>
                    <input value="{{ @old('last_name') }}"
                        class="input-text @if ($errors->has('last_name')) invalid @endif"
                        name="last_name"
                        type="text" required>
                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.create.label.email') }}</label>
                    <input value="{{ @old('email') }}"
                        class="input-text @if ($errors->has('email')) invalid @endif"
                        name="email"
                        type="text" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.create.label.can-access-admin.question') }}</label>
                    <div class="checkboxes in-row inline">
                        <input id="can_access_admin"
                            value="1"
                            name="can_access_admin"
                            type="checkbox"
                            {{ @old('can_access_admin') == 1 ? ' checked' : '' }}
                        >
                        <label for="can_access_admin">
                            {{ __('admin-user.views.create.label.can-access-admin.yes') }}
                        </label>
                    </div>
                    @if ($errors->has('can_access_admin'))
                        <div class="col-md-12">
                            <span class="text-danger">{{ $errors->first('can_access_admin') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <label>{{ __('admin-user.views.create.label.roles') }}</label>
            <div class="row">
                @foreach ($roles as $role)
                    <div class="col-md-3">
                        <div class="checkboxes in-row inline">
                            <input id="role-{{ $role->id }}"
                                value="{{ $role->id }}"
                                name="roles[]"
                                type="checkbox"
                                {{ (is_array(@old('roles')) &&
                                    in_array($role->id, @old('roles'))) ?
                                    ' checked' : '' }}
                            >
                            <label for="role-{{ $role->id }}">
                                {{ $role->name}}
                            </label>
                        </div>
                    </div>
                @endforeach
                @if ($errors->has('roles'))
                    <div class="col-md-12">
                        <span class="text-danger">{{ $errors->first('roles') }}</span>
                    </div>
                @endif
            </div>

            <button class="button margin-top-15">
                {{ __('admin-user.views.create.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')

@stop
