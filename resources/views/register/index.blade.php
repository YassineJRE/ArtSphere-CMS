@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('register.views.index.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('register.views.index.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('register.views.index.breadcrumbs.home') => route('app.home'),
        __('register.views.index.breadcrumbs.register-breadcrumbs')
    ]])
@stop

@section('content')
    @if (config('app.soft_roll_out'))
        <div class="row">
            <div class="col-md-12">
                <div class="notification notice closeable margin-top-30 margin-bottom-30">
                    <p>
                        <strong>{{ __('admin-components.views.notifications.p.info') }}</strong> 
                        {{ __('register.views.index.p.soft-roll-out') }}
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="woocommerce col-md-push-3 col-md-6">
            @include('components.notifications')        
            <h2>{{ __('register.views.index.h2.title') }}</h2>
            <form
                action="{{ route('authentication.register.store') }}"
                class="vendor-customer-registration register"
                method="post"
            >
                @csrf
                <div class="form-row">
                    <label for="first_name">{{ __('register.views.index.form.p.label.first-name') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                        name="first_name"
                        id="first_name"
                        value="{{ old('first_name') }}"
                        required
                        autofocus>
                </div>
                <div class="form-row">
                    <label for="last_name">{{ __('register.views.index.form.p.label.last-name') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                        name="last_name"
                        id="last_name"
                        value="{{ old('last_name') }}"
                        required>
                </div>
                <div class="form-row">
                    <label for="email">{{ __('register.views.index.form.p.label.email') }} <span class="required">*</span></label>
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
                </div>
                <div class="form-row">
                    <label for="password">{{ __('register.views.index.form.p.label.password') }} <span class="required">*</span></label>
                    <input
                        class="input-text @if ($errors->has('password')) invalid @endif"
                        type="password"
                        name="password"
                        id="password"
                        required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-row">
                    <label for="password_confirmation">{{ __('register.views.index.form.p.label.password-confirmation') }} <span class="required">*</span></label>
                    <input
                        class="input-text @if ($errors->has('password_confirmation')) invalid @endif"
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="form-row">
                    <input
                        type="hidden"
                        name="http_referer"
                        value="{{ old('http_referer') ?? request()->headers->get('referer') }}">
                    <input
                        type="submit"
                        class="button"
                        name="register"
                        value="{{ __('register.views.index.form.p.register-button') }}">
                </div>
                <div class="lost_password">
                    {{ __('register.views.index.form.p.account') }} <a href="{{ route('authentication.login') }}" >{{ __('register.views.index.form.p.login') }}</a>
                </div>
            </form>
        </div>
    @endif
@stop
