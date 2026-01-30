@isset($myCollection)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="my-profile-buttons">
                <div class="col-md-6 left-buttons">
                    @if ($myCollection->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myCollection->owner))
                        <a 
                            @if ($myCollection->belongsToProfile())
                                href="{{ route('my-profile.my-collections.edit',[
                                    'my_profile' => $myCollection->owner_id,
                                    'my_collection' => $myCollection->id
                                ]) }}"
                            @elseif ($myCollection->belongsToGroup())
                                href="{{ route('my-group.my-collections.edit',[
                                    'my_group' => $myCollection->owner_id, 
                                    'my_collection' => $myCollection->id
                                ]) }}"
                            @endif
                            class="button edit"
                        >
                            <i class="sl sl-icon-note"></i>
                            {{ __('my-collection.views.show.footer.button.edit') }}
                        </a>
                    @endif
                    <a 
                        @if ($myCollection->belongsToProfile())
                            href="{{ route('app.profiles.collections.show',[
                                'profile' => $myCollection->owner_id,
                                'collection' => $myCollection->id
                            ]) }}"
                        @elseif ($myCollection->belongsToGroup())
                            href="{{ route('app.groups.collections.show',[
                                'group' => $myCollection->owner_id, 
                                'collection' => $myCollection->id
                            ]) }}"
                        @endif
                        class="button add"
                    >
                        <i class="sl sl-icon-eye"></i>
                        {{ __('my-collection.views.show.footer.button.view') }}
                    </a>
                    @if ($myCollection->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myCollection->owner)) 
                        <a 
                            @if ($myCollection->belongsToProfile())
                                href="{{ route('my-profile.my-collections.toggle-enable',[
                                    'my_profile' => $myCollection->owner_id,
                                    'my_collection' => $myCollection->id
                                ]) }}"
                            @elseif ($myCollection->belongsToGroup())
                                href="{{ route('my-group.my-collections.toggle-enable',[
                                    'my_group' => $myCollection->owner_id, 
                                    'my_collection' => $myCollection->id
                                ]) }}"
                            @endif
                            class="button publish"
                        >
                            @if ($myCollection->isEnabled())
                                <i class="sl sl-icon-close"></i> {{ __('my-collection.views.show.footer.button.unpublish') }}
                            @else
                                <i class="sl sl-icon-check"></i> {{ __('my-collection.views.show.footer.button.publish') }}
                            @endif
                        </a>
                    @endif
                </div>
                <div class="col-md-6 right-buttons">
                    @if ($myCollection->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myCollection->owner))
                        <a href="#delete-row-dialog-{{ $myCollection->id }}"
                            class="button delete popup-delete-row"
                        ><i class="sl sl-icon-trash"></i> {{ __('my-collection.views.show.footer.button.delete') }}</a>
                        <div id="delete-row-dialog-{{ $myCollection->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ __('my-collection.views.show.footer.h3.delete') }}</h3>
                            </div>
                            <div class="sign-in-form style-1">
                                <p>{{ __('my-collection.views.show.footer.p.sure') }}</p>
                                <form 
                                    method="post"
                                    @if ($myCollection->belongsToProfile())
                                        action="{{ route('my-profile.my-collections.destroy',[
                                            'my_profile' => $myCollection->owner_id,
                                            'my_collection' => $myCollection->id
                                        ]) }}"
                                    @elseif ($myCollection->belongsToGroup())
                                        action="{{ route('my-group.my-collections.destroy',[
                                            'my_group' => $myCollection->owner_id, 
                                            'my_collection' => $myCollection->id
                                        ]) }}"
                                    @endif
                                >
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button">
                                        {{ __('my-collection.views.show.footer.form.button.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="margin-top-20">
                @if ($myCollection->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myCollection->owner))
                    <a 
                        @if ($myCollection->belongsToProfile())
                            href="{{ route('my-profile.my-collections.create',[
                                'my_profile' => $myCollection->owner_id,
                            ]) }}"
                        @elseif ($myCollection->belongsToGroup())
                            href="{{ route('my-group.my-collections.create',[
                                'my_group' => $myCollection->owner_id,
                            ]) }}"
                        @endif
                        class="button add"
                    >
                        <i class="sl sl-icon-plus"></i>
                        {{ __('my-collection.views.show.footer.button.another-collection') }}
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