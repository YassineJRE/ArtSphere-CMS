<div class="listing-nav-container">
    <a 
        href="#" 
        class="more-search-options-trigger" 
        data-open-title="{{ __('components.views.my-profile-navigation.nav.a.show-menu') }}" 
        data-close-title="{{ __('components.views.my-profile-navigation.nav.a.close-menu') }}"
    ></a>
    <ul class="listing-nav">
        <li>
            <a href="{{ route('my-profile.show',['my_profile' => request()->my_profile]) }}"
                class="@if (Str::contains(Route::current()->getName(),['my-profile.show'])) active @endif"
            >{{ __('components.views.my-profile-navigation.nav.ul.li.my-profiles') }}</a>
        </li>
        @if (request()->my_profile->isArtist() || request()->my_profile->isCurator() )
            <li>
                <a href="{{ route('my-profile.my-exhibits.index',['my_profile' => request()->my_profile]) }}"
                    class="@if (Str::contains(Route::current()->getName(),['my-exhibits.index'])) active @endif"
                >{{ __('components.views.my-profile-navigation.nav.ul.li.my-exhibits') }}</a>
            </li>
            <li>
                <a href="{{ route('my-profile.my-website-groups.index',['my_profile' => request()->my_profile]) }}"
                    class="@if (Str::contains(Route::current()->getName(),['my-website-groups.index'])) active @endif"
                >{{ __('components.views.my-profile-navigation.nav.ul.li.my-websites') }}</a>
            </li>
        @endif
        <li>
            <a href="{{ route('my-profile.my-collections.index',['my_profile' => request()->my_profile]) }}"
                class="@if (Str::contains(Route::current()->getName(),['my-collections.index'])) active @endif"
            >{{ __('components.views.my-profile-navigation.nav.ul.li.my-collections') }}</a>
        </li>
        <li>
            <a href="{{ route('my-profile.my-model-removed.index',['my_profile' => request()->my_profile]) }}"
                class="@if (Str::contains(Route::current()->getName(),['my-model-removed.index'])) active @endif"
            >{{ __('components.views.my-profile-navigation.nav.ul.li.removed') }}</a>
        </li>
    </ul>
</div>
