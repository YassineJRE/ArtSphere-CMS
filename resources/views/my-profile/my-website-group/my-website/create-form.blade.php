@isset($myWebsiteGroup)
    <div class="container woocommerce">
        <div class="woocommerce col-md-12">
            <form
                @if ($myWebsiteGroup->belongsToProfile())
                    action="{{ route('my-profile.my-website-groups.my-websites.store',[
                        'my_profile' => $myWebsiteGroup->owner_id,
                        'my_website_group' => $myWebsiteGroup->id
                    ]) }}"
                @elseif ($myWebsiteGroup->belongsToGroup())
                    action="{{ route('my-group.my-website-groups.my-websites.store',[
                        'my_group' => $myWebsiteGroup->owner_id,
                        'my_website_group' => $myWebsiteGroup->id
                    ]) }}"
                @endif
                class="register"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="form-row col-md-6">
                    <label for="url">{{ __('my-website.views.create.form.p.label.url') }} <span class="required">*</span></label>
                    <div id="website_preview" class="video-preview"></div>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('url')) invalid @endif"
                        name="url"
                        id="url"
                        placeholder="https://example.com"
                    >
                    <span class="text-danger" id="website_preview-error" style="display: none;">{{ __('my-website.views.create.form.span.not-valid') }}</span>
                    @if ($errors->has('url'))
                        <span class="text-danger">{{ $errors->first('url') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="media">{{ __('my-website.views.create.form.p.label.image') }} <span class="required">*</span></label>
                    <div class="uploadzone">
                        <div class="uz-preview hidden">
                            <div class="uz-image">
                                <img alt="preview media">
                            </div>
                            <a class="uz-remove"
                                href="javascript:void(0);"
                            >{{ __('my-website.views.create.form.button.remove-file') }}</a>
                        </div>
                        <a class="btn-file">
                            <i class="fa fa-upload"></i> {{ __('my-website.views.create.form.p.label.choose-file') }}
                            <input
                                class="uz-input"
                                type="file"
                                name="media"
                                id="media"
                                accept=".jpg,.jpeg,.png"
                            >
                        </a>
                    </div>
                    @if ($errors->has('media'))
                        <span class="text-danger">{{ $errors->first('media') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12 text-center">
                    <p><b>{{ __('my-website.views.create.form.p.label.image-text') }}<b></p>
                </div>
                <div class="form-row col-md-12">
                    <label for="title">{{ __('my-website.views.create.form.p.label.title') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('title')) invalid @endif"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        autofocus
                        required
                    >
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-4">
                    <label for="owner_name">{{ __('my-website.views.create.form.p.label.owner') }}</label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('owner_name')) invalid @endif"
                        name="owner_name"
                        id="owner_name"
                        value="{{ old('owner_name') }}">
                    @if ($errors->has('owner_name'))
                        <span class="text-danger">{{ $errors->first('owner_name') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-8">
                    <label for="owner_link">{{ __('my-website.views.create.form.p.label.owner-link') }}</label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('owner_link')) invalid @endif"
                        name="owner_link"
                        id="owner_link"
                        value="{{ old('owner_link') }}"
                        placeholder="https://owner.com"
                    >
                    @if ($errors->has('owner_link'))
                        <span class="text-danger">{{ $errors->first('owner_link') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="description">{{ __('my-website.views.create.form.p.label.description') }}</label>
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
                <div class="form-row col-md-12 margin-top-15">
                    <p>{{ __('my-website.views.create.form.p.label.additional-information-content') }}</p>
                </div>
                <div class="form-row col-md-6">
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                        name="additional_information_title"
                        id="additional_information_title"
                        value="{{ old('additional_information_title') }}"
                        placeholder="{{ __('my-website.views.create.form.p.label.additional-information-title') }}"
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
                    ></textarea>
                    @if ($errors->has('additional_information_content'))
                        <span class="text-danger">{{ $errors->first('additional_information_content') }}</span>
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
                        value="{{ __('my-website.views.create.form.p.button.save') }}"
                    >
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/scripts/video-media.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
/*        
            $(document).ready(function (e) {
                showWebsitePreview();
                $('#url').bind("change keyup input", function() {
                    showWebsitePreview();
                });
            });
            function showWebsitePreview() {
                $("#website_preview").hide();
                $('#website_preview-error').hide();
                var url = $('#url').val();

                if (url !='') {
                    if (isValidHttpUrl(url)) {
                        $("#website_preview").html('<iframe src="' + url + '"></iframe>').show();
                    } else if (!isValidHttpUrl(url)) {
                        $('#website_preview-error').show();
                    }
                }
            }
*/            
        </script>
    @endpush
@endisset
