<div class="listing-nav-container">
    <a 
        href="#" 
        class="more-search-options-trigger" 
        data-open-title="{{ __('components.views.my-profile-navigation.nav.a.show-menu') }}" 
        data-close-title="{{ __('components.views.my-profile-navigation.nav.a.close-menu') }}"
    ></a>
    <ul class="listing-nav">
        <li>
            <a href="{{ route('my-group.show',['my_group' => request()->my_group]) }}"
                class="@if (Str::contains(Route::current()->getName(),['my-group.show'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.my-profiles') }}</a>
        </li>
        <li>
            <a href="{{ route('my-group.my-exhibits.index',['my_group' => request()->my_group]) }}"
                class="@if (Str::contains(Route::current()->getName(),['my-exhibits.index'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.my-exhibits') }}</a>
        </li>
        <li>
            <a href="{{ route('my-group.my-website-groups.index',['my_group' => request()->my_group]) }}"
                class="@if (Str::contains(Route::current()->getName(),['my-website-groups.index'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.my-websites') }}</a>
        </li>
        <li>
            <a href="{{ route('my-group.my-collections.index',['my_group' => request()->my_group]) }}"
                class="@if (Str::contains(Route::current()->getName(),['my-collections.index'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.my-collections') }}</a>
        </li>
        <li>
            <a href="{{ route('my-group.members.index',['my_group' => request()->my_group ]) }}"
                class="@if (Str::contains(Route::current()->getName(),['members.index'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.members') }}</a>
        </li>
        <li>
            <a href="{{ route('my-group.my-model-removed.index',['my_group' => request()->my_group]) }}"
                class="@if (Str::contains(Route::current()->getName(),['my-model-removed.index'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.removed') }}</a>
        </li>
        @if (request()->my_group->isArtistRunCenterOrganisation())
        <li>
            <a href="{{ route('my-group.verification.index',['my_group' => request()->my_group]) }}"
                class="@if (Str::contains(Route::current()->getName(),['verification.index'])) active @endif"
            >{{ __('components.views.my-group-navigation.nav.ul.li.verification') }}</a>
        </li>  
        @endif
        
    </ul>
</div>
