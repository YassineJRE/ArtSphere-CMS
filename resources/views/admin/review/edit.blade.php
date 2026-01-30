@extends('admin.layouts.default')

@section('title')
    {{ __('admin-review.views.edit.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-review.views.edit.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-review.views.edit.breadcrumbs.reviews') => route('admin.reviews.index'),
        (string)$review->id
    ]])
@stop

@section('content')
    <form method="post"
        action="{{ route('admin.reviews.update',['review' => $review]) }}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-review.views.edit.label.from') }}</label>
                    <input value="{{ $review->from }}"
                        class="input-text @if ($errors->has('from')) invalid @endif"
                        name="from"
                        type="text"  required>
                    @if ($errors->has('from'))
                        <span class="text-danger">{{ $errors->first('from') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-review.views.edit.label.to') }}</label>
                    <input value="{{ $review->to }}"
                        class="input-text @if ($errors->has('to')) invalid @endif"
                        name="to"
                        type="text"  required>
                    @if ($errors->has('to'))
                        <span class="text-danger">{{ $errors->first('to') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-review.views.edit.label.message') }}</label>
                    <input value="{{ $review->message }}"
                        class="input-text @if ($errors->has('message')) invalid @endif"
                        name="message"
                        type="text"  required>
                    @if ($errors->has('message'))
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-review.views.edit.label.is-positive') }}</label>
                    <input value="{{ $review->is_positive }}"
                        class="input-text @if ($errors->has('is_positive')) invalid @endif"
                        name="is_positive"
                        type="text"  required>
                    @if ($errors->has('is_positive'))
                        <span class="text-danger">{{ $errors->first('is_positive') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-review.views.edit.label.processed') }}</label>
                    <input value="{{ $review->processed }}"
                        class="input-text @if ($errors->has('processed')) invalid @endif"
                        name="processed"
                        type="text"  required>
                    @if ($errors->has('processed'))
                        <span class="text-danger">{{ $errors->first('processed') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-review.views.edit.label.is-sent') }}</label>
                    <input value="{{ $review->is_sent }}"
                        class="input-text @if ($errors->has('is_sent')) invalid @endif"
                        name="is_sent"
                        type="text"  required>
                    @if ($errors->has('is_sent'))
                        <span class="text-danger">{{ $errors->first('is_sent') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-review.views.edit.label.is-read') }}</label>
                    <input value="{{ $review->is_read }}"
                        class="input-text @if ($errors->has('is_read')) invalid @endif"
                        name="is_read"
                        type="text"  required>
                    @if ($errors->has('is_read'))
                        <span class="text-danger">{{ $errors->first('is_read') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-review.views.edit.label.status') }}</label>
                    <input value="{{ $review->status }}"
                        class="input-text @if ($errors->has('status')) invalid @endif"
                        name="status"
                        type="text"  required>
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>

            <button class="button margin-top-15">
                {{ __('admin-review.views.edit.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')

@stop
