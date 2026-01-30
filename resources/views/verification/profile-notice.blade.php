@extends('layouts.main')

@section('header_styles')

@stop

@section('title')
    {{ __('verification.views.profile-notice.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('verification.views.profile-notice.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('verification.views.profile-notice.breadcrumbs.home') => route('app.home'),
        __('verification.views.profile-notice.breadcrumbs.create-profile')
    ]])
@stop

@section('content')
    <div class="container woocommerce">
        @include('components.notifications')
        @auth
            @if (!Auth::user()->hasVerifiedProfile())
                <div class="woocommerce col-md-push-3_ col-md-12">
                    <form
                        action="{{ route('authentication.register.finalize') }}"
                        class="register"
                        method="post"
                    >
                        @csrf
                        <div class="form-row form-group user-role vendor-customer-registration margin-left-15">
                            <label>{{ __('verification.views.profile-notice.form.p.label.profile-type') }}</label>
                            @foreach ($profileTypes as $profileType)
                                <label class="radio">
                                    <input
                                        type="radio"
                                        name="type"
                                        id="type-{{ $profileType }}"
                                        value="{{ $profileType }}"
                                        required
                                        @if (old('type') == $profileType)
                                            checked
                                        @endif
                                    >
                                    {{ __('verification.views.profile-notice.form.p.label.'.$profileType) }}
                                </label>
                            @endforeach
                            @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        <div class="form-row col-md-12 margin-bottom-25">
                            <i class="sl sl-icon-star"></i> {!! __('verification.views.profile-notice.form.p.text') !!}
                        </div>
                        <div class="form-row profile-options col-md-4 profile-artist profile-curator">
                            <label for="artist_name">{{ __('verification.views.profile-notice.form.p.label.artist-name') }} <span class="required">*</span></label>
                            <input
                                type="text"
                                class="input-text form-control @if ($errors->has('artist_name')) invalid @endif"
                                name="artist_name"
                                id="artist_name"
                                value="{{ old('artist_name') }}"
                                autofocus>
                            @if ($errors->has('artist_name'))
                                <span class="text-danger">{{ $errors->first('artist_name') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-4 profile-artist">
                            <label for="other_artist_name">{{ __('verification.views.profile-notice.form.p.label.other-artist-name') }}</label>
                            <input
                                type="text"
                                class="input-text form-control @if ($errors->has('other_artist_name')) invalid @endif"
                                name="other_artist_name"
                                id="other_artist_name"
                                value="{{ old('other_artist_name') }}">
                            @if ($errors->has('other_artist_name'))
                                <span class="text-danger">{{ $errors->first('other_artist_name') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-4 profile-artist profile-curator profile-public-collector">
                            <label for="pronoun">{{ __('verification.views.profile-notice.form.p.label.pronoun') }}</label>
                            <input
                                type="text"
                                class="input-text form-control @if ($errors->has('pronoun')) invalid @endif"
                                name="pronoun"
                                id="pronoun"
                                value="{{ old('pronoun') }}">
                            @if ($errors->has('pronoun'))
                                <span class="text-danger">{{ $errors->first('pronoun') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-6 profile-artist profile-curator profile-public-collector">
                            <label for="first_name">{{ __('verification.views.profile-notice.form.p.label.first-name') }} <span class="required">*</span></label>
                            <input
                                type="text"
                                class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                                name="first_name"
                                id="first_name"
                                value="{{ $user->first_name }}"
                                readonly
                            >
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-6 profile-artist profile-curator profile-public-collector">
                            <label for="last_name">{{ __('verification.views.profile-notice.form.p.label.last-name') }} <span class="required">*</span></label>
                            <input
                                type="text"
                                class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                                name="last_name"
                                id="last_name"
                                value="{{ $user->last_name }}"
                                readonly
                            >
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-6 profile-artist profile-curator profile-public-collector">
                            <label for="address">{{ __('verification.views.profile-notice.form.p.label.address') }}</label>
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
                        <div class="form-row profile-options col-md-6 profile-artist profile-curator profile-public-collector">
                            <label for="city">{{ __('verification.views.profile-notice.form.p.label.city') }}</label>
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
                        <div class="form-row profile-options col-md-6 profile-artist profile-curator profile-public-collector">
                            <label for="country">{{ __('verification.views.profile-notice.form.p.label.country') }} <span class="required">*</span></label>
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
                        <div class="form-row profile-options col-md-6 profile-artist profile-curator profile-public-collector">
                            <label for="ethnicity">{{ __('verification.views.profile-notice.form.p.label.ethnicity') }}</label>
                            <input
                                type="text"
                                class="input-text form-control @if ($errors->has('ethnicity')) invalid @endif"
                                name="ethnicity"
                                id="ethnicity"
                                value="{{ old('ethnicity') }}">
                            @if ($errors->has('ethnicity'))
                                <span class="text-danger">{{ $errors->first('ethnicity') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-6 profile-artist profile-curator">
                            <label for="member_of">{{ __('verification.views.profile-notice.form.p.label.member-of') }}</label>
                            <input
                                type="text"
                                class="input-text form-control @if ($errors->has('member_of')) invalid @endif"
                                name="member_of"
                                id="member_of"
                                value="{{ old('member_of') }}">
                            @if ($errors->has('member_of'))
                                <span class="text-danger">{{ $errors->first('member_of') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-12 profile-artist profile-curator">
                            <label for="biography">{{ __('verification.views.profile-notice.form.p.label.biography') }} <span class="required">*</span></label>
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
                        <div class="form-row profile-options col-md-6 profile-artist">
                            <label for="artist_type">{{ __('verification.views.profile-notice.form.p.label.artist-type') }}</label>
                            <select
                                data-placeholder="{{ @old('artist_type') }}"
                                class="chosen-select @if ($errors->has('artist_type')) invalid @endif"
                                name="artist_type"
                                id="artist_type"
                            >
                                <option value=""></option>
                                @foreach ($artistTypes as $artistType)
                                    <option value="{{ $artistType }}"
                                    >{{ __('enums.artist-type.'.$artistType) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('artist_type'))
                                <span class="text-danger">{{ $errors->first('artist_type') }}</span>
                            @endif
                            <div class="specify_artist_type @if(@old('artist_type') != 'other') hidden @endif">
                                <label for="specify_artist_type">{{ __('verification.views.profile-notice.form.p.label.specify') }}</label>
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
                        <div class="form-row profile-options col-md-6 profile-artist">
                            <label for="art_practice_type">{{ __('verification.views.profile-notice.form.p.label.art-practice-type') }}</label>
                            <select
                                data-placeholder="{{ @old('art_practice_type') }}"
                                class="chosen-select @if ($errors->has('art_practice_type')) invalid @endif"
                                name="art_practice_type"
                                id="art_practice_type"
                            >
                                <option value=""></option>
                                @foreach ($artPracticeTypes as $artPracticeType)
                                    <option value="{{ $artPracticeType }}"
                                    >{{ __('enums.art-practice-type.'.$artPracticeType) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('art_practice_type'))
                                <span class="text-danger">{{ $errors->first('art_practice_type') }}</span>
                            @endif
                            <div class="specify_art_practice_type @if(@old('art_practice_type') != 'other') hidden @endif">
                                <label for="specify_art_practice_type">{{ __('verification.views.profile-notice.form.p.label.specify') }}</label>
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
                        <div class="form-row profile-options col-md-12 profile-artist profile-curator margin-top-15">
                            <p>{{ __('verification.views.profile-notice.form.p.label.additional-information-content') }}</p>
                        </div>
                        <div class="form-row profile-options col-md-6 profile-artist profile-curator">
                            <input
                                type="text"
                                class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                                name="additional_information_title"
                                id="additional_information_title"
                                value="{{ old('additional_information_title') }}"
                                placeholder="{{ __('verification.views.profile-notice.form.p.label.additional-information-title') }}"
                            >
                            @if ($errors->has('additional_information_title'))
                                <span class="text-danger">{{ $errors->first('additional_information_title') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-12 profile-artist profile-curator">
                            <textarea
                                cols="40"
                                rows="3"
                                id="additional_information_content"
                                name="additional_information_content"
                                placeholder=""></textarea>
                            @if ($errors->has('additional_information_content'))
                                <span class="text-danger">{{ $errors->first('additional_information_content') }}</span>
                            @endif
                        </div>
                        <div class="form-row profile-options col-md-7 profile-artist profile-curator profile-public-collector">
                            <label for="status">{{ __('my-artist-group.views.create.form.p.label.status') }}</label>
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
                                name="save"
                                value="{{ __('verification.views.profile-notice.form.p.button.create') }}">
                        </div>
                    </form>
                </div>
            @endif
        @endauth
    </div>
@endsection

@section('app_scripts')
<script type="text/javascript">
    $(function () {
        $('.profile-options').hide();
        if ($('input[name="type"]:checked').val()) {
            $('.profile-'+$('input[name="type"]').val()).show();
        }
        $('input[name="type"]').click(function(){
            $('.profile-options').hide();
            $('.profile-'+this.value).show();
        });
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
@endsection
