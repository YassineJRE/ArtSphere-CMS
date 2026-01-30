@extends('layouts.main')

@section('title')
    {{ __('my-group-member.views.create.title.add-member') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-group-member.views.create.page-title.add-member') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-member.views.create.breadcrumbs.members') => route('my-group.members.index',['my_group' => $myGroup->id]),
        __('my-group-member.views.create.breadcrumbs.add-member')
    ]])
@stop

@section('content')
<div class="container woocommerce">
    @include('components.notifications')
    <div class="woocommerce col-md-12 border-bottom">
        <form
            action="{{ route('my-group.members.store',['my_group' => $myGroup->id]) }}"
            class="register"
            method="post"
        >
            @csrf
            <p class="form-row col-md-6">
                <label for="user_profile_id">{{ __('my-group-member.views.create.form.p.label.profile') }} <span class="required">*</span></label>
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
            <p class="form-row col-md-6">
                <label for="role">{{ __('my-group-member.views.create.form.p.label.role') }} <span class="required">*</span></label>
                <select
                    data-placeholder="{{ @old('role') }}"
                    class="chosen-select @if ($errors->has('role')) _invalid @endif"
                    name="role"
                    id="role"
                >
                    <option value=""></option>
                    @foreach ($memberTypes as $memberType)
                        <option
                            value="{{ $memberType }}"
                            @if (@old('role') && @old('role') == $memberType)
                                selected
                            @endif
                        >{{ __('enums.member-type.'.$memberType) }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role'))
                    <span class="text-danger">{{ $errors->first('role') }}</span>
                @endif
            </p>
            <p class="form-row col-md-12">
                <input
                    type="submit"
                    class="button"
                    name="save"
                    value="{{ __('my-group-member.views.create.form.p.button.add') }}"
                >
            </p>
            <p class="form-row col-md-12">
                {{ __('my-group-member.views.create.form.p.invitation-text') }}
            </p>
        </form>
    </div>
    <div class="woocommerce col-md-12 margin-top-10">
        <h2>{{ __('my-group-member.views.create.h2.invite') }}</h2>
        <form
            action="{{ route('my-group.members.process-invite',['my_group' => $myGroup->id]) }}"
            class="register"
            method="post"
        >
            @csrf
            <p class="form-row col-md-3">
                <label for="first_name">{{ __('my-group-member.views.create.form.p.label.first-name') }} <span class="required">*</span></label>
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
                <label for="last_name">{{ __('my-group-member.views.create.form.p.label.last-name') }} <span class="required">*</span></label>
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
                <label for="email">{{ __('my-group-member.views.create.form.p.label.email') }} <span class="required">*</span></label>
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
                <label>{{ __('my-group-member.views.create.form.label.send-copy') }}</label>
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
                    value="{{ __('my-group-member.views.create.form.p.button.send') }}"
                >
            </p>
        </form>
        <div id="invite-preview" class="form-row col-md-12">
            <h3>{{ __('my-group-member.views.create.h3.invite-preview') }}</h3>
            <p>{{ __('my-group-member.views.create.p.hello') }} <span id="invite-preview-name"></span>,</p>
            <p>{{ __('my-group-member.views.create.p.text',[
                'inviter' => auth()->user()->getName(),
                'group_name' => $myGroup->name
            ]) }}</p>
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
