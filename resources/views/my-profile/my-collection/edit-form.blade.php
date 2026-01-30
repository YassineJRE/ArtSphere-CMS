@isset($myCollection)
    <div class="container woocommerce">
        <div class="woocommerce col-md-12">
            <form
                @if ($myCollection->belongsToProfile())
                    action="{{ route('my-profile.my-collections.update',[
                        'my_profile' => $myCollection->owner_id,
                        'my_collection' => $myCollection->id
                    ]) }}"
                @elseif ($myCollection->belongsToGroup())
                    action="{{ route('my-group.my-collections.update',[
                        'my_group' => $myCollection->owner_id,
                        'my_collection' => $myCollection->id
                    ]) }}"
                @endif
                class="register"
                method="post"
            >
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-row col-md-6">
                    <label for="title">{{ __('my-collection.views.edit.form.p.label.title') }} <span class="required">*</span></label>
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('title')) invalid @endif"
                        name="title"
                        id="title"
                        value="{{ $myCollection->title ?? old('title') }}">
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12">
                    <label for="description">{{ __('my-collection.views.edit.form.p.label.description') }}</label>
                    <textarea
                        class="input-text form-control @if ($errors->has('description')) invalid @endif"
                        cols="40"
                        rows="3"
                        id="description"
                        name="description"
                        placeholder=""
                    >{{ $myCollection->description ?? old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-12 margin-top-15">
                    <p>{{ __('my-collection.views.edit.form.p.label.additional-information-content') }}</p>
                </div>
                <div class="form-row col-md-6">
                    <input
                        type="text"
                        class="input-text form-control @if ($errors->has('additional_information_title')) invalid @endif"
                        name="additional_information_title"
                        id="additional_information_title"
                        value="{{ old('additional_information_title') ?? $myCollection->additional_information_title }}"
                        placeholder="Ajoutez un titre"
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
                    >{{ old('additional_information_content') ?? $myCollection->additional_information_content }}</textarea>
                    @if ($errors->has('additional_information_content'))
                        <span class="text-danger">{{ $errors->first('additional_information_content') }}</span>
                    @endif
                </div>
                <div class="form-row col-md-6">
                    <label for="status">{{ __('my-collection.views.edit.form.p.label.status') }}</label>
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
                                        ($myCollection->status == $status)
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
                        value="{{ __('my-collection.views.edit.form.p.button.save') }}"
                    >
                </div>
            </form>
        </div>
    </div>    
@endisset