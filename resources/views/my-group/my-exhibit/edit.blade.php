@extends('layouts.main')

@section('title')
    {{ $myExhibit->name }}
    @parent
@endsection

@section('page-title')
    {{ $myExhibit->name }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-exhibit.views.edit.breadcrumbs.my-exhibits') => route('my-group.my-exhibits.index',[
            'my_group' => $myGroup->id
        ]),
        $myExhibit->name => route('my-group.my-exhibits.show',[
            'my_group' => $myGroup->id,
            'my_exhibit' => $myExhibit->id
        ]),
        __('my-group-exhibit.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-exhibit.edit-form', ['myExhibit' => $myExhibit])
@stop

@section('app_scripts')

@stop
