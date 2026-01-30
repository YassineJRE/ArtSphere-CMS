@isset($myArtwork)
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="my-profile-buttons">
                <div class="col-md-6 left-buttons">
                    @if ($myArtwork->exhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myArtwork->exhibit->owner))
                        <a 
                            @if ($myArtwork->exhibit->belongsToProfile())
                                href="{{ route('my-profile.my-exhibits.my-artworks.edit',[
                                    'my_profile' => $myArtwork->exhibit->owner_id,
                                    'my_exhibit' => $myArtwork->exhibit->id,
                                    'my_artwork' => $myArtwork->id
                                ]) }}"
                            @elseif ($myArtwork->exhibit->belongsToGroup())
                                href="{{ route('my-group.my-exhibits.my-artworks.edit',[
                                    'my_group' => $myArtwork->exhibit->owner_id,
                                    'my_exhibit' => $myArtwork->exhibit->id,
                                    'my_artwork' => $myArtwork->id
                                ]) }}"
                            @endif
                            class="button edit"
                        ><i class="sl sl-icon-note"></i> {{ __('my-artwork.views.show.footer.button.edit') }}</a>
                    @endif
                    <a 
                        @if ($myArtwork->exhibit->belongsToProfile())
                            href="{{ route('app.profiles.exhibits.artworks.show',[
                                'profile' => $myArtwork->exhibit->owner_id,
                                'exhibit' => $myArtwork->exhibit->id,
                                'artwork' => $myArtwork->id
                            ]) }}"
                        @elseif ($myArtwork->exhibit->belongsToGroup())
                            href="{{ route('app.groups.exhibits.artworks.show',[
                                'group' => $myArtwork->exhibit->owner_id,
                                'exhibit' => $myArtwork->exhibit->id,
                                'artwork' => $myArtwork->id
                            ]) }}"
                        @endif
                        class="button add"
                    >
                        <i class="sl sl-icon-eye"></i> 
                        {{ __('my-artwork.views.show.footer.button.view') }}
                    </a>

                    <br>
                    @if ($myArtwork->exhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myArtwork->exhibit->owner))
                        <a 
                            @if ($myArtwork->exhibit->belongsToProfile())
                                href="{{ route('my-profile.my-exhibits.my-artworks.create',[
                                    'my_profile' => $myArtwork->exhibit->owner_id,
                                    'my_exhibit' => $myArtwork->exhibit->id,
                                ]) }}"
                            @elseif ($myArtwork->exhibit->belongsToGroup())
                                href="{{ route('my-group.my-exhibits.my-artworks.create',[
                                    'my_group' => $myArtwork->exhibit->owner_id,
                                    'my_exhibit' => $myArtwork->exhibit->id,
                                ]) }}"
                            @endif
                            class="button add"
                        >
                            <i class="sl sl-icon-plus"></i>
                            {{ __('my-artwork.views.show.footer.button.another-artwork') }}
                        </a>
                    @endif
                </div>
                <div class="col-md-6 right-buttons">
                    @if ($myArtwork->getFirstMedia())
                        <a 
                            href="javascript:$('.downloadform').submit()"
                            class="button download"
                            download
                        >
                            <i class="fa fa-download"></i>
                            {{ __('my-artwork.views.show.footer.button.download') }}
                        </a>
                    @endif

                    @if ($myArtwork->exhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myArtwork->exhibit->owner))
                        <a href="#delete-row-dialog-{{ $myArtwork->id }}" class="button delete popup-delete-row right">
                            <i class="sl sl-icon-trash"></i>
                            {{ __('my-artwork.views.show.footer.button.delete') }}
                        </a>
                        <div id="delete-row-dialog-{{ $myArtwork->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ __('my-artwork.views.show.footer.h3.delete') }}</h3>
                            </div>
                            <div class="sign-in-form style-1">
                                <p>{{ __('my-artwork.views.show.footer.p.sure') }}</p>
                                <form 
                                    method="post"
                                    @if ($myArtwork->exhibit->belongsToProfile())
                                        action="{{ route('my-profile.my-exhibits.my-artworks.destroy',[
                                            'my_profile' => $myArtwork->exhibit->owner_id,
                                            'my_exhibit' => $myArtwork->exhibit->id,
                                            'my_artwork' => $myArtwork->id
                                        ]) }}"
                                    @elseif ($myArtwork->exhibit->belongsToGroup())
                                        action="{{ route('my-group.my-exhibits.my-artworks.destroy',[
                                            'my_group' => $myArtwork->exhibit->owner_id,
                                            'my_exhibit' => $myArtwork->exhibit->id,
                                            'my_artwork' => $myArtwork->id
                                        ]) }}"
                                    @endif
                                >
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button">
                                        {{ __('my-artwork.views.show.footer.form.button.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if ($myArtwork->getFirstMedia())
                        @if (__('my-artwork.views.show.footer.label.choose') == 'Choisi un type de document: ')
                            <a class="advanced" onclick=options() href="javascript:{}" style="display:block;text-align:right;padding-right:19%;" >{{__('my-artwork.views.show.footer.a.advanced') }} +</a>
                        @elseif((__('my-artwork.views.show.footer.label.choose') == 'Choose a document type: '))
                            <a class="advanced" onclick=options() href="javascript:{}" style="display:block;text-align:right;padding-right:22%;" >{{__('my-artwork.views.show.footer.a.advanced') }} +</a>
                        @endif
                        <form 
                            method="POST" 
                            class="downloadform" 
                            id="downloadform" 
                            action="{{ route('my-profile.my-exhibits.my-artworks.artwork-download',[
                                'my_profile' => $myArtwork->exhibit->owner_id,
                                'my_group' => $myArtwork->exhibit->owner_id,
                                'my_exhibit' => $myArtwork->exhibit->id,
                                'my_artwork' => $myArtwork->id
                            ]) }}"
                        >
                            @csrf
                            @if(__('my-artwork.views.show.footer.label.choose') == 'Choose a document type: ')
                                <label for="filetype" class="choose" style="display:inline-block;padding-right:13%;" >{{__('my-artwork.views.show.footer.label.choose') }}</label><br>
                            @elseif(__('my-artwork.views.show.footer.label.choose') == 'Choisi un type de document: ')
                                <label for="filetype" class="choose" style="display:inline-block;padding-right:10%;" >{{__('my-artwork.views.show.footer.label.choose') }}</label><br>
                            @endif
                            <select class="chosen-select" name="filetype" id="filetype" style="width:45%;display:inline-block;height:10%;">
                                <option name="documents" value="docx">.docx</option>
                                <option name="documents" value="pdf">.pdf</option>
                                <option name="documents" value="xlsx">.xlsx</option>
                                <option name="documents" value="csv">.csv</option>
                            </select> 
                            <input type="hidden" id="artworkid" name="artworkid" value="{{$myArtwork->id}}">
                            <input type="hidden" id="myname"  name="myname" value="{{ $myArtwork->exhibit->owner->getName() }}">
                        </form>
                    @endif
                </div>
            </div>
            <div class="margin-top-20"></div>
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
                $('.downloadform').hide()
            });
            var open = false;
            function options(){
               switch(open){
                case true: 
                    $('.advanced').html("{{__('my-exhibit.views.show.footer.a.advanced') }} +")
                    $('.downloadform').hide(['transfer', 'right'], 'linear', 400);
                    open = false;
                    break;
                case false: 
                    $('.advanced').html("{{__('my-exhibit.views.show.footer.a.advanced') }} -")
                    $('.downloadform').show(['drop', 'down'], 'linear', 400);
                    $("html, body").animate({
                    scrollTop: $(
                      'html, body').get(0).scrollHeight
                    }, 1000);
                    open = true; 
                    break; 
               }
            }
        </script>
    @endpush
@endisset