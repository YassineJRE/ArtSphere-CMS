@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('login.views.index.title') }}
    @parent
@endsection

@section('page-title')
{{ __('login.views.index.title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('login.views.index.breadcrumbs.home') => route('app.home'),
        __('login.views.index.breadcrumbs.log-in')
    ]])
@stop

@section('content')
    <div class="woocommerce col-md-push-3 col-md-6">
        @include('components.notifications')
        <form
            action="{{ route('authentication.login.authenticate') }}"
            class="woocommerce-form-login login"
            method="post"
        >
            @csrf
            <div class="form-row">
                <label for="email">{{ __('login.views.index.form.p.label.email') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('email')) invalid @endif"
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    autofocus
                >
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-row">
                <label for="password">{{ __('login.views.index.form.p.label.password') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('password')) invalid @endif"
                    type="password"
                    name="password"
                    id="password"
                    value="{{ old('password') }}" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="lost_password">
                <a href="{{ route('authentication.forgot-password') }}" >{{ __('login.views.index.form.p.forgot-password') }}</a>
            </div>
            <div class="form-row">
                <input
                    type="hidden"
                    name="http_referer"
                    value="{{ old('http_referer') ?? request()->headers->get('referer') }}">
                <input
                    type="submit"
                    class="button"
                    name="login"
                    value="{{ __('login.views.index.form.p.value.login-button') }}">

                <label>
                    <input
                        type="checkbox"
                        name="rememberme"
                        id="rememberme"
                        value="forever">
                    <span>{{ __('login.views.index.form.p.label.span.remember') }}</span>
                </label>
            </div>
            <div class="lost_password">
                {{ __('login.views.index.form.p.no-account') }} <a href="{{ route('authentication.register.index') }}" >{{ __('login.views.index.form.p.sign-up') }}</a>
            </div>
            @if (config('app.soft_roll_out'))
                <div class="notification notice closeable margin-bottom-30">
                    <p>
                        <strong>{{ __('admin-components.views.notifications.p.info') }}</strong> 
                        {{ __('login.views.index.form.p.soft-roll-out') }}                    
                    </p>
                </div>
            @endif
        </form>
    </div>
@stop
