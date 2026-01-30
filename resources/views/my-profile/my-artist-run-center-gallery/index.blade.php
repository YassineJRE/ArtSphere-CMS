@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-artist-run-center-gallery.views.index.title.add-artist-center') }}
    @parent
@endsection

@section('page-title')
{{ __('my-artist-run-center-gallery.views.index.title.add-artist-center') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myProfile->getName() => route('my-profile.show',['my_profile' => $myProfile->id]),
        'Create artist run center - org. profile'
    ]])
@stop


@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <p class="col-md-12">
        {{ __('my-artist-run-center-gallery.views.index.p.text') }}
    </p>
    <p class="col-md-12" style="color:#ff6600;">
        {{ __('my-artist-run-center-gallery.views.index.p.red-text') }}
    </p>
    <p class="col-md-12">
        <a class="button"
            href="{{ route('my-profile.my-artist-run-center-gallery.create',['my_profile' => $myProfile->id]) }}">
            {{ __('my-artist-run-center-gallery.views.index.p.button.create') }}
        </a>
    </p>
</div>
@stop
