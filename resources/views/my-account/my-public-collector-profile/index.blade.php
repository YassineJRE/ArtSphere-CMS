@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-public-collector-profile.views.index.title.public-collector-title') }}
    @parent
@endsection

@section('page-title')
{{ __('my-public-collector-profile.views.index.page-title.public-collector-page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-public-collector-profile.views.index.breadcrumbs.account') => route('my-account.index'),
        __('my-public-collector-profile.views.index.breadcrumbs.public-collector-breadcrumbs')
    ]])
@stop


@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <p class="col-md-12">
        {{ __('my-public-collector-profile.views.index.p.text') }}
    </p>
    <p class="col-md-12">
        <a class="button"
            href="{{ route('my-account.public-collector-profile.create') }}">
            {{ __('my-public-collector-profile.views.index.p.button.create') }}
        </a>
    </p>
</div>
@stop
