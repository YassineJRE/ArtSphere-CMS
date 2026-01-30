@extends('admin.layouts.default')

@section('title')
    {{ __('admin-member.views.create.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-member.views.create.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-member.views.create.breadcrumbs.members') => route('admin.members.index'),
        __('admin-member.views.create.breadcrumbs.new-member')
    ]])
@stop

@section('content')
    <form method="post"
        action="{{ route('admin.members.store') }}">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-member.views.create.label.first-name') }}</label>
                    <input value="{{ @old('first_name') }}"
                        class="input-text @if ($errors->has('first_name')) invalid @endif"
                        name="first_name"
                        type="text"  required>
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-member.views.create.label.last-name') }}</label>
                    <input value="{{ @old('last_name') }}"
                        class="input-text @if ($errors->has('last_name')) invalid @endif"
                        name="last_name"
                        type="text"  required>
                    @if ($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-member.views.create.label.email') }}</label>
                    <input value="{{ @old('email') }}"
                        class="input-text @if ($errors->has('email')) invalid @endif"
                        name="email"
                        type="text"  required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-member.views.create.label.password') }}</label>
                    <input value="{{ @old('password') }}"
                        class="input-text @if ($errors->has('password')) invalid @endif"
                        name="password"
                        type="text"  required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>

            <button class="button margin-top-15">
                {{ __('admin-member.views.create.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')

@stop
