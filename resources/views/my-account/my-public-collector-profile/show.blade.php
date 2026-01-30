@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-public-collector-profile.views.show.title.artist-profile') }} - {{ $profile->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $profile->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-public-collector-profile.views.show.breadcrumbs.account') => route('my-account.index'),
        $profile->getName()
    ]])
@stop

@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <h1>{{ $profile->getName() }}</h1>
    <p>
        {{ __('my-public-collector-profile.views.show.p.edit-text') }}
    </p>
    <p>
        <a class="button"
            href="{{ route('my-profile.show',['my_profile' => $profile->id]) }}"
        ><i class="sl sl-icon-star"></i> {{ __('my-public-collector-profile.views.show.p.button.go-to-my-account') }}</a>
    </p>
    <p>
        {{ __('my-public-collector-profile.views.show.p.unpublish-text') }}
    </p>
    <p>
        @if ($profile->isEnabled())
            <a class="button unpublish"
                href="{{ route('my-account.public-collector-profile.toggle-enable',['public_collector_profile' => $profile->id]) }}"
            ><i class="sl sl-icon-close"></i> {{ __('my-public-collector-profile.views.show.p.button.unpublish-account') }}</a>
        @else
            <a class="button publish"
                href="{{ route('my-account.public-collector-profile.toggle-enable',['public_collector_profile' => $profile->id]) }}"
            ><i class="sl sl-icon-check"></i> {{ __('my-public-collector-profile.views.show.p.button.publish-account') }}</a>
        @endif
    </p>
    @if (true)
        <p>
            {{ __('my-public-collector-profile.views.show.p.delete-text') }}
        </p>
        <p>
            <a href="#delete-row-dialog-{{ $profile->id }}" class="button delete popup-delete-row">
                <i class="sl sl-icon-trash"></i>
                {{ __('my-public-collector-profile.views.show.p.button.delete-account') }}
            </a>
        </p>
        <div id="delete-row-dialog-{{ $profile->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
            <div class="small-dialog-header">
                <h3>{{ __('my-public-collector-profile.views.show.h3.delete-public-collector') }}</h3>
            </div>
            <div class="sign-in-form style-1">
                <p>{{ __('my-public-collector-profile.views.show.p.sure') }}</p>
                <form method="post"
                    action="{{ route('my-account.public-collector-profile.destroy',[
                        'public_collector_profile' => $profile->id
                    ]) }}"
                >
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="button">
                        {{ __('my-public-collector-profile.views.show.form.button.delete') }}
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@stop

@section('app_scripts')
<script type="text/javascript">
$(document).ready(function (e) {
    $('.popup-delete-row').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'art-mfp-zoom-in'
    });
});
</script>
@stop
