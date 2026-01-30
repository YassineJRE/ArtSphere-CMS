@extends('admin.layouts.default')

@section('title')
    {{ $user->first_name }} {{ $user->last_name }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-user.views.show.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-user.views.show.breadcrumbs.users') => route('admin.users.index'),
        $user->first_name
    ]])
@stop

@section('content')

<div class="col-lg-9 col-md-12">
    <div class="dashboard-list-box margin-top-0">
        <h4 class="gray">
            {{ __('admin-user.views.show.h4.profile-details') }}

            @can(PrivilegeAdmin::WEB_USER_UPDATE)
                <div class="pull-right">
                    <a href="{{ route('admin.users.edit',['user' => $user]) }}" class="button">
                        <i class="sl sl-icon-note"></i>
                        {{ __('admin-user.views.show.button.edit') }}
                    </a>
                </div>
            @endcan
        </h4>
        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.show.label.first-name') }}</label>
                    <strong>{{ $user->first_name }}</strong>
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.show.label.last-name') }}</label>
                    <strong>{{ $user->last_name }}</strong>
                </div>
            </div>
            <div class="row margin-top-25">
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.show.label.email') }}</label>
                    <strong>{{ $user->email }}</strong>
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.show.label.username') }}</label>
                    <strong>{{ $user->username }}</strong>
                </div>
            </div>

            <div class="row margin-top-25">
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.show.label.registered-at') }}</label>
                    <strong>{{ \Carbon\Carbon::parse($user->created_at)->isoFormat('Do MMMM YYYY, H:mm') }}</strong>
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user.views.show.label.last-updated') }}</label>
                    <strong>{{ \Carbon\Carbon::parse($user->updated_at)->isoFormat('Do MMMM YYYY, H:mm') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-12">
    <div class="dashboard-list-box margin-top-0">
        <h4 class="gray">{{ __('admin-user.views.show.h4.roles') }}</h4>
        <div class="dashboard-list-box-static">
            <div class="row">
                @can(PrivilegeAdmin::WEB_ROLE_READ)
                    @foreach ($user->roles as $role)
                        <a href="{{ route('admin.roles.show',['role' => $role]) }}"
                            class="button border"
                        >{{ $role->name }}</a>
                    @endforeach
                @else
                    @foreach ($user->roles as $role)
                        {{ $role->name }}
                    @endforeach
                @endcan
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12">
    <div class="dashboard-list-box with-icons margin-top-20">
        <h4 class="gray">{{ __('admin-user.views.show.h4.recent-activities') }}</h4>
        <ul>
            @isset($user->actions)
                @foreach ($user->actions()->latest()->take(25)->get() as $activity)
                    @includeIf('admin::components.activities.'.$activity->event, [
                        'activity' => $activity
                    ])
                @endforeach
            @endisset
        </ul>
    </div>
</div>
@stop

@section('app_scripts')
<script type="text/javascript">
    $(function () {
        $('.popup-show-info').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });
    });
</script>
@stop
