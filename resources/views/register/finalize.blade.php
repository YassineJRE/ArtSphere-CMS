@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('register.views.finalize.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('register.views.finalize.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('register.views.finalize.breadcrumbs.home') => route('app.home'),
        __('register.views.finalize.breadcrumbs.register-breadcrumbs')
    ]])
@stop

@section('content')
    <div class="woocommerce col-md-push-3 col-md-6">
        @include('components.notifications')
        <h2>{{ __('register.views.finalize.h2.title') }}</h2>
        <form
            action="{{ route('authentication.register.store') }}"
            class="register"
            method="post"
        >
            <input type="hidden"
                name="_token"
                value="{{ csrf_token() }}">
            <p class="form-row">
                <label for="first_name">{{ __('register.views.finalize.form.p.label.first-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                    name="first_name"
                    id="first_name"
                    value=""
                    required
                    autofocus>
            </p>
            <p class="form-row">
                <label for="last_name">{{ __('register.views.finalize.form.p.label.last-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                    name="last_name"
                    id="last_name"
                    required>
            </p>
            <p class="form-row">
                <label for="email">{{ __('register.views.finalize.form.p.label.email') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('email')) invalid @endif"
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                >
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </p>
            <p class="form-row">
                <label for="password">{{ __('register.views.finalize.form.p.label.password') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('password')) invalid @endif"
                    type="password"
                    name="password"
                    id="password"
                    value="{{ old('password') }}"
                    required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </p>
            <p class="form-row">
                <label for="password_confirmation">{{ __('register.views.finalize.form.p.label.password-confirmation') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('password_confirmation')) invalid @endif"
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    value="{{ old('password_confirmation') }}"
                    required>
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </p>
            <p class="form-row form-group user-role vendor-customer-registration">
                <label class="radio">
                    <input type="radio" name="role" value="customer" checked="checked">
                    {{ __('register.views.finalize.form.p.label.customer') }}
                </label>
                <br>
                <label class="radio">
                    <input type="radio" name="role" value="seller">
                    {{ __('register.views.finalize.form.p.label.vendor') }}
                </label>
            </p>
            <p class="form-row">
                <input type="hidden" name="_wp_http_referer" value="/my-account/">
                <input type="submit" class="woocommerce-Button button" name="register" value="{{ __('register.views.finalize.form.p.register-button') }}">
            </p>
        </form>
    </div>
@stop
