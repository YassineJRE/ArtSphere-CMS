@extends('admin.layouts.default')

@section('title')
    {{ $role->name }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-role.views.edit.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-role.views.edit.breadcrumbs.roles') => route('admin.roles.index'),
        $role->name
    ]])
@stop

@section('content')
    <form method="post"
        action="{{ route('admin.roles.update',['role' => $role]) }}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="form-row">
                <label>{{ __('admin-role.views.edit.label.name') }}</label>
                <input value="{{ $role->name }}"
                    class="input-text @if ($errors->has('name')) invalid @endif"
                    name="name"
                    type="text"
                    required autofocus>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-row">
                <label>{{ __('admin-role.views.edit.label.permission') }}</label>
                @foreach ($permissions as $permission)
                    <div class="col-md-3">
                        <div class="checkboxes in-row inline">
                            <input id="permission-{{ $permission->id }}"
                                value="{{ $permission->id }}"
                                name="permissions[]"
                                type="checkbox"
                                {{ (is_array($rolePermissionIds) &&
                                    in_array($permission->id, $rolePermissionIds)) ?
                                    ' checked' : '' }}
                            >
                            <label for="permission-{{ $permission->id }}">
                                {{ __($permission->name) }}
                            </label>
                        </div>
                    </div>
                @endforeach
                @if ($errors->has('permissions'))
                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                @endif
            </div>

            <button class="button margin-top-15">
                {{ __('admin-role.views.edit.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')

@stop
