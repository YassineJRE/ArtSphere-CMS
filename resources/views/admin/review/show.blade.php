@extends('admin.layouts.default')

@section('title')
    {{ __('admin-review.views.show.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-review.views.show.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-review.views.show.breadcrumbs.reviews') => route('admin.reviews.index'),
        (string)$review->id
    ]])
@stop

@section('content')
    <div class="row margin-25">
        {{ __('admin-review.views.show.content.id') }} {{ $review->id }}
    </div>
@stop

@section('app_scripts')

@stop
