<div id="footer" class="sticky-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <b>{{ __('components.views.footer.h4.links') }}</b>
            </div>
            <div class="col-md-10">            
                <ul class="footer-links">
                    <li><a href="{{ route('app.home') }}#contact" onclick="window.location.reload(true);">{{ __('components.views.footer.ul.li.contact-us') }}</a></li>
                    <li><a href="{{ route('app.home') }}#about-us" onclick="window.location.reload(true);">{{ __('components.views.footer.ul.li.about-us') }}</a></li>
                    <li><a href="{{ route('app.conditions') }}">{{ __('components.views.footer.ul.li.conditions') }}</a></li>
                    <li><a href="{{ route('app.privacy') }}">{{ __('components.views.footer.ul.li.policy') }}</a></li>
                    @guest
                        <li>
                            <a href="{{ route('authentication.register.index') }}" class="sign-in">
                                {{ __('components.views.footer.ul.li.sign-up') }}
                            </a>
                        </li>
                    @endguest
                    @auth
                        <li>
                            <a href="{{ route('my-account.index') }}">
                                {{ __('components.views.footer.ul.li.my-account') }}
                            </a>
                        </li>
                    @endauth
                    <li>
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <a href="{{ route('app.lang.switch', $lang) }}">
                                    {{ $language }}
                                </a>
                            @endif
                        @endforeach
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyrights">© {{ date('Y') }} {{ __('components.views.footer.copyrights') }}</div>
            </div>
        </div>
    </div>
</div>
