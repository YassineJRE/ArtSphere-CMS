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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-exhibit.views.edit.breadcrumbs.my-exhibits') => route('my-profile.my-exhibits.index',[
            'my_profile' => $myProfile->id
        ]),
        $myExhibit->name => route('my-profile.my-exhibits.show',[
            'my_profile' => $myProfile->id,
            'my_exhibit' => $myExhibit->id
        ]),
        __('my-exhibit.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-exhibit.edit-form', ['myExhibit' => $myExhibit])
@stop

@section('app_scripts')

@stop
