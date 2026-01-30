@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('my-artist-run-center-gallery.views.create.title.add-artist-center') }}
    @parent
@endsection

@section('page-title')
{{ __('my-artist-run-center-gallery.views.create.page-title.add-artist-center') }}
@stop

@section('breadcrumbs')
    @if ($myProfile->isArtist())
        @include('components.breadcrumbs', ['breadcrumbs' => [
            __('my-artist-run-center-gallery.views.create.breadcrumbs.my-account') => route('my-account.index'),
            $myProfile->getName() => route('my-account.artist-profile.show',['artist_profile' => $myProfile->id]),
            __('my-artist-run-center-gallery.views.create.breadcrumbs.add-artist-center')
        ]])
    @elseif ($myProfile->isCurator())
        @include('components.breadcrumbs', ['breadcrumbs' => [
            __('my-artist-run-center-gallery.views.create.breadcrumbs.my-account') => route('my-account.index'),
            $myProfile->getName() => route('my-account.curator-profile.show',['curator_profile' => $myProfile->id]),
            __('my-artist-run-center-gallery.views.create.breadcrumbs.add-artist-center')
        ]])
    @elseif ($myProfile->isPublicCollector())
        @include('components.breadcrumbs', ['breadcrumbs' => [
            __('my-artist-run-center-gallery.views.create.breadcrumbs.my-account') => route('my-account.index'),
            $myProfile->getFirstName() => route('my-account.public-collector-profile.show',['public_collector_profile' => $myProfile->id]),
            __('my-artist-run-center-gallery.views.create.breadcrumbs.add-artist-center')
        ]])
    @else
        @include('components.breadcrumbs', ['breadcrumbs' => [
            __('my-artist-run-center-gallery.views.create.breadcrumbs.my-account') => route('my-account.index'),
            __('my-artist-run-center-gallery.views.create.breadcrumbs.add-artist-center')
        ]])
    @endif
@stop

@section('content')
<div class="container woocommerce">
    @include('components.notifications')
    <div class="woocommerce col-md-12">
        <form
            action="{{ route('my-profile.my-artist-run-center-gallery.store',[
                'my_profile' => $myProfile->id
            ]) }}"
            class="register"
            method="post"
        >
            @csrf
            <div class="form-row col-md-6">
                <label for="name">{{ __('my-artist-run-center-gallery.views.create.form.p.label.name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('name')) invalid @endif"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                >
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="institution_type">{{ __('my-artist-run-center-gallery.views.create.form.p.label.institution-type') }}</label>
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
                                @old('institution_type') && @old('institution_type') == $institutionType
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
                <label for="address">{{ __('my-artist-run-center-gallery.views.create.form.p.label.address') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('address')) invalid @endif"
                    name="address"
                    id="address"
                    value="{{ old('address') }}"
                    required
                >
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="city">{{ __('my-artist-run-center-gallery.views.create.form.p.label.city') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('city')) invalid @endif"
                    name="city"
                    id="city"
                    value="{{ old('city') }}"
                    required
                >
                @if ($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="country">{{ __('my-artist-run-center-gallery.views.create.form.p.label.country') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('country')) invalid @endif"
                    name="country"
                    id="country"
                    value="{{ old('country') }}"
                    required
                >
                @if ($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="member_of">{{ __('my-artist-run-center-gallery.views.create.form.p.label.member-of') }}</label>
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
            <div class="form-row col-md-6">
                <label for="email">{{ __('my-artist-run-center-gallery.views.create.form.p.label.email') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('email')) invalid @endif"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                >
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="phone">{{ __('my-artist-run-center-gallery.views.create.form.p.label.phone') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('phone')) invalid @endif"
                    name="phone"
                    id="phone"
                    value="{{ old('phone') }}"
                >
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="form-row col-md-12">
                <label for="mandate">{{ __('my-artist-run-center-gallery.views.create.form.p.label.mandate') }} <span class="required">*</span></label>
                <textarea
                    cols="40"
                    rows="3"
                    id="mandate"
                    name="mandate"
                    placeholder=""
                    required
                >{{ old('mandate') }}</textarea>
                @if ($errors->has('mandate'))
                    <span class="text-danger">{{ $errors->first('mandate') }}</span>
                @endif
            </div>            
            <div class="form-row col-md-12 margin-top-15">
                <p>{{ __('my-artist-run-center-gallery.views.create.form.p.label.additional-information-content') }}</p>
            </div>
            <div class="form-row col-md-6">
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                    name="additional_information_title"
                    id="additional_information_title"
                    value="{{ old('additional_information_title') }}"
                    placeholder="{{ __('my-artist-run-center-gallery.views.create.form.p.label.additional-information-title') }}"
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
            <div class="form-row col-md-12">
                <input
                    type="hidden"
                    name="http_referer"
                    value="{{ old('http_referer') ?? request()->headers->get('referer') }}">
                <input
                    type="submit"
                    class="button"
                    name="create"
                    value="{{ __('my-artist-run-center-gallery.views.create.form.p.button.create') }}">
            </div>
        </form>
    </div>
</div>
@stop

@section('app_scripts')

@stop
