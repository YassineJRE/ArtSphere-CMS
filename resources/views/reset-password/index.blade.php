@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('reset-password.views.index.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('reset-password.views.index.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('reset-password.views.index.breadcrumbs.home') => route('app.home'),
        __('reset-password.views.index.breadcrumbs.reset-password')
    ]])
@stop

@section('content')
    <div class="woocommerce col-md-push-3 col-md-6">
        @include('components.notifications')
        <h2>{{ __('reset-password.views.index.h2.title') }}</h2>
        <form
            action="{{ route('authentication.reset-password.submit') }}"
            class="woocommerce-form-login login"
            method="post"
        >
            @csrf
            <input type="hidden"
                name="token"
                value="{{ $token }}">
            <p class="form-row">
                <label for="email">{{ __('reset-password.views.index.form.p.label.email') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('email')) invalid @endif"
                    type="email"
                    name="email"
                    id="email"
                    value="{{ $email }}"
                    required
                    autofocus
                >
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </p>
            <p class="form-row">
                <label for="password">{{ __('reset-password.views.index.form.p.label.password') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('password')) invalid @endif"
                    type="password"
                    name="password"
                    id="password"
                    value="{{ old('password') }}" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </p>
            <p class="form-row">
                <label for="password_confirmation">{{ __('reset-password.views.index.form.p.label.password-confirmation') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('password_confirmation')) invalid @endif"
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required>
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </p>
            <p class="form-row">
                <input
                    type="submit"
                    class="button"
                    name="login"
                    value="{{ __('reset-password.views.index.form.p.value.reset-button') }}">
            </p>
        </form>
    </div>
@stop
