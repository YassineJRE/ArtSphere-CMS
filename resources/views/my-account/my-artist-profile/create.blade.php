@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('my-artist-profile.views.create.title.create-artist-profile') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-artist-profile.views.create.page-title.create-artist-profile') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-artist-profile.views.create.breadcrumbs.account') => route('my-account.index'),
        __('my-artist-profile.views.create.breadcrumbs.create-artist-profile')
    ]])
@stop

@section('content')
<div class="container woocommerce">
    @include('components.notifications')
    <form
        action="{{ route('my-account.artist-profile.store') }}"
        class="register"
        method="post"
    >
        @csrf
        <div class="form-row col-md-6">
            <label for="artist_name">{{ __('my-artist-profile.views.create.form.p.label.artist-name') }} <span class="required">*</span></label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('artist_name')) invalid @endif"
                name="artist_name"
                id="artist_name"
                value="{{ old('artist_name') }}"
                required
            >
            @if ($errors->has('artist_name'))
                <span class="text-danger">{{ $errors->first('artist_name') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="other_artist_name">{{ __('my-artist-profile.views.create.form.p.label.other-artist-name') }}</label>
            <input
                type="text"
                class="input-text form-control @if ($errors->has('other_artist_name')) invalid @endif"
                name="other_artist_name"
                id="other_artist_name"
                value="{{ old('other_artist_name') }}"
            >
            @if ($errors->has('other_artist_name'))
                <span class="text-danger">{{ $errors->first('other_artist_name') }}</span>
            @endif
        </div>
        <div class="form-row col-md-4">
            <label for="pronoun">{{ __('my-artist-profile.views.create.form.p.label.pronoun') }}</label>
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
        <div class="form-row col-md-4">
            <label for="first_name">{{ __('my-artist-profile.views.create.form.p.label.first-name') }}</label>
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
        <div class="form-row col-md-4">
            <label for="last_name">{{ __('my-artist-profile.views.create.form.p.label.last-name') }}</label>
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
            <label for="address">{{ __('my-artist-profile.views.create.form.p.label.address') }}</label>
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
            <label for="city">{{ __('my-artist-profile.views.create.form.p.label.city') }}</label>
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
            <label for="country">{{ __('my-artist-profile.views.create.form.p.label.country') }}</label>
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
            <label for="ethnicity">{{ __('my-artist-profile.views.create.form.p.label.ethnicity') }}</label>
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
            <label for="member_of">{{ __('my-artist-profile.views.create.form.p.label.member-of') }}</label>
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
            <label for="biography">{{ __('my-artist-profile.views.create.form.p.label.biography') }} <span class="required">*</span></label>
            <textarea
                class="input-text form-control @if ($errors->has('biography')) invalid @endif"
                cols="40"
                rows="3"
                id="biography"
                name="biography"
                placeholder=""
            >{{ old('biography') }}</textarea>
            @if ($errors->has('biography'))
                <span class="text-danger">{{ $errors->first('biography') }}</span>
            @endif
        </div>
        <div class="form-row col-md-6">
            <label for="artist_type">{{ __('my-artist-profile.views.create.form.p.label.artist-type') }}</label>
            <select
                data-placeholder="{{ @old('artist_type') }}"
                class="chosen-select @if ($errors->has('artist_type')) invalid @endif"
                name="artist_type"
                id="artist_type"
            >
                <option value=""></option>
                @foreach ($artistTypes as $artistType)
                    <option
                        value="{{ $artistType }}"
                        @if (@old('artist_type') && @old('artist_type') == $artistType)
                            selected
                        @endif
                    >{{ __('enums.artist-type.'.$artistType) }}</option>
                @endforeach
            </select>
            @if ($errors->has('artist_type'))
                <span class="text-danger">{{ $errors->first('artist_type') }}</span>
            @endif
            <div class="specify_artist_type @if(@old('artist_type') != 'other') hidden @endif">
                <label for="specify_artist_type">{{ __('my-artist-profile.views.create.form.p.label.specify') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('specify_artist_type')) invalid @endif"
                    name="specify_artist_type"
                    id="specify_artist_type"
                    value="{{ old('specify_artist_type') }}"
                >
                @if ($errors->has('specify_artist_type'))
                    <span class="text-danger">{{ $errors->first('specify_artist_type') }}</span>
                @endif
            </div>
        </div>
        <div class="form-row col-md-6">
            <label for="art_practice_type">{{ __('my-artist-profile.views.create.form.p.label.art-practice-type') }}</label>
            <select
                data-placeholder="{{ @old('art_practice_type') }}"
                class="chosen-select @if ($errors->has('art_practice_type')) invalid @endif"
                name="art_practice_type"
                id="art_practice_type"
            >
                <option value=""></option>
                @foreach ($artPracticeTypes as $artPracticeType)
                    <option
                        value="{{ $artPracticeType }}"
                        @if (@old('art_practice_type') && @old('art_practice_type') == $artPracticeType)
                            selected
                        @endif
                    >{{ __('enums.art-practice-type.'.$artPracticeType) }}</option>
                @endforeach
            </select>
            @if ($errors->has('art_practice_type'))
                <span class="text-danger">{{ $errors->first('art_practice_type') }}</span>
            @endif
            <div class="specify_art_practice_type @if(@old('art_practice_type') != 'other') hidden @endif">
                <label for="specify_art_practice_type">{{ __('my-artist-profile.views.create.form.p.label.specify') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('specify_art_practice_type')) invalid @endif"
                    name="specify_art_practice_type"
                    id="specify_art_practice_type"
                    value="{{ old('specify_art_practice_type') }}"
                >
                @if ($errors->has('specify_art_practice_type'))
                    <span class="text-danger">{{ $errors->first('specify_art_practice_type') }}</span>
                @endif
            </div>
        </div>
        <div class="form-row col-md-12 margin-top-15">
            <p>{{ __('my-artist-profile.views.create.form.p.label.additional-information-content') }}</p>
        </div>
        <div class="form-row col-md-6">
            <input
                type="text"
                class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                name="additional_information_title"
                id="additional_information_title"
                value="{{ old('additional_information_title') }}"
                placeholder="{{ __('my-artist-profile.views.create.form.p.label.additional-information-title') }}"
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
            <label for="status">{{ __('my-artist-profile.views.create.form.p.label.status') }}</label>
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
                type="submit"
                class="button"
                name="create"
                value="{{ __('my-artist-profile.views.create.form.p.value.create') }}"
            >
        </div>
    </form>
</div>
@stop

@section('app_scripts')
<script type="text/javascript">
    $(function () {
        $('#art_practice_type').change(function(){
            if (this.value == 'other') {
                $('div.specify_art_practice_type').removeClass('hidden');
            } else {
                $('div.specify_art_practice_type').addClass('hidden');
            }
        });
        $('#artist_type').change(function(){
            if (this.value == 'other') {
                $('div.specify_artist_type').removeClass('hidden');
            } else {
                $('div.specify_artist_type').addClass('hidden');
            }
        });
    });
</script>
@stop
