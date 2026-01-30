@extends('layouts.my-profile')

@section('header_styles')

@stop

@section('title')
    {{ __('my-profile.views.show.title.artist-profile') }} - {{ $profile->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $profile->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $profile->getName() => route('my-profile.show',['my_profile' => $profile->id]),
        __('my-profile.views.show.breadcrumbs.profile')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @if ($profile->isArtist() || $profile->isCurator() || $profile->isPublicCollector())
        @include('my-profile.documents',['profile' => $profile])
    @endif

    @include('my-profile.main-information',['profile' => $profile])

    @include('my-profile.bottom-buttons',['profile' => $profile])
@stop

@section('external')

@stop

@section('app_scripts')

@stop
