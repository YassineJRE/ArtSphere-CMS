@extends('layouts.main')

@section('title')
    {{ $myDocument->name }}
    @parent
@endsection

@section('page-title')
    {{ $myDocument->name }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-document.views.edit.breadcrumbs.my-documents') => route('my-group.show',['my_group' => $myGroup->id]),
        $myDocument->name => route('my-group.my-documents.show',[
            'my_group' => $myGroup->id,
            'my_document' => $myDocument->id
        ]),
        __('my-group-document.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-document.edit-form', ['myDocument' => $myDocument])
@stop

@section('app_scripts')

@stop
