@extends('admin.layouts.default')

@section('title')
    {{ __('admin-user-notification.views.create.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-user-notification.views.create.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-user-notification.views.create.breadcrumbs.user-notifications') => route('admin.user-notifications.index'),
        __('admin-user-notification.views.create.breadcrumbs.new-user-notification')
    ]])
@stop

@section('content')
    <form method="post"
        action="{{ route('admin.user-notifications.store') }}">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-user-notification.views.create.label.profile-id') }}</label>
                    <input value="{{ @old('profile_id') }}"
                        class="input-text @if ($errors->has('profile_id')) invalid @endif"
                        name="profile_id"
                        type="text" required>
                    @if ($errors->has('profile_id'))
                        <span class="text-danger">{{ $errors->first('profile_id') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user-notification.views.create.label.ad-id') }}</label>
                    <input value="{{ @old('ad_id') }}"
                        class="input-text @if ($errors->has('ad_id')) invalid @endif"
                        name="ad_id"
                        type="text" required>
                    @if ($errors->has('ad_id'))
                        <span class="text-danger">{{ $errors->first('ad_id') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-user-notification.views.create.label.comment-id') }}</label>
                    <input value="{{ @old('comment_id') }}"
                        class="input-text @if ($errors->has('comment_id')) invalid @endif"
                        name="comment_id"
                        type="text" required>
                    @if ($errors->has('comment_id'))
                        <span class="text-danger">{{ $errors->first('comment_id') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-user-notification.views.create.label.review-id') }}</label>
                    <input value="{{ @old('review_id') }}"
                        class="input-text @if ($errors->has('review_id')) invalid @endif"
                        name="review_id"
                        type="text" required>
                    @if ($errors->has('review_id'))
                        <span class="text-danger">{{ $errors->first('review_id') }}</span>
                    @endif
                </div>
            </div>

            <button class="button margin-top-15">
                {{ __('admin-user-notification.views.create.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')

@stop
