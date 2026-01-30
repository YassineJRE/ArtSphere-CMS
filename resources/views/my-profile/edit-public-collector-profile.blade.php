@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ $profile->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $profile->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $profile->getName() => route('my-profile.show',['my_profile' => $profile->id]),
        __('my-profiles.views.curator.breadcrumbs.edit')
    ]])
@stop

@section('content')
<div class="container woocommerce">
    @include('components.notifications')
    <form
        action="{{ route('my-profile.update',['my_profile' => $profile->id ]) }}"
        class="register"
        method="post"
    >
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="form-row col-md-6">
            <label for="pronoun">{{ __('my-profiles.views.curator.form.p.label.pronoun') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('pronoun')) invalid @endif"
                name="pronoun"
                id="pronoun"
                value="{{ auth()->user()->pronoun }}"
                readonly
            >
            @if ($errors->has('pronoun'))
                <span class="text-danger">{{ $errors->first('pronoun') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="first_name">{{ __('my-profiles.views.curator.form.p.label.first-name') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                name="first_name"
                id="first_name"
                value="{{ auth()->user()->first_name }}"
                readonly
            >
            @if ($errors->has('first_name'))
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="last_name">{{ __('my-profiles.views.curator.form.p.label.last-name') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                name="last_name"
                id="last_name"
                value="{{ auth()->user()->last_name }}"
                readonly
            >
            @if ($errors->has('last_name'))
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
        <div class="form-row col-md-12">
            <label for="address">{{ __('my-profiles.views.curator.form.p.label.address') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('address')) invalid @endif"
                name="address"
                id="address"
                value="{{ auth()->user()->address }}"
                readonly
            >
            @if ($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="city">{{ __('my-profiles.views.curator.form.p.label.city') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('city')) invalid @endif"
                name="city"
                id="city"
                value="{{ auth()->user()->city }}"
                readonly
            >
            @if ($errors->has('city'))
                <span class="text-danger">{{ $errors->first('city') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="country">{{ __('my-profiles.views.curator.form.p.label.country') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('country')) invalid @endif"
                name="country"
                id="country"
                value="{{ auth()->user()->country }}"
                readonly
            >
            @if ($errors->has('country'))
                <span class="text-danger">{{ $errors->first('country') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="ethnicity">{{ __('my-profiles.views.curator.form.p.label.ethnicity') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('ethnicity')) invalid @endif"
                name="ethnicity"
                id="ethnicity"
                value="{{ auth()->user()->ethnicity }}"
                readonly
            >
            @if ($errors->has('ethnicity'))
                <span class="text-danger">{{ $errors->first('ethnicity') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="member_of">{{ __('my-profiles.views.curator.form.p.label.member-of') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('member_of')) invalid @endif"
                name="member_of"
                id="member_of"
                value="{{ old('member_of') ?? $profile->member_of }}"
            >
            @if ($errors->has('member_of'))
                <span class="text-danger">{{ $errors->first('member_of') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="status">{{ __('my-profiles.views.curator.form.p.label.status') }}</label>
            <select
                data-placeholder="{{ @old('status') }}"
                class="chosen-select @if ($errors->has('status')) invalid @endif"
                name="status"
                id="status"
            >
                @foreach ($statuses as $status)
                    <option
                        value="{{ $status }}"
                        @if (
                                (@old('status') && @old('status') == $status)
                                ||
                                ($profile->status == $status)
                        )
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
                type="submit"
                class="button"
                name="save"
                value="{{ __('my-profiles.views.curator.form.p.value.save') }}"
            >
        </div>
    </form>
</div>
@stop
