@extends('admin.layouts.default')

@section('title')
    Edit {{ $user->first_name }}'s Profile
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-user.views.edit.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-user.views.edit.breadcrumbs.users') => route('admin.users.index'),
        $user->first_name
    ]])
@stop

@section('content')
    <form method="post"
        action="{{ route('admin.users.update',['user' => $user]) }}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.edit.label.first-name') }}</label>
                    <input value="{{ $user->first_name }}"
                        class="input-text @if ($errors->has('first_name')) invalid @endif"
                        name="first_name"
                        type="text"  required>
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.edit.label.last-name') }}</label>
                    <input value="{{ $user->last_name }}"
                        class="input-text @if ($errors->has('last_name')) invalid @endif"
                        name="last_name"
                        type="text" required>
                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.edit.label.email') }}</label>
                    <input value="{{ $user->email }}"
                        class="input-text @if ($errors->has('email')) invalid @endif"
                        name="email"
                        type="text" required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <label>{{ __('admin-user.views.edit.label.roles') }}</label>
            <div class="row">
                @foreach ($roles as $role)
                    <div class="col-md-3">
                        <div class="checkboxes in-row inline">
                            <input id="role-{{ $role->id }}"
                                value="{{ $role->id }}"
                                name="roles[]"
                                type="checkbox"
                                {{ (is_array($userRoleIds) &&
                                    in_array($role->id, $userRoleIds)) ?
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
                {{ __('admin-user.views.edit.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')

@stop
