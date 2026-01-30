@isset($myWebsite)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="my-profile-buttons">
                <div class="col-md-6 left-buttons">
                    @if ($myWebsite->parent->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsite->parent->owner))
                        <a
                            @if ($myWebsite->parent->belongsToProfile())
                                href="{{ route('my-profile.my-website-groups.my-websites.edit',[
                                    'my_profile' => $myWebsite->parent->owner_id,
                                    'my_website_group' => $myWebsite->parent->id,
                                    'my_website' => $myWebsite->id
                                ]) }}"           
                            @elseif ($myWebsite->parent->belongsToGroup())
                                href="{{ route('my-group.my-website-groups.my-websites.edit',[
                                    'my_group' => $myWebsite->parent->owner_id,
                                    'my_website_group' => $myWebsite->parent->id,
                                    'my_website' => $myWebsite->id
                                ]) }}"
                            @endif
                            class="button edit"
                        ><i class="sl sl-icon-note"></i> {{ __('my-website.views.show.footer.button.edit') }}</a>
                    @endif
                    <a
                        @if ($myWebsite->parent->belongsToProfile())
                            href="{{ route('app.profiles.website-groups.websites.show',[
                                'profile' => $myWebsite->parent->owner_id,
                                'website_group' => $myWebsite->parent->id,
                                'website' => $myWebsite->id
                            ]) }}"           
                        @elseif ($myWebsite->parent->belongsToGroup())
                            href="{{ route('app.groups.website-groups.websites.show',[
                                'group' => $myWebsite->parent->owner_id,
                                'website_group' => $myWebsite->parent->id,
                                'website' => $myWebsite->id
                            ]) }}"
                        @endif
                        class="button add"
                    ><i class="sl sl-icon-eye"></i> {{ __('my-website.views.show.footer.button.view') }}</a>                    
                </div>
                <div class="col-md-6 right-buttons">
                    @if ($myWebsite->getFirstMedia())
                        <a 
                            href="{{ $myWebsite->getFirstMedia()->getFullUrl() }}"
                            class="button download"
                            download
                        >
                            <i class="fa fa-download"></i>
                            {{ __('my-website.views.show.footer.button.download') }}
                        </a>
                    @endif

                    @if ($myWebsite->parent->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsite->parent->owner))
                        <a href="#delete-row-dialog-{{ $myWebsite->id }}" class="button delete popup-delete-row right">
                            <i class="sl sl-icon-trash"></i>
                            {{ __('my-website.views.show.footer.button.delete') }}
                        </a>
                        <div id="delete-row-dialog-{{ $myWebsite->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ __('my-website.views.show.footer.h3.delete') }}</h3>
                            </div>
                            <div class="sign-in-form style-1">
                                <p>{{ __('my-website.views.show.footer.p.sure') }}</p>
                                <form 
                                    method="post"
                                    @if ($myWebsite->parent->belongsToProfile())
                                        action="{{ route('my-profile.my-website-groups.my-websites.destroy',[
                                            'my_profile' => $myWebsite->parent->owner_id,
                                            'my_website_group' => $myWebsite->parent->id,
                                            'my_website' => $myWebsite->id
                                        ]) }}"    
                                    @elseif ($myWebsite->parent->belongsToGroup())
                                        action="{{ route('my-group.my-website-groups.my-websites.destroy',[
                                            'my_group' => $myWebsite->parent->owner_id,
                                            'my_website_group' => $myWebsite->parent->id,
                                            'my_website' => $myWebsite->id
                                        ]) }}"
                                    @endif
                                >
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button">
                                        {{ __('my-website.views.show.footer.form.button.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-12 margin-top-20">
                @if ($myWebsite->parent->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myWebsite->parent->owner))
                    <a
                        @if ($myWebsite->parent->belongsToProfile())
                            href="{{ route('my-profile.my-website-groups.my-websites.create',[
                                'my_profile' => $myWebsite->parent->owner_id,
                                'my_website_group' => $myWebsite->parent->id,
                            ]) }}"    
                        @elseif ($myWebsite->parent->belongsToGroup())
                            href="{{ route('my-group.my-website-groups.my-websites.create',[
                                'my_group' => $myWebsite->parent->owner_id,
                                'my_website_group' => $myWebsite->parent->id,
                            ]) }}"
                        @endif
                        class="button add"
                    >
                        <i class="sl sl-icon-plus"></i>
                        {{ __('my-website.views.show.footer.button.another-website') }}
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