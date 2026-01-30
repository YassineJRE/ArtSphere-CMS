@extends('admin.layouts.default')

@section('title')
    {{ __('admin-content.views.show.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-content.views.show.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-content.views.show.breadcrumbs.contents') => route('admin.contents.index'),
        $content->key
    ]])
@stop

@section('content')
    <div class="row margin-25">
        {{ __('admin-content.views.show.content.id') }} {{ $content->id }}
    </div>
@stop

@section('app_scripts')

@stop
