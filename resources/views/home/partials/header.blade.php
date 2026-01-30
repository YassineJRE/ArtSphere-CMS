<header id="header-container">
    <div id="header">
        <div class="container">
            <div class="left-side non-signed-in">
                <div id="logo">
                    <a href="{{ route('app.home') }}">
                        <img 
                            src="{{ asset('img/logos/logoWhite'.strtoupper(App::getLocale()).'.svg') }}"
                            data-sticky-logo="{{ asset('img/logos/logoDarkGrey'.strtoupper(App::getLocale()).'.svg') }}"
                            alt="Logo Artolog"
                        >
                    </a>
                </div>

                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
                <div class="choose-lang">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a href="{{ route('admin.lang.switch', $lang) }}">
                                {{ $language }}
                            </a>
                        @endif
                    @endforeach
                </div>
                <!-- Mobile Navigation / End -->

                <!-- Utiliser la naviguation pour le hamburger -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        <li>
                            <a href="javascript:void(0);">{{ __('components.views.header-home.nav.ul.li.home') }}</a>
                            <ul class="sub-menu ">
                                <li>
                                    <a href="{{ route('app.conditions') }}">
                                        {{ __('components.views.header-home.nav.ul.li.conditions') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('app.privacy') }}">
                                        {{ __('components.views.header-home.nav.ul.li.policy') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('app.home') }}#about-us" onclick="window.location.href = this.getAttribute('href');window.location.reload(true);">
                                {{ __('components.views.header-home.nav.ul.li.about-us') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.home') }}#srm" onclick="window.location.href = this.getAttribute('href');window.location.reload(true);">
                                {{ __('components.views.header-home.nav.ul.li.srm') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.home') }}#contact" onclick="window.location.href = this.getAttribute('href');window.location.reload(true);">
                                {{ __('components.views.header-home.nav.ul.li.contact-us') }}
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="sl sl-icon-user"></i>
                                    {{ app('profile.session')->getFirstName() }}
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{  route('my-account.index') }}">
                                            <i class="sl sl-icon-user"></i>
                                            {{ __('components.views.header-home.ul.li.my-account') }}
                                        </a>
                                    </li>
                                    @if (auth()->user()->hasProfileArtist())
                                        <li>
                                            <a href="{{  route('my-account.artist-profile.index') }}">
                                                <i class="sl sl-icon-user"></i>
                                                {{ auth()->user()->profileArtist()->artist_name }}
                                            </a>
                                        </li>                                    
                                    @endif
                                    @if (auth()->user()->hasProfileCurator())
                                        <li>
                                            <a href="{{  route('my-account.curator-profile.index') }}">
                                                <i class="sl sl-icon-user"></i>
                                                {{ auth()->user()->profileCurator()->artist_name }}
                                            </a>
                                        </li>                                    
                                    @endif
                                    @if (auth()->user()->hasProfilePublicCollector())
                                        <li>
                                            <a href="{{  route('my-account.public-collector-profile.index') }}">
                                                <i class="sl sl-icon-user"></i>
                                                {{ auth()->user()->getName() }}
                                            </a>
                                        </li>                                    
                                    @endif
                                    @foreach (auth()->user()->memberships as $membership)
                                        <li>
                                            @if ($membership->group->isArtist())
                                                <a href="{{ route('my-account.artist-group.show',['artist_group' => $membership->group_id]) }}"
                                                ><i class="sl sl-icon-people"></i> {{ $membership->group->name }}</a>
                                            @elseif ($membership->group->isCurator())
                                                <a href="{{ route('my-account.curator-group.show',['curator_group' => $membership->group_id]) }}"
                                                ><i class="sl sl-icon-people"></i> {{ $membership->group->name }}</a>
                                            @elseif ($membership->group->isArtistRunCenterOrganisation())
                                                <a href="{{ route('my-profile.my-artist-run-center-gallery.show',['my_profile' => $membership->user_profile_id, 'my_artist_run_center_gallery' => $membership->group_id]) }}"
                                                ><i class="sl sl-icon-people"></i> {{ $membership->group->name }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{  route('authentication.logout') }}">
                                            <i class="sl sl-icon-power"></i>
                                            {{ __('components.views.header-home.ul.li.logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                        @guest
                            <li>
                                <a href="{{ route('authentication.login') }}">
                                    <i class="sl sl-icon-login"></i> {{ __('components.views.header-home.sign-in') }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
