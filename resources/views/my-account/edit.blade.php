@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-account.views.edit.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-account.views.edit.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-account.views.edit.breadcrumbs.account') => route('my-account.index'),
        __('my-account.views.edit.breadcrumbs.edit-account')
    ]])
@stop

@section('content')
<div class="woocommerce-MyAccount-content">
    <div class="woocommerce col-md-12">
        @include('components.notifications')
        <form
            action="{{ route('my-account.update-details') }}"
            class="register"
            method="post"
            enctype="multipart/form-data"
        >
            <h3>{{ __('my-account.views.edit.form.h3.title') }}</h3>
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="form-row col-md-12 centered-content margin-bottom-20">
                <label for="media">{{ __('my-account.views.edit.form.p.label.avatar') }}</label>
                <div class="uploadzone">
                    <div class="uz-preview @if(!auth()->user()->getFirstMedia('avatar')) hidden @endif">
                        <div class="uz-image">
                            <img
                                src="{{ auth()->user()->getFirstMediaUrl('avatar') }}" alt="{{ auth()->user()->getName() }}"
                                alt="preview media"
                            >
                        </div>
                        <a class="uz-remove"
                            href="javascript:void(0);"
                            data-href="{{
                                auth()->user()->getFirstMedia('avatar') ?
                                    route('medias.destroy',['media' => auth()->user()->getFirstMedia('avatar')->id]) : ''
                            }}"
                        >{{ __('my-account.views.edit.form.button.remove-file') }}</a>
                    </div>
                    <a class="btn-file">
                        <i class="fa fa-upload"></i> {{ __('my-account.views.edit.form.p.label.choose-file') }}
                        <input
                            class="uz-input"
                            type="file"
                            name="avatar"
                            id="media"
                            accept=".jpg,.jpeg,.png"
                        >
                    </a>
                </div>
                @if ($errors->has('avatar'))
                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="pronoun">{{ __('my-account.views.edit.form.p.label.pronoun') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('pronoun')) invalid @endif"
                    name="pronoun"
                    id="pronoun"
                    value="{{ old('pronoun') ?? $user->pronoun }}">
                @if ($errors->has('pronoun'))
                    <span class="text-danger">{{ $errors->first('pronoun') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="email">{{ __('my-account.views.edit.form.p.label.email') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('email')) invalid @endif"
                    name="email"
                    id="email"
                    value="{{ $user->email }}"
                    readonly>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="first_name">{{ __('my-account.views.edit.form.p.label.first-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                    name="first_name"
                    id="first_name"
                    value="{{ old('first_name') ?? $user->first_name }}">
                @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="last_name">{{ __('my-account.views.edit.form.p.label.last-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                    name="last_name"
                    id="last_name"
                    value="{{ old('last_name') ?? $user->last_name }}">
                @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
            <div class="form-row col-md-12">
                <label for="address">{{ __('my-account.views.edit.form.p.label.address') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('address')) invalid @endif"
                    name="address"
                    id="address"
                    value="{{ old('address') ?? $user->address }}">
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="city">{{ __('my-account.views.edit.form.p.label.city') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('city')) invalid @endif"
                    name="city"
                    id="city"
                    value="{{ old('city') ?? $user->city }}">
                @if ($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="country">{{ __('my-account.views.edit.form.p.label.country') }} <span class="required">*</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('country')) invalid @endif"
                    name="country"
                    id="country"
                    value="{{ old('country') ?? $user->country }}">
                @if ($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="ethnicity">{{ __('my-account.views.edit.form.p.label.ethnicity') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('ethnicity')) invalid @endif"
                    name="ethnicity"
                    id="ethnicity"
                    value="{{ old('ethnicity') ?? $user->ethnicity }}">
                @if ($errors->has('ethnicity'))
                    <span class="text-danger">{{ $errors->first('ethnicity') }}</span>
                @endif
            </div>

            <div class="form-row col-md-12">
                <input
                    type="submit"
                    class="button"
                    name="save"
                    value="{{ __('my-account.views.edit.form.p.value.save-button') }}">
            </div>
        </form>
    </div>
</div>
@stop

@section('app_scripts')

@stop
