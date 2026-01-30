@extends('layouts.main')

@section('title')
    {{ __('my-website.views.create.title.add-website') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-website.views.create.page-title.add-website') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-website.views.create.breadcrumbs.my-websites') => route('my-profile.my-website-groups.index',['my_profile' => $myProfile->id]),
        $myWebsiteGroup->title => route('my-profile.my-website-groups.show',[
            'my_profile' => $myProfile->id,
            'my_website_group' => $myWebsiteGroup->id
        ]),
        __('my-website.views.create.breadcrumbs.add-website')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-website-group.my-website.create-form',['myWebsiteGroup' => $myWebsiteGroup])
@stop

@section('app_scripts')

@stop
