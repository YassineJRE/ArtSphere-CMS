@extends('layouts.discover')

@section('header_styles')
@stop

@section('title')
    {{ $artwork->name }}
    @parent
@endsection

@php
    $exhibitUrl = $exhibit->getRoute();
    $artworkUrl = $artwork->getRoute();
    $owner = $artwork->exhibit->owner;
    $ownerUrl = $owner->getRoute();
@endphp

@section('page-title')
    <a href="{{ $exhibitUrl }}">
        <i class="sl sl-icon-arrow-left"></i>
        {{ $artwork->name }}
    </a>
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('components.views.banner.h4.discover'),
        $exhibit->name => $exhibitUrl,
        ' '.$artwork->name => $artworkUrl,
    ]])
@stop

@section('navigation-right-side')
    <a href="{{ $ownerUrl }}">{{ $owner->getName() }}</a>
@stop

@section('content')
    @include('profile.exhibit.artwork.main-information', ['artwork' => $artwork])

    @auth
        @include('profile.exhibit.artwork.comments', ['artwork' => $artwork])
    @endauth
@stop

@section('external')
    @include('profile.exhibit.artwork.more-information', ['artwork' => $artwork])
@endsection

@section('app_scripts')
@stop
