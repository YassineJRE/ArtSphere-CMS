@extends('admin.layouts.auth')

@section('title')
    {{ __('admin-register.views.finalize.title') }}
    @parent
@stop

@section('content')
    <div id="sign-in-dialog" class="zoom-anim-dialog">
        <div class="small-dialog-header">
            <h3>{{ __('admin-register.views.finalize.h3.register') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            @include('admin.components.notifications')

            <div class="tabs-container alt">
                <form method="post"
                    class="login"
                    action="{{ route('admin.register.password') }}">
                    <input type="hidden"
                        name="_token"
                        value="{{ csrf_token() }}">
                    <input type="hidden"
                        name="token"
                        value="{{ $token }}">
                    <p class="form-row form-row-wide">
                        <label for="email">{{ __('admin-register.views.finalize.form.p.label.email') }}
                            <i class="im im-icon-Mail"></i>
                            <input class="input-text @if ($errors->has('email')) invalid @endif"
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ $email }}" required/>
                        </label>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password">{{ __('admin-register.views.finalize.form.p.label.password') }}
                            <i class="im im-icon-Lock-2"></i>
                            <input class="input-text @if ($errors->has('password')) invalid @endif"
                                    type="password"
                                    name="password"
                                    id="password"
                                    value="{{ old('password') }}" required/>
                        </label>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password">{{ __('admin-register.views.finalize.form.p.label.confirm') }}
                            <i class="im im-icon-Lock-2"></i>
                            <input class="input-text @if ($errors->has('password_confirmation')) invalid @endif"
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    value="{{ old('password_confirmation') }}" required/>
                        </label>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </p>
                    <div class="form-row">
                        <input type="submit"
                            class="button border margin-top-5"
                            name="login"
                            value="{{ __('admin-register.views.finalize.form.button.finalize-registration') }}" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('app_scripts')

@stop
