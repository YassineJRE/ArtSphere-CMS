@extends('layouts.main')

@section('title')
    {{ $member->profile->artist_name }}
    @parent
@endsection

@section('page-title')
    {{ $member->profile->artist_name }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-member.views.edit.breadcrumbs.members') => route('my-group.members.index',['my_group' => $myGroup->id]),
        $member->profile->artist_name => route('my-group.members.show',[
            'my_group' => $myGroup->id,
            'member' => $member->id
        ]),
        __('my-group-member.views.edit.breadcrumbs.to-edit')
    ]])
@stop

@section('content')
    <div class="container woocommerce">
        @include('components.notifications')
        <div class="woocommerce col-md-12">
            <form
                action="{{ route('my-group.members.update',[
                    'my_group' => $myGroup->id,
                    'member' => $member->id
                ]) }}"
                class="register"
                method="post"
            >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <p class="form-row col-md-6">
                    <label for="role">{{ __('my-group-member.views.edit.form.p.label.role') }} <span class="required">*</span></label>
                    <select
                        data-placeholder="{{ @old('role') }}"
                        class="chosen-select @if ($errors->has('role')) _invalid @endif"
                        name="role"
                        id="role"
                    >
                        @foreach ($memberTypes as $memberType)
                            <option
                                value="{{ $memberType }}"
                                @if (
                                    ($member->role == $memberType)
                                    ||
                                    (@old('role') && @old('role') == $memberType)
                                )
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
                        value="{{ __('my-group-member.views.edit.form.p.button.save') }}"
                    >
                </p>
            </form>
        </div>
    </div>
@stop

@section('app_scripts')

@stop
