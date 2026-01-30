@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
{{ __('my-curator-profile.views.index.title.add-curator-profile') }}
    @parent
@endsection

@section('page-title')
{{ __('my-curator-profile.views.index.page-title.add-curator-profile') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-profiles.views.curator.breadcrumbs.account') => route('my-account.index'),
        __('my-curator-profile.views.index.breadcrumbs.add-curator-profile')
    ]])
@stop


@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <p class="col-md-12">
        {{ __('my-curator-profile.views.index.p.text') }}
    </p>
    <p class="col-md-12">
        <a class="button"
            href="{{ route('my-account.curator-profile.create') }}">
            {{ __('my-curator-profile.views.index.p.button.create-account') }}
        </a>
    </p>
</div>
@stop
