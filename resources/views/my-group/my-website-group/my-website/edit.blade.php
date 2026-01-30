@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ $myWebsite->title }}
    @parent
@endsection

@section('page-title')
    {{ $myWebsite->title }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-website.views.edit.breadcrumbs.my-website-group') => route('my-group.my-website-groups.index',[
            'my_group' => $myGroup->id
        ]),
        $myWebsiteGroup->title => route('my-group.my-website-groups.show',[
            'my_group' => $myGroup->id,
            'my_website_group' => $myWebsiteGroup->id
        ]),
        $myWebsite->title => route('my-group.my-website-groups.my-websites.show',[
            'my_group' => $myGroup->id,
            'my_website_group' => $myWebsiteGroup->id,
            'my_website' => $myWebsite->id
        ]),
        __('my-group-website.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-website-group.my-website.edit-form',['myWebsite' => $myWebsite])
@stop

@section('app_scripts')

@stop
