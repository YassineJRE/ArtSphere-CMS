@extends('admin.layouts.auth')

@section('title')
    {{ __('admin-password.views.request.title') }}
    @parent
@stop

@section('content')
    <div id="sign-in-dialog" class="zoom-anim-dialog">
        <div class="small-dialog-header">
            <h3>{{ __('admin-password.views.request.h3.forgot-password') }}</h3>
        </div>
        <div class="sign-in-form style-1">
            @include('admin.components.notifications')

            <div class="tabs-container alt">
                <form method="post"
                    class="login"
                    action="{{ route('admin.password.email') }}">
                    <input type="hidden"
                        name="_token"
                        value="{{ csrf_token() }}">
                    <p class="form-row form-row-wide">
                        <label for="email">{{ __('admin-password.views.request.form.p.label.email') }}
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
                    <p class="form-row">
                        <input type="submit"
                            class="button border margin-top-5"
                            name="login"
                            value="{{ __('admin-password.views.request.form.button.reset-password') }}" />
                    </p>
                    <p class="form-row">
                        <span class="lost_password">
                            <a href="{{ route('admin.login') }}" >{{ __('admin-password.views.request.form.p.span.link.return') }}</a>
                        </span>
                    </p>
                </form>
            </div>
        </div>
    </div>
@stop

@section('app_scripts')

@stop
