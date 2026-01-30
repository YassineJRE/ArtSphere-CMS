@extends('admin.layouts.default')

@section('title')
    {{ __('admin-errors.views.500.h2.not-found') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-errors.views.500.nav.ul.li.link.home') => route('admin.dashboard'),
        __('admin-errors.views.404.nav.ul.li.not-found'),
    ]])
@stop

@section('content')
    <div class="col-md-12">
        <section id="not-found" class="center">
            <h2>{{ __('admin-errors.views.500.h2.500') }} <i class="fa fa-question-circle"></i></h2>
            <p>{{ __('admin-errors.views.404.p.dont') }}</p>
        </section>
    </div>
@stop