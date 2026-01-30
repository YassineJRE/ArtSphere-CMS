@inject('sidebarService', 'App\Services\Web\SidebarService')
<nav class="woocommerce-MyAccount-navigation">
    <ul>
        <li>
            <a href="{{ route('my-account.index') }}"
                class="@if (Str::contains(Route::current()->getName(),[
                    'my-account.index',
                    'my-account.edit'
                ])) is-active @endif"
            >{{ __('components.views.my-account-navigation.nav.ul.li.details') }}</a>
        </li>
        @foreach ($sidebarService::getListProfiles() as $profileKey => $profileId)
            @isset($profileId)
                <li>
                    <a 
                        href="{{ route("my-account.$profileKey-profile.show", [str_replace('-', '_', "$profileKey-profile") => $profileId]) }}"
                        class="@if (Str::contains(Route::current()->getName(),["my-account.$profileKey-profile"])) is-active @endif"
                        style="font-weight:bold;"
                    >
                        @if ($profileKey == 'artist')
                            {{ __("enums.profile-type.$profileKey") }}
                            - {{ Str::limit(auth()->user()->profileArtist()->artist_name, 10) }}
                        @elseif ($profileKey == 'curator')
                            {{ __("enums.profile-type.$profileKey") }}
                            - {{ Str::limit(auth()->user()->profileCurator()->artist_name, 10) }}
                        @elseif ($profileKey == 'public-collector')
                            {{ __('components.views.my-account-navigation.nav.ul.li.profile-public') }}
                            - {{ Str::limit(auth()->user()->getName(), 20) }}
                        @endif
                    </a>
                    @if ($profileKey == 'artist')
                        <ul>
                            <li>
                                <a 
                                    href="{{ route('my-account.artist-group.index') }}"
                                    class="@if (Str::contains(Route::current()->getName(),['my-account.artist-group.index'])) is-active @endif"
                                >{{ __('components.views.my-account-navigation.nav.ul.li.create-artist-group') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('my-profile.my-artist-run-center-gallery.index', ['my_profile' => $profileId, 'profile_type' => $profileKey]) }}"
                                    class="@if (
                                                    Str::contains(Route::current()->getName(),['my-profile.my-artist-run-center-gallery.index'])
                                                    && request()->route('profile_type') == $profileKey
                                                ) is-active
                                            @endif"
                                >{{ __('components.views.my-account-navigation.nav.ul.li.create-artist-center') }}</a>
                            </li>
                        </ul>
                    @endif
                    @if ($profileKey == 'curator')
                        <ul>
                            <li>
                                <a 
                                    href="{{ route('my-account.curator-group.index') }}"
                                    class="@if (Str::contains(Route::current()->getName(),['my-account.curator-group.index'])) is-active @endif"
                                >
                                    {{ __('components.views.my-account-navigation.nav.ul.li.create-curator-group') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('my-profile.my-artist-run-center-gallery.index', ['my_profile' => $profileId, 'profile_type' => $profileKey]) }}"
                                    class="@if (
                                                    Str::contains(Route::current()->getName(),['my-profile.my-artist-run-center-gallery.index'])
                                                    && request()->route('profile_type') == $profileKey
                                                ) is-active
                                            @endif"
                                >{{ __('components.views.my-account-navigation.nav.ul.li.create-artist-center') }}</a>
                            </li>
                        </ul>
                    @endif
                    @if ($profileKey == 'public-collector')
                        <ul>
                            <li>
                                <a href="{{ route('my-profile.my-artist-run-center-gallery.index', ['my_profile' => $profileId, 'profile_type' => $profileKey]) }}"
                                    class="@if (
                                                    Str::contains(Route::current()->getName(),['my-profile.my-artist-run-center-gallery.index'])
                                                    && request()->route('profile_type') == $profileKey
                                                ) is-active
                                            @endif"
                                >{{ __('components.views.my-account-navigation.nav.ul.li.create-artist-center') }}</a>
                            </li>
                        </ul>
                    @endif
                </li>
            @else
                <li>
                    <a href="{{ route("my-account.$profileKey-profile.index") }}"
                        class="@if (Str::contains(Route::current()->getName(),["my-account.$profileKey-profile"])) is-active @endif"
                    >{{ __('components.views.my-account-navigation.nav.ul.li.my-profiles') }} - {{ __("enums.profile-type.$profileKey") }}</a>
                </li>
            @endisset
        @endforeach
        @foreach (auth()->user()->memberships as $membership)
            <li>
                @if ($membership->group->isArtist())
                    <a 
                        href="{{ route('my-account.artist-group.show',['artist_group' => $membership->group_id]) }}"
                        class="@if (Str::contains(Route::current()->getName(),['my-account.artist-group.show']) && ($membership->group_id == request()->artist_group->id ?? '')) is-active @endif"
                        style="font-weight:bold;"
                    >{{ __('components.views.my-account-navigation.nav.ul.li.artist-group') }} - {{ Str::limit($membership->group->name, 10) }}</a>
                @elseif ($membership->group->isCurator())
                    <a 
                        href="{{ route('my-account.curator-group.show',['curator_group' => $membership->group_id]) }}"
                        class="@if (Str::contains(Route::current()->getName(),['my-account.curator-group.show']) && ($membership->group_id == request()->curator_group->id ?? '')) is-active @endif"
                        style="font-weight:bold;"
                    >{{ __('components.views.my-account-navigation.nav.ul.li.curator-group') }} - {{ Str::limit($membership->group->name, 10) }}</a>
                @elseif ($membership->group->isArtistRunCenterOrganisation())
                    <a 
                        href="{{ route('my-profile.my-artist-run-center-gallery.show',['my_profile' => $membership->user_profile_id, 'my_artist_run_center_gallery' => $membership->group_id]) }}"
                        class="@if (Str::contains(Route::current()->getName(),['my-profile.my-artist-run-center-gallery.show']) && ($membership->group_id == request()->my_artist_run_center_gallery->id ?? '')) is-active @endif"
                        style="font-weight:bold;"
                    >{{ __('components.views.my-account-navigation.nav.ul.li.org') }} - {{ Str::limit($membership->group->name, 20) }}</a>
                @endif
            </li>
        @endforeach
        <li>
            <a href="{{ route('authentication.logout') }}">
                {{ __('components.views.my-account-navigation.nav.ul.li.logout') }}
            </a>
        </li>
    </ul>
</nav>
