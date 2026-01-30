@isset($myWebsiteGroup)
    <div class="container woocommerce">
        <div class="woocommerce">
            <form
                @if ($myWebsiteGroup->belongsToProfile())
                    action="{{ route('my-profile.my-website-groups.update',[
                        'my_profile' => $myWebsiteGroup->owner_id,
                        'my_website_group' => $myWebsiteGroup->id
                    ]) }}"
                @elseif ($myWebsiteGroup->belongsToGroup())
                    action="{{ route('my-group.my-website-groups.update',[
                        'my_group' => $myWebsiteGroup->owner_id,
                        'my_website_group' => $myWebsiteGroup->id
                    ]) }}"
                @endif
                class="register"
                method="post"
            >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row col-md-6">
                    <label for="title">{{ __('my-website-group.views.edit.form.p.label.title') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('title')) invalid @endif"
                        name="title"
                        id="title"
                        value="{{ $myWebsiteGroup->title ?? old('title') }}"
                        required
                    >
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="type">{{ __('my-website-group.views.edit.form.p.label.type') }}</label>
                    <select
                        class="chosen-select @if ($errors->has('type')) invalid_ @endif"
                        name="type"
                        id="type"
                    >
                        <option value=""></option>
                        @foreach ($websiteGroupTypes as $websiteGroupType)
                            <option
                                value="{{ $websiteGroupType }}"
                                @if (
                                        (@old('type') && @old('type') == $websiteGroupType)
                                        ||
                                        ($myWebsiteGroup->type == $websiteGroupType)
                                    )
                                    selected
                                @endif
                            >{{ __('enums.website-group-type.'.$websiteGroupType) }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                    <div class="specify_website_group_type 
                        @if (!(
                                $myWebsiteGroup->type == 'other'                        
                                ||
                                (@old('type') && @old('type') == 'other')
                        )) hidden @endif"
                    >
                        <label for="specify_website_group_type">{{ __('my-website-group.views.edit.form.p.label.specify') }}</label>
                        <input
                            type="text"
                            class="input-text form-control @if ($errors->has('specify_website_group_type')) invalid @endif"
                            name="specify_website_group_type"
                            id="specify_website_group_type"
                            value="{{ $myWebsiteGroup->specify_website_group_type ?? old('specify_website_group_type') }}"
                        >
                        @if ($errors->has('specify_website_group_type'))
                            <span class="text-danger">{{ $errors->first('specify_website_group_type') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-row col-md-12">
                    <label for="description">{{ __('my-website-group.views.edit.form.p.label.description') }}</label>
                    <textarea
                        class="input-text form-control @if ($errors->has('description')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="description"
                        name="description"
                        placeholder="">{{ $myWebsiteGroup->description ?? old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12 margin-top-15">
                    <p>{{ __('my-website-group.views.edit.form.p.label.additional-information-content') }}</p>
                </div>
                <div class="form-row col-md-6">
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                        name="additional_information_title"
                        id="additional_information_title"
                        value="{{  $myWebsiteGroup->additional_information_title ?? old('additional_information_title') }}"
                        placeholder="{{ __('my-website-group.views.edit.form.p.label.additional-information-title') }}"
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
                    >{{ $myWebsiteGroup->additional_information_content ?? old('additional_information_content') }}</textarea>
                    @if ($errors->has('additional_information_content'))
                        <span class="text-danger">{{ $errors->first('additional_information_content') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="status">{{ __('my-website-group.views.edit.form.p.label.status') }}</label>
                    <select
                        data-placeholder="{{ @old('status') }}"
                        class="chosen-select @if ($errors->has('status')) invalid @endif"
                        name="status"
                        id="status"
                    >
                        @foreach ($statuses as $status)
                            <option
                                value="{{ $status }}"
                                @if (
                                        (@old('status') && @old('status') == $status)
                                        ||
                                        ($myWebsiteGroup->status == $status)
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
                        value="{{ __('my-website-group.views.edit.form.p.button.save') }}"
                    >
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(function () {
                $('#type').change(function(){
                    if (this.value == 'other') {
                        $('div.specify_website_group_type').removeClass('hidden');
                    } else {
                        $('div.specify_website_group_type').addClass('hidden');
                    }
                });
            });
        </script>
    @endpush
@endisset
