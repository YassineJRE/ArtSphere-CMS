@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-artist-profile.views.index.title.artist-profile') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-artist-profile.views.index.page-title.artist-profile') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-artist-profile.views.index.breadcrumbs.account') => route('my-account.index'),
        __('my-artist-profile.views.index.breadcrumbs.artist-profile')
    ]])
@stop


@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <p class="col-md-12">
        {{ __('my-artist-profile.views.index.p.text') }}
    </p>
    <p class="col-md-12">
        <a class="button"
            href="{{ route('my-account.artist-profile.create') }}">
            {{ __('my-artist-profile.views.index.p.button.create-account') }}
        </a>
    </p>
</div>
@stop
