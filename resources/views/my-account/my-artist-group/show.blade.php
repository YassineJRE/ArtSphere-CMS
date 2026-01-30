@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-artist-group.views.show.title.my-artist-group') }} - {{ $group->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $group->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-artist-group.views.show.breadcrumbs.my-artist-groups') => route('my-account.index'),
        $group->name
    ]])
@stop

@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <h1>{{ $group->getName() }}</h1>
    <p>
        {{ __('my-artist-group.views.show.p.add-exhibit') }}
    </p>
    <p>
        <a class="button"
            href="{{ route('my-group.show',['my_group' => $group->id]) }}"
        ><i class="sl sl-icon-star"></i> {{ __('my-artist-group.views.show.p.button.go-to-account') }}</a>
    </p>
    @if (app('profile.session')->isAdministratorOfThisGroup($group))
        <p>
            {{ __('my-artist-group.views.show.p.make-account-private') }}
        </p>
        <p>
            @if ($group->isEnabled())
                <a class="button unpublish"
                    href="{{ route('my-account.artist-group.toggle-enable',['artist_group' => $group->id]) }}"
                ><i class="sl sl-icon-close"></i> {{ __('my-artist-group.views.show.p.button.unpublish') }}</a>
            @else
                <a class="button publish"
                    href="{{ route('my-account.artist-group.toggle-enable',['artist_group' => $group->id]) }}"
                ><i class="sl sl-icon-check"></i> {{ __('my-artist-group.views.show.p.button.publish') }}</a>
            @endif
        </p>
        <p>
            {{ __('my-artist-group.views.show.p.delete-the-account') }}
        </p>
        <p>
            <a href="#delete-row-dialog-{{ $group->id }}" class="button delete popup-delete-row">
                <i class="sl sl-icon-trash"></i>
                {{ __('my-artist-group.views.show.p.button.delete-account') }}
            </a>
        </p>
        <div id="delete-row-dialog-{{ $group->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
            <div class="small-dialog-header">
                <h3>{{ __('my-artist-group.views.show.h3.delete-group') }}</h3>
            </div>
            <div class="sign-in-form style-1">
                <p>{{ __('my-artist-group.views.show.p.sure') }}</p>
                <form method="post"
                    action="{{ route('my-account.artist-group.destroy',['artist_group' => $group->id]) }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="button">
                        {{ __('my-artist-group.views.show.form.button.delete') }}
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
