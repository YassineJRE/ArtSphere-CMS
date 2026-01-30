@isset($profile)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="my-profile-buttons">
                <div class="col-md-6 left-buttons">
                    @if ($profile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($profile))
                        <a 
                            @if ($profile->isProfile())
                                href="{{ route('my-profile.edit',[
                                    'my_profile' => $profile->id
                                ]) }}"
                            @elseif ($profile->isGroup())
                                href="{{ route('my-group.edit',[
                                    'my_group' => $profile->id
                                ]) }}"
                            @endif
                            class="button edit"
                        ><i class="sl sl-icon-note"></i> {{ __('my-profile.views.show.button.edit') }}</a>
                    @endif

                    <a 
                        @if ($profile->isProfile())
                            href="{{ route('app.profiles.show',[
                                'profile' => $profile->id
                            ]) }}"
                        @elseif ($profile->isGroup())
                            href="{{ route('app.groups.show',[
                                'group' => $profile->id
                            ]) }}"
                        @endif
                        class="button add"
                    ><i class="sl sl-icon-eye"></i> {{ __('my-profile.views.show.button.view') }}</a>                    

                    @if ($profile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($profile))
                        @if ($profile->isEnabled())
                            <a 
                                class="button unpublish"
                                @if ($profile->isProfile())
                                    href="{{ route('my-profile.toggle-enable',[
                                        'my_profile' => $profile->id
                                    ]) }}"
                                @elseif ($profile->isGroup())
                                    href="{{ route('my-group.toggle-enable',[
                                        'my_group' => $profile->id
                                    ]) }}"
                                @endif
                            ><i class="sl sl-icon-close"></i> {{ __('my-profile.views.show.p.button.unpublish-account') }}</a>
                        @else
                            <a 
                                class="button publish"
                                @if ($profile->isProfile())
                                    href="{{ route('my-profile.toggle-enable',[
                                        'my_profile' => $profile->id
                                    ]) }}"
                                @elseif ($profile->isGroup())
                                    href="{{ route('my-group.toggle-enable',[
                                        'my_group' => $profile->id
                                    ]) }}"
                                @endif
                            ><i class="sl sl-icon-check"></i> {{ __('my-profile.views.show.p.button.publish-account') }}</a>
                        @endif
                    @endif
                </div>
                <div class="col-md-6 right-buttons">
                    @if ($profile->isProfile() || app('profile.session')->isAdministratorOfThisGroup($profile))
                        <a href="#delete-row-dialog-{{ $profile->id }}"
                            class="button delete popup-delete-row"
                        ><i class="sl sl-icon-trash"></i> {{ __('my-profile.views.show.button.delete') }}</a>
                        <div id="delete-row-dialog-{{ $profile->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ __('my-profile.views.show.footer.h3.delete-profile') }}</h3>
                            </div>
                            <div class="sign-in-form style-1">
                                <p>{{ __('my-profile.views.show.footer.p.sure') }}</p>
                                <form 
                                    method="post"
                                    @if ($profile->isProfile())
                                        action="{{ route('my-profile.destroy',[
                                            'my_profile' => $profile->id
                                        ]) }}"
                                    @elseif ($profile->isGroup())
                                        action="{{ route('my-group.destroy',[
                                            'my_group' => $profile->id
                                        ]) }}"
                                    @endif
                                >
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button">
                                        {{ __('my-profile.views.show.footer.form.button.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function (e) {
                $('.popup-delete-row').magnificPopup({
                    type: 'inline',
                    fixedContentPos: false,
                    fixedBgPos: true,
                    overflowY: 'auto',
                    closeBtnInside: true,
                    preloader: false,
                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'art-mfp-zoom-in'
                });
            });
        </script>
    @endpush
@endisset