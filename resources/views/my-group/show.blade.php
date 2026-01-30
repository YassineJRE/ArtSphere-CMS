@extends('layouts.my-group')

@section('header_styles')

@stop

@section('title')
    {{ __('my-group.views.show.title.artist-group') }} - {{ $group->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $group->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $group->getName() => route('my-group.show',['my_group' => $group->id]),
        __('my-group.views.show.breadcrumbs.group')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.documents',['profile' => $group])

    @include('my-group.main-information',['group' => $group])

    @include('my-profile.bottom-buttons',['profile' => $group])
@stop

@section('app_scripts')

@stop
