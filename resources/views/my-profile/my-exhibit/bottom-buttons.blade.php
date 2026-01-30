@isset($myExhibit)
    @php 
        $artworks = $myExhibit->artworks()->get();
        $counter = 2; 
        $i;
    @endphp
    <div class="row">
        <div class="col-md-12 my-profile">
            <div class="my-profile-buttons">
                <div class="col-md-6 left-buttons">
                    @if ($myExhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myExhibit->owner))
                        <a 
                            @if ($myExhibit->belongsToProfile())
                                href="{{ route('my-profile.my-exhibits.edit',[
                                    'my_profile' => $myExhibit->owner_id, 
                                    'my_exhibit' => $myExhibit->id
                                ]) }}"
                            @elseif ($myExhibit->belongsToGroup())
                                href="{{ route('my-group.my-exhibits.edit',[
                                    'my_group' => $myExhibit->owner_id,
                                    'my_exhibit' => $myExhibit->id
                                ]) }}"
                            @endif
                            class="button edit"
                        ><i class="sl sl-icon-note"></i> {{ __('my-exhibit.views.show.footer.button.edit') }}</a>
                    @endif
                    <a 
                        @if ($myExhibit->belongsToProfile())
                            href="{{ route('app.profiles.exhibits.show',[
                                'profile' => $myExhibit->owner_id, 
                                'exhibit' => $myExhibit->id
                            ]) }}"
                        @elseif ($myExhibit->belongsToGroup())
                            href="{{ route('app.groups.exhibits.show',[
                                'group' => $myExhibit->owner_id,
                                'exhibit' => $myExhibit->id
                            ]) }}"
                        @endif
                        class="button add"
                    ><i class="sl sl-icon-eye"></i> {{ __('my-exhibit.views.show.footer.button.view') }}</a>
                    {{-- @if ($myExhibit->canChangeStatus())
                        <a 
                            @if ($myExhibit->belongsToProfile())
                                href="{{ route('my-profile.my-exhibits.toggle-enable',[
                                    'my_profile' => $myExhibit->owner_id,
                                    'my_exhibit' => $myExhibit->id
                                ]) }}"
                            @elseif ($myExhibit->belongsToGroup())
                                href="{{ route('my-group.my-exhibits.toggle-enable',[
                                    'my_group' => $myExhibit->owner_id,
                                    'my_exhibit' => $myExhibit->id
                                ]) }}"
                            @endif
                            class="button publish"
                        >
                            @if ($myExhibit->isEnabled())
                                <i class="sl sl-icon-close"></i> {{ __('my-exhibit.views.show.footer.button.unpublish') }}
                            @else
                                <i class="sl sl-icon-check"></i> {{ __('my-exhibit.views.show.footer.button.publish') }}
                            @endif
                        </a>
                    @endif --}}

                    @if ($myExhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myExhibit->owner))
                        <br>
                        <a 
                            @if ($myExhibit->belongsToProfile())
                                href="{{ route('my-profile.my-exhibits.create',[
                                    'my_profile' => $myExhibit->owner_id
                                ]) }}"
                            @elseif ($myExhibit->belongsToGroup())
                                href="{{ route('my-group.my-exhibits.create',[
                                    'my_group' => $myExhibit->owner_id,
                                ]) }}"
                            @endif
                            class="button add"
                        >
                            <i class="sl sl-icon-plus"></i>
                            {{ __('my-exhibit.views.show.footer.button.another-exhibit') }}
                        </a>
                    @endif
                </div>
                <div class="col-md-6 right-buttons">
                    @if ($myExhibit->belongsToProfile() || app('profile.session')->isAdministratorOfThisGroup($myExhibit->owner))
                        @if ($myExhibit->canResendInvitationMail())
                            <a href="{{ route('invitations.resend-invitation-mail',[
                                    'user_invitation' => $myExhibit->unprocessedInvitation()
                                ]) }}"
                                class="button publish"
                            ><i class="sl sl-icon-envolope"></i> {{ __('my-exhibit.views.show.footer.button.resend-invitation-mail') }}</a>
                        @elseif ($myExhibit->canTransfer())
                            <a 
                                @if ($myExhibit->belongsToProfile())
                                    href="{{ route('my-profile.my-exhibits.transfer-to',[
                                        'my_profile' => $myExhibit->owner_id,
                                        'my_exhibit' => $myExhibit->id
                                    ]) }}"
                                @elseif ($myExhibit->belongsToGroup())
                                    href="{{ route('my-group.my-exhibits.transfer-to',[
                                        'my_group' => $myExhibit->owner_id,
                                        'my_exhibit' => $myExhibit->id
                                    ]) }}"
                                @endif
                                class="button publish"
                            ><i class="sl sl-icon-envolope"></i> {{ __('my-exhibit.views.show.footer.button.transfer') }}</a>
                        @endif

                        @if (count($artworks) < 10)
                            <a href="javascript:$('.advancedoptions').submit()";  
                                class="button download"
                                >
                                <i class="fa fa-download"></i>
                                {{ __('my-exhibit.views.show.ul.li.button.download') }}
                            </a>
                        @elseif (count($artworks) >= 10)
                            <a href="javascript:$('.advancedoptionslg').submit()";  
                                class="button download"
                            >
                                <i class="fa fa-download"></i>
                                {{ __('my-exhibit.views.show.ul.li.button.download') }}
                            </a>
                        @endif

                        <a href="#delete-row-dialog-{{ $myExhibit->id }}" class="button delete popup-delete-row">
                            <i class="sl sl-icon-trash"></i>
                            {{ __('my-exhibit.views.show.footer.button.delete') }}
                        </a>

                        <br>
                        @if (__('my-exhibit.views.show.footer.label.filetype') == 'Sélectionner le type de fichier:')
                            <a class="advanced" onclick=options() href="javascript:{}">{{__('my-exhibit.views.show.footer.a.advanced') }} +</a>
                        @elseif((__('my-exhibit.views.show.footer.label.filetype') == 'Choose a document type:'))
                            <a class="advancedfr" onclick=options() href="javascript:{}">{{__('my-exhibit.views.show.footer.a.advanced') }} +</a>
                        @endif

                        <div id="delete-row-dialog-{{ $myExhibit->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ __('my-exhibit.views.show.footer.h3.delete') }}</h3>
                            </div>
                            <div class="sign-in-form style-1">
                                <p>{{ __('my-exhibit.views.show.footer.p.sure') }}</p>
                                <form 
                                    method="post"
                                    @if ($myExhibit->belongsToProfile())
                                        action="{{ route('my-profile.my-exhibits.destroy',[
                                            'my_profile' => $myExhibit->owner_id,
                                            'my_exhibit' => $myExhibit->id
                                        ]) }}"
                                    @elseif ($myExhibit->belongsToGroup())
                                        action="{{ route('my-group.my-exhibits.destroy',[
                                            'my_group' => $myExhibit->owner_id,
                                            'my_exhibit' => $myExhibit->id
                                        ]) }}"
                                    @endif
                                >
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="button">
                                        {{ __('my-exhibit.views.show.footer.form.button.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>

                        <br/>
                        <form
                            method="post"
                            class="@if(count($artworks) < 10)advancedoptions @else advancedoptionslg @endif"
                            action="{{ route('my-profile.my-exhibits.exhibit-download',[
                                'my_profile' => $myExhibit->owner_id,
                                'my_exhibit' => $myExhibit->id
                            ]) }}"
                        >
                            @csrf
                            <label for="filetype" class="filetype">{{__('my-exhibit.views.show.footer.label.filetype') }}</label>
                            <select name="filetype" id="filetype" class="chosen-select">
                                <option  id="docx" name="filetype" value="docx">.docx</option>
                                <option  id="csv" name="filetype" value="csv">.csv</option>
                                <option  id="xlsx" name="filetype" value="xlsx">.xlsx</option>
                                <option  id="pdf" name="filetype" value="pdf">.pdf</option>
                            </select>
                            <hr>
                            <label class="artworks">{{__('my-exhibit.views.show.footer.label.artworks') }}</label>
                            <table>
                                @if(count($artworks) < 10)
                                    @for($i = 1; $i<=count($artworks); $i++)
                                        @if($i > 2 && $i % 2 != 0)
                                            </tr>
                                        @endif
                                        @if($i == 1 || $i % 2 != 0)
                                            <tr>
                                        @endif
                                        <td>
                                            <label for="{{$i}}">{{$artworks[$i-1]->name}}</label>
                                            <input type="checkbox" id="{{$i}}" name="{{$i}}" value="{{$i}}" checked>
                                        </td>
                                        @if($i == count($artworks))
                                            </tr>
                                        @endif
                                    @endfor
                                @endif
                                @if(count($artworks) >= 10)
                                    @for($i = 1; $i<=count($artworks); $i++)
                                        @if($i > 2 && ($i - 1) % 5 == 0)
                                            </tr>
                                        @endif
                                        @if($i == 1 || $i - 1 % 5 == 0)
                                            <tr style="padding-left:0;margin-left:0;">
                                        @endif
                                        <td style="width:20%;padding-right:3%;">
                                            <label for="{{$i}}" style="text-align:center;" >{{$artworks[$i-1]->name}}</label>
                                            <input type="checkbox" id="{{$i}}" name="{{$i}}" value="{{$i}}" checked></td>
                                            @if($i == count($artworks))
                                                </tr>
                                            @endif
                                    @endfor
                                @endif
                            </table>
                            <input type="hidden" id="count" name="count" value="{{$i-1}}">
                            <input type="hidden" id="exhibitid" name="exhibitid" value="{{$myExhibit->id}}">
                            <input type="hidden" id="myname" name="myname" value="{{ $myExhibit->owner->getName() }}">
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
                $('.advancedoptions').hide();
                $('.advancedoptionslg').hide();
            });
            var open = false;
            function options() {
               switch(open) {
                case true:
                    $('.advanced').html("{{__('my-exhibit.views.show.footer.a.advanced') }} +")
                    $('.advancedoptions').hide(['transfer', 'right'], 'linear', 400);
                    $('.advancedoptionslg').hide(['transfer', 'right'], 'linear', 400);
                    open = false;
                    break;
                case false: 
                    $('.advanced').html("{{__('my-exhibit.views.show.footer.a.advanced') }} -")
                    $('.advancedoptions').show(['drop', 'down'], 'linear', 400);
                    $('.advancedoptionslg').show(['drop', 'down'], 'linear', 400);
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
