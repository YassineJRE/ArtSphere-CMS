@extends('admin.layouts.default')

@section('title')
    {{ __('admin-member.views.edit.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-member.views.edit.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-member.views.edit.breadcrumbs.members') => route('admin.members.index'),
        $member->first_name
    ]])
@stop

@section('content')
    <form method="post"
        action="{{ route('admin.members.update',['member' => $member]) }}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-member.views.edit.label.first-name') }}</label>
                    <input value="{{ $member->first_name }}"
                        class="input-text @if ($errors->has('first_name')) invalid @endif"
                        name="first_name"
                        type="text"  required>
                    @if ($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-member.views.edit.label.last-name') }}</label>
                    <input value="{{ $member->last_name }}"
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
                    <label>{{ __('admin-member.views.edit.label.email') }}</label>
                    <input value="{{ $member->email }}"
                        class="input-text @if ($errors->has('email')) invalid @endif"
                        name="email"
                        type="text"  required>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <button class="button margin-top-15">
                {{ __('admin-member.views.edit.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')

@stop
