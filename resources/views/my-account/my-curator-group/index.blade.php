@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
{{ __('my-curator-group.views.index.title.add-curator-group') }}
    @parent
@endsection

@section('page-title')
{{ __('my-curator-group.views.index.page-title.add-curator-group') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-curator-group.views.index.breadcrumbs.account') => route('my-account.index'),
        __('my-curator-group.views.index.breadcrumbs.add-curator-group')
    ]])
@stop


@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <p class="col-md-12">
        {{ __('my-curator-group.views.index.p.text') }}
    </p>
    <p class="col-md-12">
        <a class="button"
            href="{{ route('my-account.curator-group.create') }}">
            {{ __('my-curator-group.views.index.p.button.create') }}
        </a>
    </p>
</div>
@stop
