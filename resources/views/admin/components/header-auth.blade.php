<header id="header-container" class="fullwidth">
	<div id="header">
		<div class="container">
			<div class="left-side">
				<div id="logo">
					<a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('img/logos/logoIconGreyOutlined.svg') }}" data-sticky-logo="{{ asset('img/logos/logoIconGreyOutlined.svg') }}" alt="">
                    </a>
				</div>
				<div class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
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
                </div>
            </div>
		</div>
	</div>
</header>
<div class="clearfix"></div>
