@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-artist-group.views.index.title.add-artist-group') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-artist-group.views.index.page-title.add-artist-group') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-artist-group.views.index.breadcrumbs.account') => route('my-account.index'),
        __('my-artist-group.views.index.breadcrumbs.add-artist-group')
    ]])
@stop


@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <p class="col-md-12">
        {{ __('my-artist-group.views.index.p.text') }}
    </p>
    <p class="col-md-12">
        <a class="button"
            href="{{ route('my-account.artist-group.create') }}">
            {{ __('my-artist-group.views.index.p.button.create') }}
        </a>
    </p>
</div>
@stop
