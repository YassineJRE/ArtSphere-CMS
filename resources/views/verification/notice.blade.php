@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('verification.views.notice.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('verification.views.notice.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('verification.views.notice.breadcrumbs.notice'),
        __('verification.views.notice.breadcrumbs.verify-email')
    ]])
@stop

@section('content')
    <div class="container woocommerce">
        @include('components.notifications')
        @auth
            @if (!Auth::user()->hasVerifiedEmail())
                <h2>{{ __('verification.views.notice.h2.verify') }}</h2>
                <p>{{ __('verification.views.notice.p.verification-message') }}</p>
                <p>
                    <form
                        action="{{ route('verification.send-email') }}"
                        method="POST"
                    >
                        @csrf
                        <input
                            type="submit"
                            class="button"
                            name="link"
                            value="{{ __('verification.views.notice.p.form.button.request') }}">
                    </form>
                </p>
            @endif
        @endauth
    </div>
@endsection
