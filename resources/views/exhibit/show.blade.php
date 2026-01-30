@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('exhibit.views.index.title.search-result') }}
    @parent
@endsection

@section('page-title')
    {{ __('exhibit.views.index.page-title.search-result') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [

    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('profile.exhibit.title',['exhibit' => $exhibit])

    @include('profile.exhibit.artworks',[
        'exhibit' => $exhibit,
        'previousExhibitId' => $previousExhibitId,
        'nextExhibitId' => $nextExhibitId,
    ])

    @include('profile.exhibit.main-information',['exhibit' => $exhibit])

    @include('profile.exhibit.comments',['exhibit' => $exhibit])
@stop

@section('external')
    @include('profile.exhibit.more-information', ['exhibit' => $exhibit])
@endsection

@section('app_scripts')

@stop
