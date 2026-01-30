<div class="listing-nav-container">
    <a 
        href="#" 
        class="more-search-options-trigger" 
        data-open-title="{{ __('components.views.my-group-navigation.nav.a.show-menu') }}" 
        data-close-title="{{ __('components.views.my-group-navigation.nav.a.close-menu') }}"
    ></a>
    <ul class="listing-nav">
        <li>
            <a href="{{ route('app.groups.show',['group' => request()->group, 'search' => request()->search, 'discover' => request()->discover]) }}"
                class="@if (Str::contains(Route::current()->getName(),['app.groups.show','app.groups.documents.show'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.my-profiles') }}</a>
        </li>
        <li>
            <a href="{{ route('app.groups.exhibits.index',['group' => request()->group, 'search' => request()->search, 'discover' => request()->discover]) }}"
                class="@if (Str::contains(Route::current()->getName(),['app.groups.exhibits.index','app.groups.exhibits.show','app.groups.exhibits.artworks.show'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.my-exhibits') }}</a>
        </li>
        <li>
            <a href="{{ route('app.groups.website-groups.index',['group' => request()->group, 'search' => request()->search, 'discover' => request()->discover]) }}"
                class="@if (Str::contains(Route::current()->getName(),['app.groups.website-groups.index','app.groups.website-groups.show','app.groups.website-groups.websites.show'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.my-websites') }}</a>
        </li>
        <li>
            <a href="{{ route('app.groups.collections.index',['group' => request()->group, 'search' => request()->search, 'discover' => request()->discover]) }}"
                class="@if (Str::contains(Route::current()->getName(),['app.groups.collections.index','app.groups.collections.show','app.groups.collections.items.show'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.my-collections') }}</a>
        </li>
        <li class="right-side">
            @yield('navigation-right-side')
        </li>
    </ul>
</div>
