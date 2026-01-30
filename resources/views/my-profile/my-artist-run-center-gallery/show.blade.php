@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-artist-run-center-gallery.views.show.title.artist-center') }} - {{ $myArtistRunCenterGallery->name }}
    @parent
@endsection

@section('page-title')
    {{ $myArtistRunCenterGallery->name }}
@stop

@section('breadcrumbs')
    @if ($myProfile->isArtist())
        @include('components.breadcrumbs', ['breadcrumbs' => [
            __('my-artist-run-center-gallery.views.show.breadcrumbs.my-account') => route('my-account.index'),
            $myProfile->getName() => route('my-account.artist-profile.show',['artist_profile' => $myProfile->id]),
            $myArtistRunCenterGallery->name
        ]])
    @elseif ($myProfile->isCurator())
        @include('components.breadcrumbs', ['breadcrumbs' => [
            __('my-artist-run-center-gallery.views.show.breadcrumbs.my-account') => route('my-account.index'),
            $myProfile->getName() => route('my-account.curator-profile.show',['curator_profile' => $myProfile->id]),
            $myArtistRunCenterGallery->name
        ]])
    @elseif ($myProfile->isPublicCollector())
        @include('components.breadcrumbs', ['breadcrumbs' => [
            __('my-artist-run-center-gallery.views.show.breadcrumbs.my-account') => route('my-account.index'),
            $myProfile->getFirstName() => route('my-account.public-collector-profile.show',['public_collector_profile' => $myProfile->id]),
            $myArtistRunCenterGallery->name
        ]])
    @else
        @include('components.breadcrumbs', ['breadcrumbs' => [
            __('my-artist-run-center-gallery.views.show.breadcrumbs.my-account') => route('my-account.index'),
            $myArtistRunCenterGallery->name
        ]])
    @endif
@stop

@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <h1>{{ $myArtistRunCenterGallery->name }}</h1>
    <p>
        @if ($myArtistRunCenterGallery->isVerifiedGallery())
            <span style="color:#ffcb00;">{{ __('my-artist-run-center-gallery.views.show.p.span.verified') }}</span> {{ __('my-artist-run-center-gallery.views.show.p.transfer-exhibits') }}
        @else
            <span style="color:#ff6600;">{{ __('my-artist-run-center-gallery.views.show.p.span.to-be-verified') }}</span> {{ __('my-artist-run-center-gallery.views.show.p.you-can-still') }}
        @endif
    </p>
    <p>
        <a class="button"
            href="{{ route('my-group.show',['my_group' => $myArtistRunCenterGallery->id]) }}"
        ><i class="sl sl-icon-star"></i> {{ __('my-artist-run-center-gallery.views.show.p.button.go-to-account') }}</a>
    </p>

    @if (app('profile.session')->isAdministratorOfThisGroup($myArtistRunCenterGallery))
        @if ($myArtistRunCenterGallery->canChangeStatus())
            <p>
                {{ __('my-artist-run-center-gallery.views.show.p.make-account-private') }}
            </p>
            <p>
                @if ($myArtistRunCenterGallery->isEnabled())
                    <a class="button unpublish"
                        href="{{ route('my-profile.my-artist-run-center-gallery.toggle-enable',[
                            'my_profile' => $myProfile->id, 
                            'my_artist_run_center_gallery' => $myArtistRunCenterGallery->id
                        ]) }}"
                    ><i class="sl sl-icon-close"></i> {{ __('my-artist-run-center-gallery.views.show.p.button.unpublish') }}</a>
                @else
                    <a class="button publish"
                    href="{{ route('my-profile.my-artist-run-center-gallery.toggle-enable',[
                        'my_profile' => $myProfile->id, 
                        'my_artist_run_center_gallery' => $myArtistRunCenterGallery->id
                    ]) }}"
                    ><i class="sl sl-icon-check"></i> {{ __('my-artist-run-center-gallery.views.show.p.button.publish') }}</a>
                @endif
            </p>
        @endif

        <p>
            {{ __('my-artist-run-center-gallery.views.show.p.delete-the-account') }}
        </p>
        <p>
            <a href="#delete-row-dialog-{{ $myArtistRunCenterGallery->id }}" class="button delete popup-delete-row">
                <i class="sl sl-icon-trash"></i>
                {{ __('my-artist-run-center-gallery.views.show.p.button.delete-account') }}
            </a>
        </p>
        <div id="delete-row-dialog-{{ $myArtistRunCenterGallery->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
            <div class="small-dialog-header">
                <h3>{{ __('my-artist-run-center-gallery.views.show.h3.delete-group') }}</h3>
            </div>
            <div class="sign-in-form style-1">
                <p>{{ __('my-artist-run-center-gallery.views.show.p.sure') }}</p>
                <form method="post"
                    action="{{ route('my-profile.my-artist-run-center-gallery.destroy',[
                        'my_profile' => $myProfile->id, 
                        'my_artist_run_center_gallery' => $myArtistRunCenterGallery->id
                    ]) }}"
                >
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="button">
                        {{ __('my-artist-run-center-gallery.views.show.form.button.delete') }}
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
