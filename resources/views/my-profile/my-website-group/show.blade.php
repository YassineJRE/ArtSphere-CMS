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
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-website-group.views.show.breadcrumbs.my-websites') => route('my-profile.my-website-groups.index',[
            'my_profile' => $myProfile->id
        ]),
        $myWebsiteGroup->title => route('my-profile.my-website-groups.show',[
            'my_profile' => $myProfile->id,
            'my_website_group' => $myWebsiteGroup->id
        ]),
    ]])
@stop

@section('content')
    @include('components.main-buttons', [
        'leftButtons' => [
            [
                'label' => __('my-website-group.views.show.content.back'),
                'link' => route('my-profile.my-website-groups.index',['my_profile' => $myProfile->id]),
                'icon' => 'arrow-left',
                'type' => 'outline'
            ]
        ],
        'rightButtons' => [
            ( $myWebsiteGroup->websites->count() > 0 ? [
                    'label' => __('my-website-group.views.show.span.add-website'),
                    'link' => route('my-profile.my-website-groups.my-websites.create',['my_profile' => $myProfile->id,'my_website_group' => $myWebsiteGroup->id]),
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

@section('external')

@stop

@section('app_scripts')

@stop
