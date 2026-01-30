@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ $group->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $group->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $group->getName() => route('my-group.show',['my_group' => $group->id]),
        __('my-artist-run-center-gallery.views.edit.breadcrumbs.edit')
    ]])
@stop

@section('content')
    <div class="container woocommerce">
        @include('components.notifications')
        <div class="woocommerce col-md-12">
            <form
                action="{{ route('my-group.update',['my_group' => $group->id ]) }}"
                class="register"
                method="post"
            >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row col-md-6">
                    <label for="name">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.name') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('name')) invalid @endif"
                        name="name"
                        id="name"
                        value="{{ $group->name ?? old('name') }}"
                        required
                        autofocus
                    >
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="institution_type">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.institution-type') }}</label>
                    <select
                        data-placeholder="{{ @old('institution_type') }}"
                        class="chosen-select @if ($errors->has('institution_type')) invalid @endif"
                        name="institution_type"
                        id="institution_type"
                    >
                        <option value=""></option>
                        @foreach ($institutionTypes as $institutionType)
                            <option
                                value="{{ $institutionType }}"
                                @if (
                                    (@old('institution_type') && @old('institution_type') == $institutionType)
                                    ||
                                    ($group->institution_type == $institutionType)
                                )
                                    selected
                                @endif
                            >{{ __('enums.institution-type.'.$institutionType) }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('institution_type'))
                        <span class="text-danger">{{ $errors->first('institution_type') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="address">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.address') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('address')) invalid @endif"
                        name="address"
                        id="address"
                        value="{{ old('address') ?? $group->address }}"
                    >
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="city">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.city') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('city')) invalid @endif"
                        name="city"
                        id="city"
                        value="{{ old('city') ?? $group->city }}"
                    >
                    @if ($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="country">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.country') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('country')) invalid @endif"
                        name="country"
                        id="country"
                        value="{{ old('country') ?? $group->country }}"
                        required
                    >
                    @if ($errors->has('country'))
                        <span class="text-danger">{{ $errors->first('country') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="member_of">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.member-of') }}</label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('member_of')) invalid @endif"
                        name="member_of"
                        id="member_of"
                        value="{{ old('member_of') ?? $group->member_of }}"
                    >
                    @if ($errors->has('member_of'))
                        <span class="text-danger">{{ $errors->first('member_of') }}</span>
                    @endif
                </div>
                @if ($group->isArtistRunCenterOrganisation())
                    <div class="form-row col-md-6">
                        <label for="email">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.email') }} <span class="required">*</span></label>
                        <input
                            type="text"
                            class="input-text form-control @if ($errors->has('email')) invalid @endif"
                            name="email"
                            id="email"
                            value="{{ old('email') ?? $group->email }}"
                        >
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-row col-md-6">
                        <label for="phone">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.phone') }} <span class="required">*</span></label>
                        <input
                            type="text"
                            class="input-text form-control @if ($errors->has('phone')) invalid @endif"
                            name="phone"
                            id="phone"
                            value="{{ old('phone') ?? $group->phone }}"
                        >
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-row col-md-12">
                        <label for="mandate">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.mandate') }} <span class="required">*</span></label>
                        <textarea
                            cols="40"
                            rows="3"
                            id="mandate"
                            name="mandate"
                            placeholder=""
                            required
                        >{{ old('mandate') ?? $group->mandate  }}</textarea>
                        @if ($errors->has('mandate'))
                            <span class="text-danger">{{ $errors->first('mandate') }}</span>
                        @endif
                    </div>
                @endif
                <div class="form-row col-md-12 margin-top-15">
                    <p>{{ __('my-artist-run-center-gallery.views.edit.form.p.label.additional-information-content') }}</p>
                </div>
                <div class="form-row col-md-6">
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                        name="additional_information_title"
                        id="additional_information_title"
                        value="{{ old('additional_information_title') ?? $group->additional_information_title }}"
                        placeholder="{{ __('my-artist-run-center-gallery.views.edit.form.p.label.additional-information-title') }}"
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
                    >{{ $group->additional_information_content ?? old('additional_information_content') }}</textarea>
                    @if ($errors->has('additional_information_content'))
                        <span class="text-danger">{{ $errors->first('additional_information_content') }}</span>
                    @endif
                </div>
                @if ($group->canChangeStatus())
                    <div class="form-row col-md-6">
                        <label for="status">{{ __('my-artist-run-center-gallery.views.edit.form.p.label.status') }}</label>
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
                                            ($group->status == $status)
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
                @endif
                <div class="form-row col-md-12">
                    <input
                        type="hidden"
                        name="http_referer"
                        value="{{ old('http_referer') ?? request()->headers->get('referer') }}">
                    <input
                        type="submit"
                        class="button"
                        name="save"
                        value="{{ __('my-artist-run-center-gallery.views.edit.form.p.button.save') }}">
                </div>
            </form>
        </div>
    </div>
@stop

@section('app_scripts')

@stop
