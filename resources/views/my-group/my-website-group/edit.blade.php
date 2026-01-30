@extends('layouts.main')

@section('title')
    {{ $myWebsiteGroup->title }}
    @parent
@endsection

@section('page-title')
    {{ $myWebsiteGroup->title }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-website-group.views.edit.breadcrumbs.my-website-group') => route('my-group.my-website-groups.index',[
            'my_group' => $myGroup->id
        ]),
        $myWebsiteGroup->title => route('my-group.my-website-groups.show',[
            'my_group' => $myGroup->id,
            'my_website_group' => $myWebsiteGroup->id
        ]),
        __('my-group-website-group.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-website-group.edit-form',['myWebsiteGroup' => $myWebsiteGroup])
@stop

@section('app_scripts')

@stop

