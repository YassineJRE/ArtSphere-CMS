@extends('layouts.main')

@section('title')
    {{ __('privacy.views.index.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('privacy.views.index.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('admin-role.views.show.breadcrumbs.home') => route('app.home'),
        __('privacy.views.index.page-title')
    ]])
@stop

@section('content')
    <div class="container">
        {!! nl2br($content) !!}
    </div>
@stop
