@isset($myDocument)
    <div class="container woocommerce">
        <div class="woocommerce col-md-12">
            <form
                @if ($myDocument->belongsToProfile())
                    action="{{ route('my-profile.my-documents.update',[
                        'my_profile' => $myDocument->owner_id, 
                        'my_document' => $myDocument->id
                    ]) }}"
                @elseif ($myDocument->belongsToGroup())
                    action="{{ route('my-group.my-documents.update',[
                        'my_group' => $myDocument->owner_id, 
                        'my_document' => $myDocument->id
                    ]) }}"
                @endif
                class="register"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row margin-bottom-20">
                    <div class="col-md-6">
                        <label for="media">{{ __('my-document.views.edit.form.p.label.file') }} <span class="required">*</span></label>
                        <div class="uploadzone">
                            <div class="uz-preview @if(!$myDocument->getFirstMedia()) hidden @endif">
                                <div class="uz-image">
                                    @include('components.media.document',[
                                        'document' => $myDocument
                                    ])
                                </div>
                                <a class="uz-remove"
                                    href="javascript:void(0);"
                                    data-href="{{
                                        $myDocument->getFirstMedia() ?
                                            route('medias.destroy',['media' => $myDocument->getFirstMedia()->id]) : ''
                                    }}"
                                >{{ __('my-document.views.edit.form.button.remove-file') }}</a>
                            </div>
                            <a class="btn-file">
                                <i class="fa fa-upload"></i> {{ __('my-document.views.edit.form.p.label.choose-file') }}
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
                    <label for="name">{{ __('my-document.views.edit.form.p.label.name') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('name')) invalid @endif"
                        name="name"
                        id="name"
                        value="{{ old('name') ?? $myDocument->name }}"
                        required
                    >
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="description">{{ __('my-document.views.edit.form.p.label.description') }}</label>
                    <textarea
                        class="input-text form-control @if ($errors->has('description')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="description"
                        name="description"
                        placeholder="">{{ old('description') ?? $myDocument->description  }}</textarea>
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
                        value="{{ __('my-document.views.edit.form.p.button.save') }}">
                </div>
            </form>
        </div>
    </div>    
@endisset