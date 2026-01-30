@isset($myDocument)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="my-profile-buttons">
                <div class="col-md-6 left-buttons">
                    @if ($myDocument->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myDocument->owner))
                        <a 
                            @if ($myDocument->belongsToProfile())
                                href="{{ route('my-profile.my-documents.edit',[
                                    'my_profile' => $myDocument->owner_id, 
                                    'my_document' => $myDocument->id
                                ]) }}"
                            @elseif ($myDocument->belongsToGroup())
                                href="{{ route('my-group.my-documents.edit',[
                                    'my_group' => $myDocument->owner_id, 
                                    'my_document' => $myDocument->id
                                ]) }}"
                            @endif
                            class="button edit"
                        ><i class="sl sl-icon-note"></i> {{ __('my-document.views.show.footer.button.edit') }}</a>
                        <a 
                            @if ($myDocument->belongsToProfile())
                                href="{{ route('my-profile.my-documents.toggle-enable',[
                                    'my_profile' => $myDocument->owner_id, 
                                    'my_document' => $myDocument->id
                                ]) }}"
                            @elseif ($myDocument->belongsToGroup())
                                href="{{ route('my-group.my-documents.toggle-enable',[
                                    'my_group' => $myDocument->owner_id, 
                                    'my_document' => $myDocument->id
                                ]) }}"
                            @endif
                            class="button publish"
                        >
                            @if ($myDocument->isEnabled())
                                <i class="sl sl-icon-close"></i> {{ __('my-document.views.show.footer.button.unpublish') }}
                            @else
                                <i class="sl sl-icon-check"></i> {{ __('my-document.views.show.footer.button.publish') }}
                            @endif
                        </a>
                    @endif
                </div>
                <div class="col-md-6 right-buttons">
                    @if ($myDocument->getFirstMedia())
                        <a href="{{ $myDocument->getFirstMedia()->getFullUrl() }}"
                            class="button download"
                            download
                        >
                            <i class="fa fa-download"></i>
                            {{ __('my-document.views.show.footer.button.download') }}
                        </a>
                    @endif

                    @if ($myDocument->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myDocument->owner))
                        <a href="#delete-row-dialog-{{ $myDocument->id }}" class="button delete popup-delete-row right">
                            <i class="sl sl-icon-trash"></i>
                            {{ __('my-document.views.show.footer.button.delete') }}
                        </a>
                        <div id="delete-row-dialog-{{ $myDocument->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ __('my-document.views.show.footer.h3.delete') }}</h3>
                            </div>
                            <div class="sign-in-form style-1">
                                <p>{{ __('my-document.views.show.footer.p.sure') }}</p>
                                <form 
                                    method="post"
                                    @if ($myDocument->belongsToProfile())
                                        action="{{ route('my-profile.my-documents.destroy',[
                                            'my_profile' => $myDocument->owner_id, 
                                            'my_document' => $myDocument->id
                                        ]) }}"
                                    @elseif ($myDocument->belongsToGroup())
                                        action="{{ route('my-group.my-documents.destroy',[
                                            'my_group' => $myDocument->owner_id, 
                                            'my_document' => $myDocument->id
                                        ]) }}"
                                    @endif
                                >
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button">
                                        {{ __('my-document.views.show.footer.form.button.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="margin-top-20">
                @if ($myDocument->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myDocument->owner))
                    <a 
                        @if ($myDocument->belongsToProfile())
                            href="{{ route('my-profile.my-documents.create',[
                                'my_profile' => $myDocument->owner_id, 
                            ]) }}"
                        @elseif ($myDocument->belongsToGroup())
                            href="{{ route('my-group.my-documents.create',[
                                'my_group' => $myDocument->owner_id, 
                            ]) }}"
                        @endif
                        class="button add"
                    >
                        <i class="sl sl-icon-plus"></i>
                        {{ __('my-document.views.show.footer.button.another-document') }}
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