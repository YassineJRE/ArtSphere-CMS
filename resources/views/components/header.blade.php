<header id="header-container" class="sticky-header">
    <div id="header">
        <div class="container">
            <!-- Left Side Content -->
            <div class="left-side @guest non-signed-in @endguest">
                <div id="logo"
                    data-logo-transparent="{{ asset('img/logos/logoIconGreyOutlined.svg') }}"
                    data-logo="{{ asset('img/logos/logoIconGreyOutlined.svg') }}"
                    data-logo-sticky="{{ asset('img/logos/logoIconGreyOutlined.svg') }}">
                    <a href="{{ route('app.home') }}" title="Artolog" rel="home">
                        <img src="{{ asset('img/logos/logoIconGreyOutlined.svg') }}" alt="Artolog">
                    </a>
                </div>
                <div id="search-bar">
                    <section class="section-search">
                        <form role="search"
                            method="get"
                            class="form-search"
                            action="{{ route('app.research') }}"
                        >
                            <label class="search-label" for="search-field">{{ __('components.views.header-logo-black.section.form.label.search-for') }}</label>
                            <input
                                type="search"
                                id="search-field"
                                class="search-field"
                                name="search"
                                value="{{ request()->search }}"
                                placeholder="{{ __('components.views.header-logo-black.section.form.button.search') }}"
                            >
                            <button type="submit" value="Search"><i class="fas fa-search"></i></button>
                        </form>
                    </section>
                </div>

                @auth
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
                            {{ app('profile.session')->getFirstName() }}
                        </div>
                        <ul>
                            <li>
                                <a href="{{  route('my-account.index') }}">
                                    <i class="sl sl-icon-user"></i>
                                    {{ __('components.views.header-logo-black.ul.li.my-account') }}
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
                                    {{ __('components.views.header-logo-black.ul.li.logout') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                @endauth

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
                            <a href="{{ route('app.home') }}#about-us" onclick="window.location.reload(true);">
                                {{ __('components.views.header-home.nav.ul.li.about-us') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.home') }}#srm" onclick="window.location.reload(true);">
                                {{ __('components.views.header-home.nav.ul.li.srm') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.home') }}#contact" onclick="window.location.reload(true);">
                                {{ __('components.views.header-home.nav.ul.li.contact-us') }}
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="sl sl-icon-user"></i>
                                    {{ __('components.views.header-home.ul.li.my-account') }}
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
                </nav>
                <div class="clearfix"></div>
            </div>
            <!-- Left Side Content / End -->
        </div>
    </div>
</header>
