@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('invitation.views.registration.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('invitation.views.registration.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('invitation.views.registration.breadcrumbs.home') => route('app.home'),
        __('invitation.views.registration.breadcrumbs.register-breadcrumbs')
    ]])
@stop

@section('content')
    <div class="woocommerce col-md-push-3 col-md-6">
        @include('components.notifications')
        <h2>{{ __('invitation.views.registration.h2.title') }}</h2>
        <form
            action="{{ route('invitation.register',[
                'user_invitation' => $invitation->id,
                'subject' => $invitation->subject_id,
                'token' => $invitation->token
            ]) }}"
            class="vendor-customer-registration register"
            method="post"
        >
            @csrf
            <div class="form-row">
                <label for="first_name">{{ __('invitation.views.registration.form.p.label.first-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                    name="first_name"
                    id="first_name"
                    value="{{ old('first_name') ?? $invitation->first_name }}"
                    required
                >
            </div>
            <div class="form-row">
                <label for="last_name">{{ __('invitation.views.registration.form.p.label.last-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                    name="last_name"
                    id="last_name"
                    value="{{ old('last_name') ?? $invitation->last_name }}"
                    required
                >
            </div>
            <div class="form-row">
                <label for="email">{{ __('invitation.views.registration.form.p.label.email') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('email')) invalid @endif"
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') ?? $invitation->email }}"
                    readonly
                >
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-row">
                <label for="password">{{ __('invitation.views.registration.form.p.label.password') }} <span class="required">*</span></label>
                <input
                    class="input-text @if ($errors->has('password')) invalid @endif"
                    type="password"
                    name="password"
                    id="password"
                    required
                    autofocus
                >
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-row">
                <label for="password_confirmation">{{ __('invitation.views.registration.form.p.label.password-confirmation') }} <span class="required">*</span></label>
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
                    value="{{ __('invitation.views.registration.form.p.register-button') }}">
            </div>
            <p class="lost_password">
                {{ __('invitation.views.registration.form.p.account') }} <a href="{{ route('authentication.login') }}" >{{ __('invitation.views.registration.form.p.login') }}</a>
            </p>
        </form>
    </div>
@stop
