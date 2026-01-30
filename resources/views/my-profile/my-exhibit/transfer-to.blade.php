@extends('layouts.main')

@section('title')
    {{ __('my-exhibit.views.transfer-to.title.transfer-to-artist') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-exhibit.views.transfer-to.page-title.transfer-to-artist') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        __('my-exhibit.views.show.breadcrumbs.my-exhibits') => route('my-profile.my-exhibits.index',[
            'my_profile' => $myProfile->id
        ]),
        $myExhibit->name => route('my-profile.my-exhibits.show',[
            'my_profile' => $myProfile->id,
            'my_exhibit' => $myExhibit->id
        ]),
        __('my-exhibit.views.transfer-to.breadcrumbs.transfer-to-artist')
    ]])
@stop

@section('content')
<div class="container woocommerce">
    @include('components.notifications')
    <div class="woocommerce col-md-12 border-bottom">
        <form
            action="{{ route('my-profile.my-exhibits.post.transfer-to',[
                'my_profile' => $myProfile->id,
                'my_exhibit' => $myExhibit->id
            ]) }}"
            class="register"
            method="post"
        >
            @csrf
            <p class="form-row col-md-12">
                <label for="user_profile_id">{{ __('my-exhibit.views.transfer-to.form.p.label.profile') }} <span class="required">*</span></label>
                <select
                    data-placeholder="{{ @old('user_profile_id') }}"
                    class="chosen-select @if ($errors->has('user_profile_id')) _invalid @endif"
                    name="user_profile_id"
                    id="user_profile_id"
                >
                    <option value=""></option>
                    @foreach ($profiles as $profile)
                        <option
                            value="{{ $profile->id }}"
                            @if (@old('user_profile_id') && @old('user_profile_id') == $profile->id)
                                selected
                            @endif
                        >{{ $profile->getLongName() }}</option>
                    @endforeach
                </select>
                @if ($errors->has('user_profile_id'))
                    <span class="text-danger">{{ $errors->first('user_profile_id') }}</span>
                @endif
            </p>
            <p class="form-row col-md-12">
                <input
                    type="submit"
                    class="button"
                    name="transfer"
                    value="{{ __('my-exhibit.views.transfer-to.form.p.button.transfer') }}"
                >
            </p>
            <p class="form-row col-md-12">
                {{ __('my-exhibit.views.transfer-to.form.p.label.text-invite') }}
            </p>
        </form>
    </div>
    <div class="woocommerce col-md-12 margin-top-10">
        <h2>{{ __('my-exhibit.views.transfer-to.h2.invite') }}</h2>
        <form
            action="{{ route('my-profile.my-exhibits.process-invite',[
                'my_profile' => $myProfile->id, 
                'my_exhibit' => $myExhibit->id
            ]) }}"
            class="register"
            method="post"
        >
            @csrf
            <p class="form-row col-md-3">
                <label for="first_name">{{ __('my-exhibit.views.transfer-to.form.p.label.first-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                    name="first_name"
                    id="first_name"
                    required
                >
                @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </p>
            <p class="form-row col-md-3">
                <label for="last_name">{{ __('my-exhibit.views.transfer-to.form.p.label.last-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                    name="last_name"
                    id="last_name"
                    required
                >
                @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </p>
            <p class="form-row col-md-4">
                <label for="email">{{ __('my-exhibit.views.transfer-to.form.p.label.email') }} <span class="required">*</span></label>
                <input
                    type="email"
                    class="input-text form-control @if ($errors->has('email')) invalid @endif"
                    name="email"
                    id="email"
                    required
                >
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </p>
            <div class="form-row col-md-2">
                <label>{{ __('my-exhibit.views.transfer-to.form.label.send-copy') }}</label>
                <div class="checkboxes in-row margin-top-20 margin-left-50">
                    <input
                        type="checkbox"
                        class="form-control checkbox @if ($errors->has('send_copy')) invalid @endif"
                        name="send_copy"
                        id="send-me-copy"
                        value="1"
                    >
                    <label for="send-me-copy"></label>
                </div>
                @if ($errors->has('send_copy'))
                    <div class="col-md-12">
                        <span class="text-danger">{{ $errors->first('send_copy') }}</span>
                    </div>
                @endif
            </div>
            <p class="form-row col-md-12">
                <input
                    type="submit"
                    class="button"
                    name="send"
                    value="{{ __('my-exhibit.views.transfer-to.form.p.button.send') }}"
                >
            </p>
        </form>
        <div id="invite-preview" class="form-row col-md-12">
            <h3>{{ __('my-exhibit.views.transfer-to.h3.invite-preview') }}</h3>
            <p>{{ __('my-exhibit.views.transfer-to.p.hi') }} <span id="invite-preview-name"></span>,</p>
            <p>{{ auth()->user()->getName() }} {{ __('my-exhibit.views.transfer-to.p.text') }}</p>
            <p>{{ __('my-exhibit.views.transfer-to.p.thank') }}</p>
            Jean-Denis Boudreau<br>
            {{ __('my-exhibit.views.transfer-to.p.artolog') }}<br>
        </div>
    </div>
</div>
@stop

@section('app_scripts')
<script type="text/javascript">
    $(document).ready(function (e) {
        showInvitePreview();
        $('#first_name, #last_name').bind("change keyup input", function() {
            showInvitePreview();
        });
    });
    function showInvitePreview() {
        $("#invite-preview").hide();
        var firstName = $('#first_name').val();
        if (firstName !='') {
            $('#invite-preview-name').html(firstName);
            $("#invite-preview").show();
        }
    }
</script>
@stop
