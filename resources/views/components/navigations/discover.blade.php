<div class="listing-nav-container">
    <a 
        href="#" 
        class="more-search-options-trigger" 
        data-open-title="{{ __('components.views.my-profile-navigation.nav.a.show-menu') }}" 
        data-close-title="{{ __('components.views.my-profile-navigation.nav.a.close-menu') }}"
    ></a>
    <ul class="listing-nav">
        
        @if ($artwork->exhibit->owner->isGroup())
            <li>
                <a href="{{ route('app.groups.show',['group' => $artwork->exhibit->owner]) }}"
                >{{ __('components.views.my-group-navigation.nav.ul.li.my-profiles') }}</a>
            </li>
            
        @elseif ($artwork->exhibit->owner->isArtist() || $artwork->exhibit->owner->isCurator() )
            <li>
                <a href="{{ route('app.profiles.show',['profile' => $artwork->exhibit->owner]) }}"
                >{{ __('components.views.my-profile-navigation.nav.ul.li.my-profiles') }}</a>
            </li>

        @endif
       
        @if ($artwork->exhibit->owner->isGroup())
            <li>
                <a href="{{ route('app.groups.exhibits.index',['group' => $artwork->exhibit->owner]) }}"
                    class="active"
                >{{ __('components.views.my-group-navigation.nav.ul.li.my-exhibits') }}</a>
            </li>
            <li>
                <a href="{{ route('app.groups.website-groups.index',['group' => $artwork->exhibit->owner]) }}"
                >{{ __('components.views.my-group-navigation.nav.ul.li.my-websites') }}</a>
            </li>
            <li>
                <a href="{{ route('app.groups.collections.index',['group' => $artwork->exhibit->owner]) }}"
                >{{ __('components.views.my-group-navigation.nav.ul.li.my-collections') }}</a>
            </li>
        @elseif ($artwork->exhibit->owner->isArtist() || $artwork->exhibit->owner->isCurator() )
            <li>
                <a href="{{ route('app.profiles.exhibits.index',['profile' => $artwork->exhibit->owner]) }}"
                    class="active"
                >{{ __('components.views.my-profile-navigation.nav.ul.li.my-exhibits') }}</a>
            </li>
            <li>
                <a href="{{ route('app.profiles.website-groups.index',['profile' => $artwork->exhibit->owner]) }}"
                >{{ __('components.views.my-profile-navigation.nav.ul.li.my-websites') }}</a>
            </li>
            <li>
                <a href="{{ route('app.profiles.collections.index',['profile' => $artwork->exhibit->owner]) }}"
                >{{ __('components.views.my-profile-navigation.nav.ul.li.my-collections') }}</a>
            </li>
        @endif
        <li class="right-side">
            @yield('navigation-right-side')
        </li>
    </ul>
</div>
