@extends('layouts.main')

@section('title')
    {{ __('my-curator-group.views.create.title.add-curator-group') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-curator-group.views.create.page-title.add-curator-group') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-curator-group.views.create.breadcrumbs.my-account') => route('my-account.index'),
        __('my-curator-group.views.create.breadcrumbs.add-curator-group')
    ]])
@stop

@section('content')
<div class="container woocommerce">
    @include('components.notifications')
    <div class="woocommerce col-md-12">
        <form
            action="{{ route('my-account.curator-group.store') }}"
            class="register"
            method="post"
        >
            @csrf
            <div class="form-row col-md-6">
                <label for="name">{{ __('my-curator-group.views.create.form.p.label.group-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('name')) invalid @endif"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    autofocus>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="address">{{ __('my-curator-group.views.create.form.p.label.address') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('address')) invalid @endif"
                    name="address"
                    id="address"
                    value="{{ old('address') }}">
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="city">{{ __('my-curator-group.views.create.form.p.label.city') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('city')) invalid @endif"
                    name="city"
                    id="city"
                    value="{{ old('city') }}">
                @if ($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="country">{{ __('my-curator-group.views.create.form.p.label.country') }} <span class="required">*</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('country')) invalid @endif"
                    name="country"
                    id="country"
                    value="{{ old('country') }}">
                @if ($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
            </div>
            <div class="form-row col-md-12">
                <label for="member_of">{{ __('my-curator-group.views.create.form.p.label.member-of') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('member_of')) invalid @endif"
                    name="member_of"
                    id="member_of"
                    value="{{ old('member_of') }}"
                >
                @if ($errors->has('member_of'))
                    <span class="text-danger">{{ $errors->first('member_of') }}</span>
                @endif
            </div>
            <div class="form-row col-md-12">
                <label for="biography">{{ __('my-curator-group.views.create.form.p.label.biography') }} <span class="required">*</label>
                <textarea
                    class="input-text form-control @if ($errors->has('biography')) invalid @endif"
                    cols="40"
                    rows="3"
                    id="biography"
                    name="biography"
                    placeholder=""></textarea>
                @if ($errors->has('biography'))
                    <span class="text-danger">{{ $errors->first('biography') }}</span>
                @endif
            </div>
            <div class="form-row col-md-12 margin-top-15">
                <p>{{ __('my-curator-group.views.create.form.p.label.additional-information-content') }}</p>
            </div>
            <div class="form-row col-md-6">
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                    name="additional_information_title"
                    id="additional_information_title"
                    value="{{ old('additional_information_title') }}"
                    placeholder="{{ __('my-curator-group.views.create.form.p.label.additional-information-title') }}"
                >
                @if ($errors->has('additional_information_title'))
                    <span class="text-danger">{{ $errors->first('additional_information_title') }}</span>
                @endif
            </div>
            <div class="form-row col-md-12">
                <textarea
                    cols="40"
                    rows="3"
                    id="additional_information_content"
                    name="additional_information_content"
                    placeholder=""
                >{{ old('additional_information_content') }}</textarea>
                @if ($errors->has('additional_information_content'))
                    <span class="text-danger">{{ $errors->first('additional_information_content') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="status">{{ __('my-curator-group.views.create.form.p.label.status') }}</label>
                <select
                    data-placeholder="{{ @old('status') }}"
                    class="chosen-select @if ($errors->has('status')) invalid @endif"
                    name="status"
                    id="status"
                >
                    @foreach ($statuses as $status)
                        <option
                            value="{{ $status }}"
                            @if (@old('status') && @old('status') == $status)
                                selected
                            @endif
                        >{{ __('enums.status.'.$status) }}</option>
                    @endforeach
                </select>
                @if ($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
            </div>
            <div class="form-row col-md-12">
                <input
                    type="hidden"
                    name="http_referer"
                    value="{{ old('http_referer') ?? request()->headers->get('referer') }}">
                <input
                    type="submit"
                    class="button"
                    name="create"
                    value="{{ __('my-curator-group.views.create.form.p.button.create') }}">
            </div>
        </form>
    </div>
</div>
@stop

@section('app_scripts')

@stop
