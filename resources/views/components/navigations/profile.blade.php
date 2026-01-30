<div class="listing-nav-container">
    <a 
        href="#" 
        class="more-search-options-trigger" 
        data-open-title="{{ __('components.views.my-profile-navigation.nav.a.show-menu') }}" 
        data-close-title="{{ __('components.views.my-profile-navigation.nav.a.close-menu') }}"
    ></a>
    <ul class="listing-nav">
        <li>
            <a href="{{ route('app.profiles.show',['profile' => request()->profile, 'search' => request()->search, 'discover' => request()->discover]) }}"
                class="@if (Str::contains(Route::current()->getName(),['app.profiles.show','app.profiles.documents.show'])) active @endif"
            >{{ __('components.views.my-profile-navigation.nav.ul.li.my-profiles') }}</a>
        </li>
        @if (request()->profile->isArtist() || request()->profile->isCurator() )
            <li>
                <a href="{{ route('app.profiles.exhibits.index',['profile' => request()->profile, 'search' => request()->search, 'discover' => request()->discover]) }}"
                    class="@if (Str::contains(Route::current()->getName(),['app.profiles.exhibits.index','app.profiles.exhibits.show','app.profiles.exhibits.artworks.show'])) active @endif"
                >{{ __('components.views.my-profile-navigation.nav.ul.li.my-exhibits') }}</a>
            </li>
            <li>
                <a href="{{ route('app.profiles.website-groups.index',['profile' => request()->profile, 'search' => request()->search, 'discover' => request()->discover]) }}"
                    class="@if (Str::contains(Route::current()->getName(),['app.profiles.website-groups.index','app.profiles.website-groups.show','app.profiles.website-groups.websites.show'])) active @endif"
                >{{ __('components.views.my-profile-navigation.nav.ul.li.my-websites') }}</a>
            </li>
        @endif
        <li>
            <a href="{{ route('app.profiles.collections.index',['profile' => request()->profile, 'search' => request()->search, 'discover' => request()->discover]) }}"
                class="@if (Str::contains(Route::current()->getName(),['app.profiles.collections.index','app.profiles.collections.show','app.profiles.collections.items.show'])) active @endif"
            >{{ __('components.views.my-profile-navigation.nav.ul.li.my-collections') }}</a>
        </li>
        <li class="right-side">
            @yield('navigation-right-side')
        </li>
    </ul>
</div>
