@extends('admin.layouts.default')

@section('title')
    {{ __('admin-content.views.create.title') }}
    @parent
@stop

@section('breadcrumbs')
    @include('admin.components.breadcrumbs', ['breadcrumbs' => [
        __('admin-content.views.create.breadcrumbs.home') => route('admin.dashboard'),
        __('admin-content.views.create.breadcrumbs.contents') => route('admin.contents.index'),
        __('admin-content.views.create.breadcrumbs.new-content')
    ]])
@stop

@section('header_styles')

@stop

@section('content')
    <form method="post"
        action="{{ route('admin.contents.store') }}">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="dashboard-list-box-static">
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-content.views.create.label.key') }}</label>
                    <input value="{{ @old('key') }}"
                        class="input-text @if ($errors->has('key')) invalid @endif"
                        name="key"
                        type="text" required>
                    @if ($errors->has('key'))
                        <span class="text-danger">{{ $errors->first('key') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>{{ __('admin-content.views.create.label.type') }}</label>
                    <select
                        data-placeholder="{{ @old('type') }}"
                        class="chosen-select @if ($errors->has('type')) invalid @endif"
                        name="type"
                        required
                    >
                        @foreach ($contentTypes as $contentType)
                            <option value="{{ $contentType }}">
                                {{ $contentType }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>{{ __('admin-content.views.create.label.status') }}</label>
                    <select
                        data-placeholder="{{ @old('status') }}"
                        class="chosen-select @if ($errors->has('status')) invalid @endif"
                        name="status"
                        required
                    >
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}">
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                @foreach (Config::get('languages') as $lang => $language)
                    <div class="col-md-6">
                        <label>{{ __('admin-content.views.create.label.content') }} [{{ $language }}]</label>
                        <textarea
                            value="{{ @old("content[$language]") }}"
                            class="wp-editor-area @if ($errors->has('content[{{ $lang }}]')) invalid @endif"
                            rows="8"
                            autocomplete="off"
                            cols="40"
                            name="content[{{ $lang }}]"
                            id="content[{{ $lang }}]"
                            aria-hidden="true"
                        ></textarea>
                        @if ($errors->has('content[{{ $lang }}]'))
                            <span class="text-danger">{{ $errors->first("content[$lang]") }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
            <button class="button margin-top-15">
                {{ __('admin-content.views.create.button.save') }}
            </button>
        </div>
    </form>
@stop

@section('app_scripts')

@stop
