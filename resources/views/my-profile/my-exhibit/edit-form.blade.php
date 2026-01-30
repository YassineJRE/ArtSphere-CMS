@isset($myExhibit)
    <div class="container woocommerce">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="woocommerce col-md-12">
            <form
                @if ($myExhibit->belongsToProfile())
                    action="{{ route('my-profile.my-exhibits.update',[
                        'my_profile' => $myExhibit->owner_id,
                        'my_exhibit' => $myExhibit->id
                    ]) }}"
                @elseif ($myExhibit->belongsToGroup())
                    action="{{ route('my-group.my-exhibits.update',[
                        'my_group' => $myExhibit->owner_id,
                        'my_exhibit' => $myExhibit->id
                    ]) }}"
                @endif
                class="register"
                method="post"
            >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row col-md-5">
                    <label for="name">{{ __('my-exhibit.views.edit.form.p.label.exhibit-name') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('name')) invalid @endif"
                        name="name"
                        id="name"
                        value="{{ old('name') ?? $myExhibit->name }}"
                    >
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-4">
                    <label for="type">{{ __('my-exhibit.views.edit.form.p.label.type') }} <span class="required">*</span></label>
                    <select
                        data-placeholder="{{ @old('type') }}"
                        class="chosen-select @if ($errors->has('type')) invalid_ @endif"
                        name="type"
                        id="type"
                    >
                        <option value=""></option>
                        @foreach ($exhibitTypes as $exhibitType)
                            <option
                                value="{{ $exhibitType }}"
                                @if (
                                    ($myExhibit->type == $exhibitType)
                                    ||
                                    (@old('type') && @old('type') == $exhibitType)
                                )
                                    selected
                                @endif
                            >{{ __('enums.exhibit-type.'.$exhibitType) }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                </div>
				
				<!-- Add referenced artworks -->
				
				<div class="form-row col-md-3">
                    <label>References</label>
                    <a id="btnAddArtworks" role="button" class="elementor-button" style="width: 100%; border: 5px solid #ff6600 !important;">
                        <span class="elementor-button-content-wrapper">
                            <span class="elementor-button-text">
                                <i class="sl sl-icon-plus"></i>
                                Add Artworks
                            </span>
                        </span>
                    </a>
                </div>
				
				<dialog id="addArtworks" class="woocommerce col-md-12 margin-top-10" style="position: fixed; background: #fff; padding: 20px; z-index: 1100; margin-left: 2%; margin-right: 2%; width: 96%;">
                    <h2 style="font-weight: bold;">Add Artworks from other Exhibits</h2>
        
                    <p>First select the desired exhibit and search for its artworks. Then feel free to drag and drop any artwork you would like to add to the "Added Artworks" window.</p>

                    <div class="form-row col-md-6">
                        <h3>Choose exhibit:</h3>

                        <select style="max-width: 80%;"
                                data-placeholder="{{ @old('exhibit_id') }}"
                                class="col-md-8"
                                name="exhibit_id_add_artworks"
                                id="exhibit_id_add_artworks"
                        >
                            @foreach ($myProfile->getAllExhibits() as $exhibit)

							@if($exhibit->id != $myExhibit->id)

                            <option value="{{ $exhibit->id }}">{{ $exhibit->name }}</option>
							
							@endif

                            @endforeach
                        </select>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="button" style="border: 3px solid #ff6600 !important; margin-left: 10px;" id="sendSearchForArtworks">
                            Search
                        </button>

                        <div id="artworksToAdd" class="droppable-area">

                        </div>

                    
                    </div>

                    <div class="form-row col-md-6">
                        
                        <h3>Added artworks</h3>
                        <div id="addedArtworks" style="min-height:10em;" class="droppable-area form-row">
                            
                        </div>
                        <div class="form-row col-md-12" style="margin-top: 20px; padding-left: 0px; padding-right: 0px;">
                        
                            <button class="button woocommerce-button col-md-6" type="button" name="cancel" value="Cancel" style="margin: 0; border: 1px solid #ff6600; float: right;" id="saveArtworks_button">
                                Save
                            </button>
                            
                        </div>
                    </div>

                </dialog>
				
				<!-- End Add referenced artworks -->
				
                <div class="form-row col-md-12">
                    <label for="description">{{ __('my-exhibit.views.edit.form.p.label.description') }}</label>
                    <textarea
                        class="input-text form-control @if ($errors->has('description')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="description"
                        name="description"
                        placeholder="">{{ old('description') ?? $myExhibit->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <span style="color: #ff6600;">{{ __('my-exhibit.views.edit.form.p.label.description-text') }}</span>
                </div>
                
                <div class="form-row col-md-12">
                    <label for="gallery">{{ __('my-exhibit.views.create.form.p.label.gallery') }}</label>
					
                    @include('my-profile.my-exhibit.gallery-select', [
                        'errors'=>$errors,
                        'gallery_id_output'=>'#gallery_id',
                        'gallery_name_output'=>'#gallery_name' ,
                        'select_id_input'=>'gallery',
                        'preselected' => ['value'=>old('verifier_id') ?? $myExhibit->verifier_id,'text'=>old('gallery_name') ?? $myExhibit->gallery?->name]
                    ])

                    <div id="invite_gallery_message" style="margin-top: 10px;">
                        Is the gallery not listed above? <a onclick="inviteGallery()" style="color: #ff6600;">Invite gallery</a>
                    </div>
                    <input type="hidden" id="gallery_id" name="verifier_id" value="{{ old('verifier_id') ?? $myExhibit->verifier_id }}">
                    <input type="hidden" id="gallery_name" name="gallery_name" value="{{ old('gallery_name') ?? $myExhibit->gallery?->name }}">
					
					
                    @if ($errors->has('gallery'))
                        <span class="text-danger">{{ $errors->first('gallery') }}</span>
                    @endif
                </div>

                <div class="form-row col-md-12">
                    <label for="location">{{ __('my-exhibit.views.edit.form.p.label.location') }}</label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('location')) invalid @endif"
                        name="location"
                        id="location"
                        value="{{ old('location') ?? $myExhibit->location }}">
                    @if ($errors->has('location'))
                        <span class="text-danger">{{ $errors->first('location') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="upcoming_date">{{ __('my-exhibit.views.edit.form.p.label.upcoming-date') }}</label>
                    <input
                        type="text"
                        class="input-text input-date form-control @if ($errors->has('upcoming_date')) invalid @endif"
                        name="_upcoming_date"
                        id="upcoming_date"
                        value="{{ 
                            is_null($myExhibit->upcoming_date) && is_null(old('upcoming_date')) ? 
                                '' : \Carbon\Carbon::parse($myExhibit->upcoming_date ?? old('upcoming_date'))->format('m/d/Y')
                        }}"
                    >
                    <input
                        type="hidden"
                        name="upcoming_date"
                        value="{{ \Carbon\Carbon::parse($myExhibit->upcoming_date ?? old('upcoming_date'))->format('Y-m-d') }}"
                        value="{{ 
                            is_null($myExhibit->upcoming_date) && is_null(old('upcoming_date')) ? 
                                '' : \Carbon\Carbon::parse($myExhibit->upcoming_date ?? old('upcoming_date'))->format('Y-m-d')
                        }}"
                    >
                    @if ($errors->has('upcoming_date'))
                        <span class="text-danger">{{ $errors->first('upcoming_date') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="open_at">{{ __('my-exhibit.views.edit.form.p.label.open-at') }}</label>
                    <input
                        type="text"
                        class="input-text input-datetime form-control @if ($errors->has('open_at')) invalid @endif"
                        name="_open_at"
                        id="open_at"
                        value="{{
                            is_null($myExhibit->open_at) && is_null(old('open_at')) ?
                                '' : \Carbon\Carbon::parse($myExhibit->open_at ?? old('open_at'))->format('m/d/Y h:m A') 
                        }}"
                    >
                    <input
                        type="hidden"
                        name="open_at"
                        value="{{
                            is_null($myExhibit->open_at) && is_null(old('open_at')) ?
                                '' : \Carbon\Carbon::parse($myExhibit->open_at ?? old('open_at'))->format('Y-m-d h:m:s') 
                        }}"
                    >
                    @if ($errors->has('open_at'))
                        <span class="text-danger">{{ $errors->first('open_at') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="special_thanks">{{ __('my-exhibit.views.edit.form.p.label.thanks') }}</label>
                    <textarea
                        class="input-text form-control @if ($errors->has('special_thanks')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="special_thanks"
                        name="special_thanks"
                        placeholder="">{{ $myExhibit->special_thanks ?? old('special_thanks') }}</textarea>
                    @if ($errors->has('special_thanks'))
                        <span class="text-danger">{{ $errors->first('special_thanks') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12 margin-top-15">
                    <p>{{ __('my-exhibit.views.edit.form.p.label.additional-information-content') }}</p>
                </div>
                <div class="form-row col-md-6">
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                        name="additional_information_title"
                        id="additional_information_title"
                        placeholder="{{ __('my-exhibit.views.edit.form.p.label.additional-information-title') }}"
                        value="{{ old('additional_information_title') ?? $myExhibit->additional_information_title }}"
                    >
                    @if ($errors->has('additional_information_title'))
                        <span class="text-danger">{{ $errors->first('additional_information_title') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <textarea
                        class="input-text form-control @if ($errors->has('additional_information_content')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="additional_information_content"
                        name="additional_information_content"
                        placeholder=""
                    >{{ old('additional_information_content') ?? $myExhibit->additional_information_content }}</textarea>
                    @if ($errors->has('additional_information_content'))
                        <span class="text-danger">{{ $errors->first('additional_information_content') }}</span>
                    @endif
                </div>
                @if ($myExhibit->canChangeStatus())
                    <div class="form-row col-md-6">
                        <label for="status">{{ __('my-exhibit.views.edit.form.p.label.status') }}</label>
                        <select
                            data-placeholder="{{ @old('status') }}"
                            class="chosen-select @if ($errors->has('status')) invalid_ @endif"
                            name="status"
                            id="status"
                        >
                            @foreach ($statuses as $status)
                                <option
                                    value="{{ $status }}"
                                    @if (
                                            (@old('status') && @old('status') == $status)
                                            ||
                                            ($myExhibit->status == $status)
                                        )
                                        selected
                                    @endif
                                >{{ __('enums.status.'.$status) }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                @endif
                @if ($myExhibit->canTransfer())
                    <div class="form-row col-md-12 margin-top-10">
                        {{ __('my-exhibit.views.edit.form.p.transfer-text') }}
                    </div>
                @endif
                @if ($myExhibit->isVerified())
                    <div class="form-row col-md-12 margin-top-10">
                        <span class="text-danger"><b>{{__('my-exhibit.views.edit.form.p.verified-reset-warning')}}</b></span>
                    </div>    
                @endif
                <div class="form-row col-md-12 my-profile @if ($myExhibit->canTransfer())with-separator @endif">
                    <div class="margin-top-10">
                        <input
                            type="hidden"
                            name="http_referer"
                            value="{{ old('http_referer') ?? request()->headers->get('referer') }}"
                        >
                        <input
                            type="submit"
                            class="button"
                            name="save"
                            value="{{ __('my-exhibit.views.edit.form.p.button.save') }}"
                        >
                        @if ($myExhibit->canTransfer())
                            <input
                                type="submit"
                                class="button publish"
                                name="transfer"
                                value="{{ __('my-exhibit.views.edit.form.p.button.transfer') }}"
                            >
                        @endif
                    </div>
                </div>
            </form>
            @include('my-profile.my-exhibit.gallery-invite-form',['myProfile'=>$myProfile, 'gallery_id_output' => '#gallery_id', 'gallery_select_output'=>'#gallery'])
        </div>
    </div>

    @push('scripts')
        <!-- Get the JS to make the autocomplete work on Galleries -->    
        <script src="{{ asset('js/scripts/autocomplete.js') }}"></script>
        
        <script type='text/javascript' id='listeo-custom-js-extra'>
            /* <![CDATA[ */
            var wordpress_date_format = {"date":"MM\/DD\/YYYY","day":"1","raw":"F j, Y","time":"hh:mm A"};
            var listeo = {"ajaxurl":"\/wp-admin\/admin-ajax.php","theme_url":"https:\/\/listeo.pro\/wp-content\/themes\/listeo"};
            var listeo_core = {
                "ajax_url":"\/wp-admin\/admin-ajax.php",
                "payout_not_valid_email_msg":"The email address is not valid. Please add a valid email address.",
                "is_rtl":"0",
                "lang":"",
                "_price_min":null,
                "_price_max":null,
                "currency":"USD",
                "currency_position":"before",
                "currency_symbol":"$",
                "submitCenterPoint":"40.757662,-73.974741",
                "centerPoint":"40.757662,-73.974741",
                "country":"",
                "upload":"https:\/\/listeo.pro\/wp-admin\/admin-ajax.php?action=handle_dropped_media",
                "delete":"https:\/\/listeo.pro\/wp-admin\/admin-ajax.php?action=handle_delete_media",
                "color":"#f91942",
                "dictDefaultMessage":"Drop files here to upload",
                "dictFallbackMessage":"Your browser does not support drag'n'drop file uploads.",
                "dictFallbackText":"Please use the fallback form below to upload your files like in the olden days.",
                "dictFileTooBig":"File is too big (__filesize__ MiB). Max filesize: __maxFilesize__MiB.",
                "dictInvalidFileType":"You can't upload files of this type.",
                "dictResponseError":"Server responded with __statusCode__ code.",
                "dictCancelUpload":"Cancel upload",
                "dictCancelUploadConfirmation":"Are you sure you want to cancel this upload?",
                "dictRemoveFile":"Remove file",
                "dictMaxFilesExceeded":"You can not upload any more files.",
                "areyousure":"Are you sure?",
                "maxFiles":"10",
                "maxFilesize":"2",
                "clockformat":"",
                "prompt_price":"Set price for this date",
                "menu_price":"Price (optional)",
                "menu_desc":"Description",
                "menu_title":"Title",
                "applyLabel":"Apply",
                "cancelLabel":"Cancel",
                "clearLabel":"Clear",
                "fromLabel":"From",
                "toLabel":"To",
                "customRangeLabel":"Custom",
                "mmenuTitle":"Menu",
                "pricingTooltip":"Click to make this item bookable in booking widget",
                "today":"Today",
                "yesterday":"Yesterday",
                "last_7_days":"Last 7 Days",
                "last_30_days":"Last 30 Days",
                "this_month":"This Month",
                "last_month":"Last Month",
                "map_provider":"mapbox",
                "address_provider":"osm",
                "mapbox_access_token":"pk.eyJ1IjoibWF0ZXVzenB0IiwiYSI6ImNrbnRoY2d1bTAyemcydXJtZ3lkNnVyMGoifQ.0EKYa25DjwN6tYDMgDe65Q",
                "mapbox_retina":"on",
                "mapbox_style_url":"https:\/\/api.mapbox.com\/styles\/v1\/mapbox\/streets-v11\/tiles\/{z}\/{x}\/{y}@2x?access_token=",
                "bing_maps_key":"",
                "thunderforest_api_key":"",
                "here_app_id":"",
                "here_app_code":"",
                "maps_reviews_text":"reviews",
                "maps_noreviews_text":"Not rated yet",
                "category_title":"Category Title",
                "day_short_su":"Su",
                "day_short_mo":"Mo",
                "day_short_tu":"Tu",
                "day_short_we":"We",
                "day_short_th":"Th",
                "day_short_fr":"Fr",
                "day_short_sa":"Sa",
                "radius_state":"enabled",
                "maps_autofit":"on",
                "maps_autolocate":"",
                "maps_zoom":"9",
                "maps_single_zoom":"9",
                "autologin":"",
                "no_results_text":"No results match",
                "no_results_found_text":"No results found",
                "placeholder_text_single":"Select an Option",
                "placeholder_text_multiple":"Select Some Options ",
                "january":"January",
                "february":"February",
                "march":"March",
                "april":"April",
                "may":"May",
                "june":"June",
                "july":"July",
                "august":"August",
                "september":"September",
                "october":"October",
                "november":"November",
                "december":"December",
                "opening_time":"Opening Time",
                "closing_time":"Closing Time",
                "remove":"Remove",
                "onetimefee":"One time fee",
                "multiguest":"Multiply by guests",
                "multidays":"Multiply by days",
                "multiguestdays":"Multiply by guest & days",
                "quantitybuttons":"Quantity Buttons",
                "booked_dates":"Those dates are already booked",
                "replied":"Replied",
                "recaptcha_status":"",
                "recaptcha_version":"v2",
                "recaptcha_sitekey3":"",
                "review_criteria":"service,value-for-money,location,cleanliness"
            };
            /* ]]> */
        </script>
        <script type="text/javascript">
        $(function () {
            $('.input-datetime').daterangepicker({
                timePicker: true,
                autoUpdateInput: false,
                singleDatePicker: true,
                // minDate: moment().subtract(0, 'days'),
                locale: {
                    format: wordpress_date_format.date,
                    "firstDay"    : parseInt(wordpress_date_format.day),
                    "applyLabel"  : listeo_core.applyLabel,
                    "cancelLabel" : listeo_core.clearLabel,
                    "fromLabel"   : listeo_core.fromLabel,
                    "toLabel"   : listeo_core.toLabel,
                    "customRangeLabel": listeo_core.customRangeLabel,
                    "daysOfWeek": [
                        listeo_core.day_short_su,
                        listeo_core.day_short_mo,
                        listeo_core.day_short_tu,
                        listeo_core.day_short_we,
                        listeo_core.day_short_th,
                        listeo_core.day_short_fr,
                        listeo_core.day_short_sa
                    ],
                    "monthNames": [
                        listeo_core.january,
                        listeo_core.february,
                        listeo_core.march,
                        listeo_core.april,
                        listeo_core.may,
                        listeo_core.june,
                        listeo_core.july,
                        listeo_core.august,
                        listeo_core.september,
                        listeo_core.october,
                        listeo_core.november,
                        listeo_core.december,
                    ],
                },
            });
            $('.input-datetime').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY hh:mm A')).trigger("change");
                var name = $(this).attr('name').slice(1);
                $('input[name="'+name+'"]').val(picker.startDate.format('YYYY-MM-DD hh:mm:ss')).trigger("change");
            });
            $('.input-datetime').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('').trigger("change");
                var name = $(this).attr('name').slice(1);
                $('input[name="'+name+'"]').val('').trigger("change");
            });

            $('.input-date').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                // minDate: moment().subtract(0, 'days'),
                locale: {
                    format: wordpress_date_format.date,
                    "firstDay"    : parseInt(wordpress_date_format.day),
                    "applyLabel"  : listeo_core.applyLabel,
                    "cancelLabel" : listeo_core.clearLabel,
                    "fromLabel"   : listeo_core.fromLabel,
                    "toLabel"   : listeo_core.toLabel,
                    "customRangeLabel": listeo_core.customRangeLabel,
                    "daysOfWeek": [
                        listeo_core.day_short_su,
                        listeo_core.day_short_mo,
                        listeo_core.day_short_tu,
                        listeo_core.day_short_we,
                        listeo_core.day_short_th,
                        listeo_core.day_short_fr,
                        listeo_core.day_short_sa
                    ],
                    "monthNames": [
                        listeo_core.january,
                        listeo_core.february,
                        listeo_core.march,
                        listeo_core.april,
                        listeo_core.may,
                        listeo_core.june,
                        listeo_core.july,
                        listeo_core.august,
                        listeo_core.september,
                        listeo_core.october,
                        listeo_core.november,
                        listeo_core.december,
                    ],
                },
            });
            $('.input-date').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY')).trigger("change");
                var name = $(this).attr('name').slice(1);
                $('input[name="'+name+'"]').val(picker.startDate.format('YYYY-MM-DD')).trigger("change");
            });
            $('.input-date').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('').trigger("change");
                var name = $(this).attr('name').slice(1);
                $('input[name="'+name+'"]').val('').trigger("change");
            });
        });
        </script>
    @endpush
@endisset