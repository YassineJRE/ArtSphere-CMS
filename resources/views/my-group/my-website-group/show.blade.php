@extends('layouts.main')

@section('header_styles')

@stop

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
        __('my-group-website-group.views.show.breadcrumbs.my-website-groups') => route('my-group.my-website-groups.index',[
            'my_group' => $myGroup->id
        ]),
        $myWebsiteGroup->title => route('my-group.my-website-groups.show',[
            'my_group' => $myGroup->id,
            'my_website_group' => $myWebsiteGroup->id
        ]),
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-group-website-group.views.show.content.back'),
                'link' => route('my-group.my-website-groups.index',['my_group' => $myGroup->id]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [
            ( (app('profile.session')->isAdministratorOfThisGroup($myGroup)) && $myWebsiteGroup->websites->count() > 0 ? [
                    'label' => __('my-group-website-group.views.show.span.add-website'),
                    'link' => route('my-group.my-website-groups.my-websites.create',['my_group' => $myGroup->id,'my_website_group' => $myWebsiteGroup->id]),
                    'icon' => 'plus'
                ] : []
            )
        ]
    ])

    @include('components.notifications')

    @include('my-profile.my-website-group.websites',['myWebsiteGroup' => $myWebsiteGroup])

    @include('my-profile.my-website-group.main-information',['myWebsiteGroup' => $myWebsiteGroup])    

    @include('my-profile.my-website-group.bottom-buttons',['myWebsiteGroup' => $myWebsiteGroup])
@stop

@section('app_scripts')

@stop
