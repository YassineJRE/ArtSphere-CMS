@isset($myProfile)
    <div class="container woocommerce">
        <div class="woocommerce col-md-12">
            <form
                @if ($myProfile->isProfile())
                    action="{{ route('my-profile.my-documents.store',[
                        'my_profile' => $myProfile->id
                    ]) }}"
                @elseif ($myProfile->isGroup())
                    action="{{ route('my-group.my-documents.store',[
                        'my_group' => $myProfile->id
                    ]) }}"
                @endif
                class="register"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="form-row margin-bottom-20">
                    <div class="col-md-6">
                        <label for="media">{{ __('my-document.views.create.form.p.label.file') }} <span class="required">*</span></label>
                        <div class="uploadzone">
                            <div class="uz-preview hidden">
                                <div class="uz-image">
                                    <img alt="preview media">
                                </div>
                                <a class="uz-remove"
                                    href="javascript:void(0);"
                                >{{ __('my-document.views.create.form.button.remove-file') }}</a>
                            </div>
                            <a class="btn-file">
                                <i class="fa fa-upload"></i> {{ __('my-document.views.create.form.p.label.choose-file') }}
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
                </div>
                <div class="form-row col-md-6">
                    <label for="name">{{ __('my-document.views.create.form.p.label.name') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('name')) invalid @endif"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        required
                    >
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="description">{{ __('my-document.views.create.form.p.label.description') }}</label>
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
                    <input
                        type="hidden"
                        name="http_referer"
                        value="{{ old('http_referer') ?? request()->headers->get('referer') }}">
                    <input
                        type="submit"
                        class="button"
                        name="save"
                        value="{{ __('my-document.views.create.form.p.button.save') }}">
                </div>
            </form>
        </div>
    </div>
@endisset
