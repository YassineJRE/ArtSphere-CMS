@extends('admin.layouts.default')

@section('title')
    {{ $gallery->name }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-gallery.views.show.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-gallery.views.show.breadcrumbs.galleries') => route('admin.galleries.index',[
            'status' => $gallery->status
        ]),
        $gallery->name
    ]])
@stop

@section('content')
    <div class="row margin-25">
        <div class="col-md-6">ID: {{ $gallery->id }}</div>
        <div class="col-md-6">Name of institution: {{ $gallery->name }}</div>
    </div>
    <div class="row margin-25">
        <div class="col-md-6">Type of institution: {{ $gallery->institution_type }}</div>
        <div class="col-md-6">Mandate: {{ $gallery->mandate }}</div>
    </div>
    <div class="row margin-25">
        <div class="col-md-6">Member of: {{ $gallery->member_of }}</div>
        <div class="col-md-6">Country: {{ $gallery->country }}</div>
    </div>
    <div class="row margin-25">
        <div class="col-md-6">Email: {{ $gallery->email }}</div>
        <div class="col-md-6">Phone: {{ $gallery->phone }}</div>
    </div>
    <div class="row margin-25">
        <div class="col-md-12">Mandate: {{ $gallery->mandate }}</div>
    </div>
    <div class="row margin-25">
        <div class="col-md-6">Additional information title: {{ $gallery->additional_information_title }}</div>
        <div class="col-md-6">Additional information content: {{ $gallery->additional_information_content }}</div>
    </div>
    <div class="row margin-25">
        <div class="col-md-6">Status: {{ $gallery->status }}</div>
    </div>
    <div class="row margin-25">
        <div class="col-md-12">
            <b>Employees: </b>
            @foreach ($gallery->members as $member)
                {{ $member->profile->getName() }} @if(!$loop->last),@endif
            @endforeach
        </div>
    </div>
@stop

@section('app_scripts')

@stop
