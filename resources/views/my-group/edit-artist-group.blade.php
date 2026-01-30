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
        __('my-artist-group.views.edit.breadcrumbs.edit')
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
                <label for="name">{{ __('my-artist-group.views.edit.form.p.label.group-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('name')) invalid @endif"
                    name="name"
                    id="name"
                    value="{{ $group->name ?? old('name') }}"
                    autofocus>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="address">{{ __('my-artist-group.views.edit.form.p.label.address') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('address')) invalid @endif"
                    name="address"
                    id="address"
                    value="{{ old('address') ?? $group->address }}">
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="city">{{ __('my-artist-group.views.edit.form.p.label.city') }}</label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('city')) invalid @endif"
                    name="city"
                    id="city"
                    value="{{ old('city') ?? $group->city }}">
                @if ($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="country">{{ __('my-artist-group.views.edit.form.p.label.country') }} <span class="required">*</label>
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
                <label for="member_of">{{ __('my-artist-group.views.edit.form.p.label.member-of') }}</label>
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
            <div class="form-row col-md-12">
                <label for="biography">{{ __('my-artist-group.views.edit.form.p.label.biography') }}<span class="required">*</span></label>
                <textarea
                    class="input-text form-control @if ($errors->has('biography')) invalid @endif"
                    cols="40"
                    rows="3"
                    id="biography"
                    name="biography"
                    placeholder="">{{ $group->biography ?? old('biography') }}</textarea>
                @if ($errors->has('biography'))
                    <span class="text-danger">{{ $errors->first('biography') }}</span>
                @endif
            </div>
            <div class="form-row col-md-12 margin-top-15">
                <p>{{ __('my-artist-group.views.edit.form.p.label.additional-information-content') }}</p>
            </div>
            <div class="form-row col-md-6">
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                    name="additional_information_title"
                    id="additional_information_title"
                    value="{{ old('additional_information_title') ?? $group->additional_information_title }}"
                    placeholder="{{ __('my-artist-group.views.edit.form.p.label.additional-information-title') }}"
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
                >{{ $group->additional_information_content ?? old('additional_information_content') }}</textarea>
                @if ($errors->has('additional_information_content'))
                    <span class="text-danger">{{ $errors->first('additional_information_content') }}</span>
                @endif
            </div>
            <div class="form-row col-md-6">
                <label for="art_practice_type">{{ __('my-artist-group.views.edit.form.p.label.art-practice-type') }}</label>
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
                            @if (
                                ($group->art_practice_type == $artPracticeType)
                                ||
                                (@old('art_practice_type') && @old('art_practice_type') == $artPracticeType)
                            )
                                selected
                            @endif
                        >{{ __('enums.art-practice-type.'.$artPracticeType) }}</option>
                    @endforeach
                </select>
                @if ($errors->has('art_practice_type'))
                    <span class="text-danger">{{ $errors->first('art_practice_type') }}</span>
                @endif
                <div class="specify_art_practice_type
                    @if (
                        !(
                            $group->art_practice_type == 'other'
                            ||
                            (@old('art_practice_type') && @old('art_practice_type') == 'other')
                        )
                    ) hidden @endif"
                >
                    <label for="specify_art_practice_type">{{ __('my-artist-group.views.edit.form.p.label.specify') }}</label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('specify_art_practice_type')) invalid @endif"
                        name="specify_art_practice_type"
                        id="specify_art_practice_type"
                        value="{{ old('specify_art_practice_type') ?? $group->specify_art_practice_type }}"
                    >
                    @if ($errors->has('specify_art_practice_type'))
                        <span class="text-danger">{{ $errors->first('specify_art_practice_type') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-row col-md-6">
                <label for="status">{{ __('my-artist-group.views.edit.form.p.label.status') }}</label>
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
            <div class="form-row col-md-12">
                <input
                    type="hidden"
                    name="http_referer"
                    value="{{ old('http_referer') ?? request()->headers->get('referer') }}">
                <input
                    type="submit"
                    class="button"
                    name="save"
                    value="{{ __('my-artist-group.views.edit.form.p.button.save') }}">
            </div>
        </form>
    </div>
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
    });
</script>
@stop
