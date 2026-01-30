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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-document.views.edit.breadcrumbs.my-documents') => route('my-profile.show',['my_profile' => $myProfile->id]),
        $myDocument->name => route('my-profile.my-documents.show',[
            'my_profile' => $myProfile->id,
            'my_document' => $myDocument->id
        ]),
        __('my-document.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-document.edit-form', ['myDocument' => $myDocument])
@stop

@section('app_scripts')

@stop
