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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-website.views.edit.breadcrumbs.my-websites') => route('my-profile.my-website-groups.index',[
            'my_profile' => $myProfile->id
        ]),
        $myWebsiteGroup->title => route('my-profile.my-website-groups.show',[
            'my_profile' => $myProfile->id,
            'my_website_group' => $myWebsiteGroup->id
        ]),
        $myWebsite->title => route('my-profile.my-website-groups.my-websites.show',[
            'my_profile' => $myProfile->id,
            'my_website_group' => $myWebsiteGroup->id,
            'my_website' => $myWebsite->id
        ]),
        __('my-website.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-website-group.my-website.edit-form',['myWebsite' => $myWebsite])
@stop

@section('app_scripts')

@stop
