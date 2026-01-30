@extends('admin.layouts.default')

@section('title')
    {{ __('admin-errors.views.link-expired.h2.expired') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-errors.views.link-expired.nav.ul.li.link.home') => route('admin.dashboard'),
        __('admin-errors.views.404.nav.ul.li.link-expired'),
    ]])
@stop

@section('content')
    <div class="col-md-12">
        <section id="not-found" class="center">
            <h2>{{ __('admin-errors.views.link-expired.h2.403') }} <i class="fa fa-question-circle"></i></h2>
            <p>{{ __('admin-errors.views.link-expired.p.expired') }}</p>
        </section>
    </div>
@stop