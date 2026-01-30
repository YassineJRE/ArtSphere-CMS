<header id="header-container" class="fixed fullwidth dashboard">
    <div id="header" class="not-sticky">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('img/logos/logoIconGreyOutlined.svg') }}" alt="">
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="dashboard-logo">
                        <img src="{{ asset('img/logos/logoIconGreyOutlined.svg') }}" alt="">
                    </a>
                </div>
            </div>

            <div class="right-side">
                <div class="header-widget">
                    <div class="user-menu">
                        <div class="user-name">
                            {{ Config::get('languages')[App::getLocale()] }}
                        </div>
                        <ul>
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                    <li>
                                        <a href="{{ route('admin.lang.switch', $lang) }}">
                                            {{ $language }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="user-menu">
                        <div class="user-name">
                            <span>
                                @empty(auth()->user()->getFirstMediaUrl('avatar'))
                                    <img src="{{ asset('img/avatar.png') }}" alt="avatar">
                                @endempty
                                @empty(!auth()->user()->getFirstMediaUrl('avatar'))
                                    <img src="{{ auth()->user()->getFirstMediaUrl('avatar') }}" alt="avatar">
                                @endempty
                            </span>
                            {{ __('admin-components.views.header.my-account.title') }}
                        </div>
                        <ul>
                            <li>
                                <a href="{{ route('admin.my-profile') }}">
                                    <i class="sl sl-icon-user"></i> {{ __('admin-components.views.header.my-account.ul.li.link.my-profile') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{  route('admin.logout') }}">
                                    <i class="sl sl-icon-power"></i> {{ __('admin-components.views.header.my-account.ul.li.link.logout') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
                <div class="small-dialog-header">
                    <h3>{{ __('admin-components.views.header.h3.sign-in') }}</h3>
                </div>
                <div class="sign-in-form style-1">
                    <ul class="tabs-nav">
                        <li class="">
                            <a href="#tab1">
                                {{ __('admin-components.views.header.ul.li.link.log-in') }}
                            </a>
                        </li>
                        <li>
                            <a href="#tab2">
                                {{ __('admin-components.views.header.ul.li.link.register') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tabs-container alt">
                        <div class="tab-content" id="tab1" style="display: none;">
                            <form method="post" class="login">
                                <p class="form-row form-row-wide">
                                    <label for="username">{{ __('admin-components.views.header.form.label.username') }}
                                        <i class="im im-icon-Male"></i>
                                        <input type="text" class="input-text" name="username" id="username" value="" />
                                    </label>
                                </p>
                                <p class="form-row form-row-wide">
                                    <label for="password">{{ __('admin-components.views.header.form.label.password') }}
                                        <i class="im im-icon-Lock-2"></i>
                                        <input class="input-text" type="password" name="password" id="password"/>
                                    </label>
                                    <span class="lost_password">
                                        <a href="#" >
                                            {{ __('admin-components.views.header.form.span.link.lost-your-password') }}
                                        </a>
                                    </span>
                                </p>
                                <div class="form-row">
                                    <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                                    <div class="checkboxes margin-top-10">
                                        <input id="remember-me" type="checkbox" name="check">
                                        <label for="remember-me">{{ __('admin-components.views.header.form.label.remember-me') }}</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-content" id="tab2" style="display: none;">
                            <form method="post" class="register">
                            <p class="form-row form-row-wide">
                                <label for="username2">{{ __('admin-components.views.header.form.label.username') }}
                                    <i class="im im-icon-Male"></i>
                                    <input type="text" class="input-text" name="username" id="username2" value="" />
                                </label>
                            </p>
                            <p class="form-row form-row-wide">
                                <label for="email2">{{ __('admin-components.views.header.form.label.email') }}
                                    <i class="im im-icon-Mail"></i>
                                    <input type="text" class="input-text" name="email" id="email2" value="" />
                                </label>
                            </p>
                            <p class="form-row form-row-wide">
                                <label for="password1">{{ __('admin-components.views.header.form.label.password') }}
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password1" id="password1"/>
                                </label>
                            </p>
                            <p class="form-row form-row-wide">
                                <label for="password2">{{ __('admin-components.views.header.form.label.repeat-password') }}
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password2" id="password2"/>
                                </label>
                            </p>
                            <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
