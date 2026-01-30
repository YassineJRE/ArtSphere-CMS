@isset($myWebsiteGroup)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="my-profile-buttons">
                <div class="col-md-6 left-buttons">
                    @if ($myWebsiteGroup->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsiteGroup->owner))
                        <a 
                            @if ($myWebsiteGroup->belongsToProfile())
                                href="{{ route('my-profile.my-website-groups.edit',[
                                    'my_profile' => $myWebsiteGroup->owner_id,
                                    'my_website_group' => $myWebsiteGroup->id,
                                ]) }}"
                            @elseif ($myWebsiteGroup->belongsToGroup())
                                href="{{ route('my-group.my-website-groups.edit',[
                                    'my_group' => $myWebsiteGroup->owner_id,
                                    'my_website_group' => $myWebsiteGroup->id,
                                ]) }}"
                            @endif
                            class="button edit"
                        ><i class="sl sl-icon-note"></i> {{ __('my-website-group.views.show.footer.button.edit') }}</a>
                    @endif
                    <a 
                        @if ($myWebsiteGroup->belongsToProfile())
                            href="{{ route('app.profiles.website-groups.show',[
                                'profile' => $myWebsiteGroup->owner_id,
                                'website_group' => $myWebsiteGroup->id,
                            ]) }}"
                        @elseif ($myWebsiteGroup->belongsToGroup())
                            href="{{ route('app.groups.website-groups.show',[
                                'group' => $myWebsiteGroup->owner_id,
                                'website_group' => $myWebsiteGroup->id,
                            ]) }}"
                        @endif
                        class="button add"
                    ><i class="sl sl-icon-eye"></i> {{ __('my-website-group.views.show.footer.button.view') }}</a>                    
                    @if ($myWebsiteGroup->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsiteGroup->owner))
                        <a 
                            @if ($myWebsiteGroup->belongsToProfile())
                                href="{{ route('my-profile.my-website-groups.toggle-enable',[
                                    'my_profile' => $myWebsiteGroup->owner_id,
                                    'my_website_group' => $myWebsiteGroup->id,
                                ]) }}"
                            @elseif ($myWebsiteGroup->belongsToGroup())
                                href="{{ route('my-group.my-website-groups.toggle-enable',[
                                    'my_group' => $myWebsiteGroup->owner_id,
                                    'my_website_group' => $myWebsiteGroup->id,
                                ]) }}"
                            @endif
                            class="button publish"
                        >
                            @if ($myWebsiteGroup->isEnabled())
                                <i class="sl sl-icon-close"></i> {{ __('my-website-group.views.show.footer.button.unpublish') }}
                            @else
                                <i class="sl sl-icon-check"></i> {{ __('my-website-group.views.show.footer.button.publish') }}
                            @endif
                        </a>
                    @endif
                </div>
                <div class="col-md-6 right-buttons">
                    @if ($myWebsiteGroup->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsiteGroup->owner))
                        <a href="#delete-row-dialog-{{ $myWebsiteGroup->id }}" class="button delete popup-delete-row">
                            <i class="sl sl-icon-trash"></i>
                            {{ __('my-website-group.views.show.footer.button.delete') }}
                        </a>
                        <div id="delete-row-dialog-{{ $myWebsiteGroup->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ __('my-website-group.views.show.footer.h3.delete') }}</h3>
                            </div>
                            <div class="sign-in-form style-1">
                                <p>{{ __('my-website-group.views.show.footer.p.sure') }}</p>
                                <form 
                                    method="post"
                                    @if ($myWebsiteGroup->belongsToProfile())
                                        action="{{ route('my-profile.my-website-groups.destroy',[
                                            'my_profile' => $myWebsiteGroup->owner_id,
                                            'my_website_group' => $myWebsiteGroup->id,
                                        ]) }}"
                                    @elseif ($myWebsiteGroup->belongsToGroup())
                                        action="{{ route('my-group.my-website-groups.destroy',[
                                            'my_group' => $myWebsiteGroup->owner_id,
                                            'my_website_group' => $myWebsiteGroup->id,
                                        ]) }}"
                                    @endif
                                >
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button">
                                        {{ __('my-website-group.views.show.footer.form.button.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="margin-top-20">
                @if ($myWebsiteGroup->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsiteGroup->owner))
                    <a 
                        @if ($myWebsiteGroup->belongsToProfile())
                            href="{{ route('my-profile.my-website-groups.create',[
                                'my_profile' => $myWebsiteGroup->owner_id,
                            ]) }}"
                        @elseif ($myWebsiteGroup->belongsToGroup())
                            href="{{ route('my-group.my-website-groups.create',[
                                'my_group' => $myWebsiteGroup->owner_id,
                            ]) }}"
                        @endif
                        class="button add"
                    >
                        <i class="sl sl-icon-plus"></i>
                        {{ __('my-website-group.views.show.footer.button.another-website') }}
                    </a>
                @endif
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