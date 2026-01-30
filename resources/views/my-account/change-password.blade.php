@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-account.views.change-password.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-account.views.change-password.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-account.views.change-password.breadcrumbs.account') => route('my-account.index'),
        __('my-account.views.change-password.breadcrumbs.change-password')
    ]])
@stop

@section('content')
<div class="woocommerce-MyAccount-content">
    <div class="woocommerce col-md-12">
        @include('components.notifications')
        <form
            action="{{ route('my-account.update-password') }}"
            class="register"
            method="post"
        >
            <h3>{{ __('my-account.views.change-password.form.h3.title') }}</h3>
            <input type="hidden"
                name="_method"
                value="PUT">
            @csrf
            <p class="form-row">
                <label for="current_password">{{ __('my-account.views.change-password.form.p.label.current-password') }} <span class="required">*</span></label>
                <input
                    type="password"
                    class="input-text form-control @if ($errors->has('current_password')) invalid @endif"
                    name="current_password"
                    id="current_password"
                    value="{{ old('current_password') }}">
                @if ($errors->has('current_password'))
                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                @endif
            </p>
            <p class="form-row">
                <label for="password">{{ __('my-account.views.change-password.form.p.label.password') }} <span class="required">*</span></label>
                <input
                    type="password"
                    class="input-text form-control @if ($errors->has('password')) invalid @endif"
                    name="password"
                    id="password"
                    value="{{ old('password') }}">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </p>
            <p class="form-row">
                <label for="password_confirmation">{{ __('my-account.views.change-password.form.p.label.password-confirmation') }} <span class="required">*</span></label>
                <input
                    type="password"
                    class="input-text form-control @if ($errors->has('password_confirmation')) invalid @endif"
                    name="password_confirmation"
                    id="password_confirmation"
                    value="{{ old('password_confirmation') }}">
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </p>
            <p class="form-row col-md-12">
                <input
                    type="submit"
                    class="button"
                    name="save"
                    value="{{ __('my-account.views.change-password.form.p.value.save-button') }}">
            </p>
        </form>
    </div>
</div>
@stop
