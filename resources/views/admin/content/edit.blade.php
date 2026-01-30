@extends('admin.layouts.default')

@section('title')
    {{ __('admin-content.views.edit.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-content.views.edit.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-content.views.edit.breadcrumbs.contents') => route('admin.contents.index'),
        $content->key
    ]])
@stop

@section('content')
    <form method="post"
        action="{{ route('admin.contents.update',['content' => $content]) }}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-content.views.edit.label.key') }}</label>
                    <input value="{{ $content->key }}"
                        class="input-text @if ($errors->has('key')) invalid @endif"
                        name="key"
                        type="text"
                        required
                        readonly>
                    @if ($errors->has('key'))
                        <span class="text-danger">{{ $errors->first('key') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-content.views.edit.label.type') }}</label>
                    <select
                        data-placeholder="{{ $content->type }}"
                        class="chosen-select @if ($errors->has('type')) invalid @endif"
                        name="type"
                        required
                    >
                        @foreach ($contentTypes as $contentType)
                            <option
                                value="{{ $contentType }}"
                                @if ($content->type == $contentType)
                                    selected
                                @endif
                            >{{ $contentType }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-content.views.edit.label.status') }}</label>
                    <select
                        data-placeholder="{{ $content->type }}"
                        class="chosen-select @if ($errors->has('status')) invalid @endif"
                        name="status"
                        required
                    >
                        @foreach ($statuses as $status)
                            <option
                                value="{{ $status }}"
                                @if ($content->status == $status)
                                    selected
                                @endif
                            >{{ __('enums.status.'.$status) }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                @foreach (Config::get('languages') as $lang => $language)
                    <div class="col-md-6">
                        <label>{{ __('admin-content.views.edit.label.content') }} [{{ $language }}]</label>
                        <textarea
                            class="wp-editor-area @if ($errors->has('content[{{ $lang }}]')) invalid @endif"
                            rows="8"
                            autocomplete="off"
                            cols="40"
                            name="content[{{ $lang }}]"
                            id="content[{{ $lang }}]"
                            aria-hidden="true"
                        >{!! $content->content->{$lang} !!}</textarea>
                        @if ($errors->has('content[{{ $lang }}]'))
                            <span class="text-danger">{{ $errors->first("content[$lang]") }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
            <button class="button margin-top-15">
                {{ __('admin-content.views.edit.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')
<script>
    tinymce.init({
        selector: 'textarea',
        height: 500,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
</script>
@stop
