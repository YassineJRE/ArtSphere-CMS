@extends('admin.layouts.auth')

@section('title')
    {{ __('admin-login.views.index.title') }}
    @parent
@stop

@section('content')
    <div id="sign-in-dialog" class="zoom-anim-dialog">
        <div class="small-dialog-header">
            <h3>{{ __('admin-login.views.index.h3.sign-in') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            @include('admin.components.notifications')

            <div class="tabs-container alt">
                <form method="post"
                    class="login"
                    action="{{ route('admin.login.authenticate') }}">
                    <input type="hidden"
                        name="_token"
                        value="{{ csrf_token() }}">
                    <p class="form-row form-row-wide">
                        <label for="email">
                            {{ __('admin-login.views.index.p.label.email') }}
                            <i class="im im-icon-Mail"></i>
                            <input type="text"
                                    class="input-text @if ($errors->has('email')) invalid @endif"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}" required autofocus/>
                        </label>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password">{{ __('admin-login.views.index.p.label.password') }}
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
                    <p class="form-row">
                        <span class="lost_password">
                            <a href="{{ route('admin.password.request') }}" >{{ __('admin-login.views.index.p.span.link.lost-password') }}</a>
                        </span>
                    </p>
                    <div class="form-row">
                        <input type="submit" class="button border margin-top-5" name="login" value="{{ __('admin-login.views.index.button.log-in') }}" />
                        <div class="checkboxes margin-top-10">
                            <input id="remember-me" type="checkbox" name="check">
                            <label for="remember-me">{{ __('admin-login.views.index.label.remember-me') }}</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('app_scripts')

@stop
