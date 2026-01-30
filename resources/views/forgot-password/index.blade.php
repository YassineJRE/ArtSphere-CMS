@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('forgot-password.views.index.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('forgot-password.views.index.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('forgot-password.views.index.breadcrumbs.home') => route('app.home'),
        __('forgot-password.views.index.breadcrumbs.reset-password')
    ]])
@stop

@section('content')
    <div class="woocommerce col-md-push-3 col-md-6">
        @include('components.notifications')
        <h2>{{ __('forgot-password.views.index.h2.title') }}</h2>
        <form
            action="{{ route('authentication.forgot-password.submit') }}"
            class="woocommerce-form-login login"
            method="post"
        >
            @csrf
            <p class="form-row">
                {{ __('forgot-password.views.index.form.p.enter-email') }}
            </p>
            <p class="form-row">
                <label for="email">{{ __('forgot-password.views.index.form.p.label.email') }} <span class="required">*</span></label>
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
            </p>
            <p class="form-row">
                <input
                    type="hidden"
                    name="http_referer"
                    value="{{ old('http_referer') ?? request()->headers->get('referer') }}">
                <input
                    type="submit"
                    class="button"
                    name="reinitialize"
                    value="{{ __('forgot-password.views.index.form.p.value.reinitialize-button') }}">
            </p>
            <p class="lost_password">
                <a href="{{ route('authentication.login') }}" >{{ __('forgot-password.views.index.form.p.return') }}</a>
            </p>
        </form>
    </div>
@stop
