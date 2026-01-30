@extends('admin.layouts.default')

@section('title')
    {{ $member->first_name }} {{ $member->last_name }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-member.views.show.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-member.views.show.breadcrumbs.members') => route('admin.members.index'),
        $member->first_name
    ]])
@stop

@section('content')
    <div class="row margin-25">
        ID: {{ $member->id }}
    </div>
    @foreach ($member->profiles as $profile)
        <div class="row margin-25">Profile {{ $profile->type }}: {{ $profile->getName() }}</div>
    @endforeach
    @foreach ($member->groups as $group)
        <div class="row margin-25">Group {{ $group->type }}: {{ $group->getName() }}</div>
    @endforeach
@stop

@section('app_scripts')

@stop
