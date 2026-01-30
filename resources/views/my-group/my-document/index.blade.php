@extends('layouts.my-group')

@section('header_styles')

@stop

@section('title')
    {{ __('my-group-document.views.index.title.artist-group') }} - {{ $group->getName() }} |
    {{ __('my-group-document.views.index.title.my-documents') }}
    @parent
@endsection

@section('page-title')
    {{ $group->getName() }}|
    {{ __('my-group-document.views.index.page-title.my-documents') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-document.views.index.breadcrumbs.my-documents')
    ]])
@stop

@section('content')
<div class="col-md-12">
    @if (app('profile.session')->isAdministratorOfThisGroup($myGroup))
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element  elementor-widget elementor-widget-button
                                @if ($myGroup->documents->count() > 0) elementor-align-right @endif"
                            >
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a href="{{ route('my-group.my-documents.create',['my_group' => $myGroup->id]) }}"
                                            class="elementor-button elementor-size-sm" role="button">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">
                                                    {{ __('my-group-document.views.index.span.add-document') }}
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div id="dokan-seller-listing-wrap" class="grid-view">
        <div class="seller-listing-content">
            <ul class="dokan-seller-wrap">
                @foreach ($myGroup->documents as $document)
                    <li class="dokan-single-seller woocommerce coloum-3 ">
                        <a href="{{ route('my-group.my-documents.show',['my_group' => $myGroup->id, 'my_document' => $document->id]) }}">
                            <div class="store-wrapper">
                                <div class="store-header">
                                    <div class="store-banner">
                                        @include('components.media.document', [
                                            'document' => $document
                                        ])
                                    </div>
                                </div>
                                <div class="store-content ">
                                    <div class="store-data-container">
                                        <div class="featured-favourite"></div>
                                        <div class="store-data">
                                            <h2>{{ $document->name }}</h2>
                                            <p>{{ $document->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="store-footer">
                                    @if (app('profile.session')->isAdministratorOfThisGroup($myGroup))
                                        <a href="{{ route('my-group.my-documents.edit',['my_group' => $myGroup->id, 'my_document' => $document->id]) }}"
                                            class="button"
                                        >{{ __('my-group-document.views.index.ul.li.button.edit') }}</a>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
                <div class="dokan-clearfix"></div>
            </ul>
        </div>
    </div>
</div>
@stop
