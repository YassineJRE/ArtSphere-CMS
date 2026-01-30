@extends('layouts.main')

@section('title')
    {{ __('my-group-website.views.create.title.add-website') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-group-website.views.create.page-title.add-website') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-website.views.create.breadcrumbs.my-websites') => route('my-group.my-website-groups.index',['my_group' => $myGroup->id]),
        $myWebsiteGroup->title => route('my-group.my-website-groups.show',[
            'my_group' => $myGroup->id,
            'my_website_group' => $myWebsiteGroup->id
        ]),
        __('my-group-website.views.create.breadcrumbs.add-website')
    ]])
@stop

@section('content')
    @include('components.notifications')

    @include('my-profile.my-website-group.my-website.create-form',['myWebsiteGroup' => $myWebsiteGroup])
@stop

@section('app_scripts')

@stop
