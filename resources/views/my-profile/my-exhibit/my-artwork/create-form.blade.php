@isset($myExhibit)
    <div class="container woocommerce">
        <div class="woocommerce col-md-12">
            <form
                @if ($myExhibit->belongsToProfile())
                    action="{{ route('my-profile.my-exhibits.my-artworks.store',[
                        'my_profile' => $myExhibit->owner_id,
                        'my_exhibit' => $myExhibit->id
                    ]) }}"
                @elseif ($myExhibit->belongsToGroup())
                    action="{{ route('my-group.my-exhibits.my-artworks.store',[
                        'my_group' => $myExhibit->owner_id,
                        'my_exhibit' => $myExhibit->id
                    ]) }}"
                @endif
                class="register"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="form-row col-md-5">
                    <label for="media">{{ __('my-artwork.views.create.form.p.label.file') }}</label>
                    <div class="uploadzone">
                        <div class="uz-preview hidden">
                            <div class="uz-image">
                                <img alt="preview media">
                            </div>
                            <a class="uz-remove"
                                href="javascript:void(0);"
                            >{{ __('my-artwork.views.create.form.button.remove-file') }}</a>
                        </div>
                        <a class="btn-file">
                            <i class="fa fa-upload"></i> {{ __('my-artwork.views.create.form.p.label.choose-file') }}
                            <input
                                class="uz-input"
                                type="file"
                                name="media"
                                id="media"
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                            >
                        </a>
                    </div>
                    @if ($errors->has('media'))
                        <span class="text-danger">{{ $errors->first('media') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-1 margin-top-25 text-center">
                    <h3>{{ __('my-artwork.views.create.form.h3.or') }}</h3>
                </div>
                <div class="form-row col-md-6">
                    <label for="video_url">{{ __('my-artwork.views.create.form.p.label.video-url') }}</label>
                    <div id="video_preview" class="video-preview"></div>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('video_url')) invalid @endif"
                        name="video_url"
                        id="video_url"
                        placeholder="{{ __('my-artwork.views.create.form.p.label.url') }}"
                    >
                    <span class="text-danger" id="video_preview-error" style="display: none;">
                        {{ __('my-artwork.views.create.form.span.not-valid') }}
                    </span>
                    @if ($errors->has('video_url'))
                        <span class="text-danger">{{ $errors->first('video_url') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="name">{{ __('my-artwork.views.create.form.p.label.artwork-name') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('name')) invalid @endif"
                        name="name"
                        id="name"
                        value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="description">{{ __('my-artwork.views.create.form.p.label.description') }}</label>
                    <textarea
                        class="input-text form-control @if ($errors->has('description')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="description"
                        name="description"
                        placeholder=""></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="location">{{ __('my-artwork.views.create.form.p.label.location') }} </label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('location')) invalid @endif"
                        name="location"
                        id="location"
                        value="{{ old('location') }}">
                    @if ($errors->has('location'))
                        <span class="text-danger">{{ $errors->first('location') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="date">{{ __('my-artwork.views.create.form.p.label.date') }}</label>
                    <input
                        type="text"
                        class="input-text input-date form-control @if ($errors->has('date')) invalid @endif"
                        name="date"
                        id="date"
                        value="{{
                            old('date') ?
                                \Carbon\Carbon::parse(old('date'))->format('m/d/Y') : ''
                        }}"
                    >
                    @if ($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="medium">{{ __('my-artwork.views.create.form.p.label.medium') }} </label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('medium')) invalid @endif"
                        name="medium"
                        id="medium"
                        value="{{ old('medium') }}">
                    @if ($errors->has('medium'))
                        <span class="text-danger">{{ $errors->first('medium') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <span style="color: #ff6600;">{{ __('my-artwork.views.create.form.p.label.medium-text') }}</span>
                </div>
                <div class="col-md-4">
                    <label for="size_lenght">
                        {{ __('my-artwork.views.create.form.p.label.size-lenght') }}
                    </label>
                    <div class="select-input">
                        <i class="data-unit">cm</i>
                        <input
                            type="number"
                            min="0"
                            step="any"
                            class="input-text form-control @if ($errors->has('size_lenght')) invalid @endif"
                            name="size_lenght"
                            id="size_lenght"
                            data-unit="cm"
                            value="{{ old('size_lenght') }}"
                        >
                        @if ($errors->has('size_lenght'))
                            <span class="text-danger">{{ $errors->first('size_lenght') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="size_width">
                        {{ __('my-artwork.views.create.form.p.label.size-width') }}
                    </label>
                    <div class="select-input">
                        <i class="data-unit">cm</i>
                        <input
                            type="number"
                            min="0"
                            step="any"
                            class="input-text form-control @if ($errors->has('size_width')) invalid @endif"
                            name="size_width"
                            id="size_width"
                            data-unit="cm"
                            value="{{ old('size_width') }}"
                        >
                        @if ($errors->has('size_width'))
                            <span class="text-danger">{{ $errors->first('size_width') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="size_height">
                        {{ __('my-artwork.views.create.form.p.label.size-height') }}
                    </label>
                    <div class="select-input">
                        <i class="data-unit">cm</i>
                        <input
                            type="number"
                            min="0"
                            step="any"
                            class="input-text form-control @if ($errors->has('size_height')) invalid @endif"
                            name="size_height"
                            id="size_height"
                            data-unit="cm"
                            value="{{ old('size_height') }}"
                        >
                        @if ($errors->has('size_height'))
                            <span class="text-danger">{{ $errors->first('size_height') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row col-md-6">
                    <label for="photographer">{{ __('my-artwork.views.create.form.p.label.photographer') }}</label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('photographer')) invalid @endif"
                        name="photographer"
                        id="photographer"
                        value="{{ old('photographer') }}">
                    @if ($errors->has('photographer'))
                        <span class="text-danger">{{ $errors->first('photographer') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="photographer_link">{{ __('my-artwork.views.create.form.p.label.photographer-link') }}</label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('photographer_link')) invalid @endif"
                        name="photographer_link"
                        id="photographer_link"
                        value="{{ old('photographer_link') }}"
                        placeholder="https://photographer.com"
                    >
                    @if ($errors->has('photographer_link'))
                        <span class="text-danger">{{ $errors->first('photographer_link') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="grant_acknowledgement">{{ __('my-artwork.views.create.form.p.label.grant-acknowledgement') }}</label>
                    <textarea
                        class="input-text form-control @if ($errors->has('grant_acknowledgement')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="grant_acknowledgement"
                        name="grant_acknowledgement"
                        placeholder=""
                    ></textarea>
                    @if ($errors->has('grant_acknowledgement'))
                        <span class="text-danger">{{ $errors->first('grant_acknowledgement') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="other_acknowledgement">{{ __('my-artwork.views.create.form.p.label.other-acknowledgement') }}</label>
                    <textarea
                        class="input-text form-control @if ($errors->has('other_acknowledgement')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="other_acknowledgement"
                        name="other_acknowledgement"
                        placeholder=""
                    ></textarea>
                    @if ($errors->has('other_acknowledgement'))
                        <span class="text-danger">{{ $errors->first('other_acknowledgement') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <input
                        type="hidden"
                        name="http_referer"
                        value="{{ old('http_referer') ?? request()->headers->get('referer') }}"
                    >
                    <input
                        type="submit"
                        class="button"
                        name="save"
                        value="{{ __('my-artwork.views.create.form.p.button.save') }}"
                    >
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/scripts/video-media.js') }}" type="text/javascript"></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var wordpress_date_format = {"date":"MM\/DD\/YYYY","day":"1","raw":"F j, Y","time":"g:i a"};
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
                    $(this).val(picker.startDate.format(wordpress_date_format.date)).trigger("change");
                });
                $('.input-date').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('').trigger("change");
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function (e) {
                showVideoPreview();
                $('#video_url').bind("change keyup input", function() {
                    showVideoPreview();
                });
            });
            function showVideoPreview() {
                $("#video_preview").hide();
                $('#video_preview-error').hide();
                var url = $('#video_url').val();

                if (getYouTubeVideoIdFromUrl(url)) {
                    $("#video_preview").html('<iframe src="' + generateYouTubeUrl(getYouTubeVideoIdFromUrl(url)) + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>').show();
                } else if (getVimeoIdFromUrl(url)) {
                    $("#video_preview").html('<iframe src="' + generateVimeoUrl(getVimeoIdFromUrl(url)) + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>').show();
                } else if (url != '') {
                    $('#video_preview-error').show();
                }
            }
        </script>
    @endpush
@endisset
