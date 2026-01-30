@extends('layouts.my-group')

@section('header_styles')

@stop

@section('title')
    {{ __('my-group-member.views.index.title.artist-group') }} - {{ $myGroup->getName() }}
    @parent
@endsection

@section('page-title')
    {{ $myGroup->getName() }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        $myGroup->getName() => route('my-group.show',['my_group' => $myGroup->id]),
        __('my-group-member.views.index.breadcrumbs.members')
    ]])
@stop

@section('content')
<div class="col-md-12">
    @include('components.notifications')
    @if (app('profile.session')->isAdministratorOfThisGroup($myGroup))
        <div class="elementor-container elementor-column-gap-no margin-bottom-20">
            <div class="elementor-row">
                <div class="elementor-column elementor-col-100 elementor-element
                    @if ($myGroup->members->count() > 0) elementor-align-right @endif">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div class="elementor-element  elementor-widget elementor-widget-button">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a href="{{ route('my-group.members.create',['my_group' => $myGroup->id]) }}"
                                            role="button"
                                            class="elementor-button @if ($myGroup->members->count() > 0) elementor-size-sm @else elementor-size-xl @endif"
                                        >
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">
                                                    <i class="sl sl-icon-plus"></i>
                                                    {{ __('my-group-member.views.index.button.span.add-member') }}
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

    <div class="widget_products">
        <ul class="product_list_widget">
            @foreach ($myGroup->members as $member)
                <li>
                    <a href="{{ route('my-group.members.show',[
                            'my_group' => $myGroup->id, 
                            'member' => $member->id
                        ]) }}"
                        title="{{ $member->profile->getLongName() }}"
                    >
                        @empty($member->account()->getFirstMediaUrl('avatar'))
                            <img
                                width="300"
                                height="300"
                                src="{{ asset('img/avatar.png') }}"
                                alt="{{ $member->profile->getLongName() }}"
                            >
                        @endempty
                        @empty(!$member->account()->getFirstMediaUrl('avatar'))
                            <img
                                width="300"
                                height="300"
                                src="{{ $member->account()->getFirstMediaUrl('avatar') }}"
                                alt="{{ $member->profile->getLongName() }}"
                            >
                        @endempty
                        <span class="product-title">
                            {{ $member->profile->getLongName() }}
                        </span>
                    </a>
                    @if ($member->isAdministrator())
                        <span class="woocommerce-Price-amount amount">
                            <bdi>{{ __('my-group-member.views.index.ul.li.administrator') }}</bdi>
                        </span>
                    @endif
                    @if ($member->isMember())
                        <span class="woocommerce-Price-amount amount">
                            <bdi>{{ __('my-group-member.views.index.ul.li.member') }}</bdi>
                        </span>
                    @endif
                    @if ($member->isPending())
                        <span class="woocommerce-Price-amount amount">
                            <bdi>{{ __('my-group-member.views.index.ul.li.pending-approval') }}</bdi>
                        </span>
                    @endif

                    <div class=" row buttons">
                        @if (app('profile.session')->isAdministratorOfThisGroup($myGroup))
                            @if ($member->isPending())
                                <a class="button resend"
                                    href=""
                                >
                                    <i class="sl sl-icon-envolope"></i>
                                    {{ __('my-group-member.views.index.ul.li.button.resend-invitation') }}
                                </a>
                            @endif

                            @if ( $member->canEdit() )
                                <a class="button edit"
                                    href="{{ route('my-group.members.edit',[
                                        'my_group' => $myGroup->id,
                                        'member' => $member->id
                                    ]) }}"
                                >
                                    <i class="sl sl-icon-note"></i>
                                    {{ __('my-group-member.views.index.ul.li.button.edit') }}
                                </a>
                            @endif
                        @endif

                        @if ($member->canRemove())
                            <a href="#delete-row-dialog-{{ $member->id }}" class="button delete popup-delete-row">
                                <i class="sl sl-icon-close"></i>
                                {{ __('my-group-member.views.index.ul.li.button.remove') }}
                            </a>
                            <div id="delete-row-dialog-{{ $member->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                <div class="small-dialog-header">
                                    <h3>{{ __('my-group-member.views.index.ul.li.h3.remove-member') }}</h3>
                                </div>
                                <div class="sign-in-form style-1">
                                    <p>{{ __('my-group-member.views.index.ul.li.p.sure') }}</p>
                                    <form method="post"
                                        action="{{ route('my-group.members.destroy',[
                                                'my_group' => $myGroup->id, 
                                                'member' => $member->id
                                            ]) }}"
                                    >
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="button">
                                            {{ __('my-group-member.views.index.ul.li.form.button.remove') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    @if ($myGroup->unregisteredGuests->count() > 0)
        <div class="widget_products margin-top-50">
            <h3>{{ __('my-group-member.views.index.h3.invitations') }}</h3>
            <ul class="product_list_widget">
                @foreach ($myGroup->unregisteredGuests as $guest)
                    <li>
                        <a title="{{ $guest->getName() }}">
                            <img
                                width="300"
                                height="300"
                                src="{{ asset('img/avatar.png') }}"
                                alt="{{ $guest->getName() }}"
                            >
                            <span class="product-title">
                                {{ $guest->getName() }}
                            </span>
                        </a>

                        @if ($guest->isRegistered())
                            <span class="woocommerce-Price-amount amount">
                                <bdi>{{ __('my-group-member.views.index.ul.li.saved') }}</bdi>
                            </span>
                        @else
                            <span class="woocommerce-Price-amount amount">
                                <bdi>{{ __('my-group-member.views.index.ul.li.pending') }}</bdi>
                            </span>
                        @endif

                        <div class="row buttons">
                            @if (app('profile.session')->isAdministratorOfThisGroup($myGroup) && $guest->canDelete())
                                <a href="#delete-invitation-{{ $guest->id }}" class="button delete popup-delete-row">
                                    <i class="sl sl-icon-trash"></i>
                                    {{ __('my-group-member.views.index.ul.li.button.delete') }}
                                </a>
                                <div id="delete-invitation-{{ $guest->id }}" class="listeo-dialog zoom-anim-dialog mfp-hide">
                                    <div class="small-dialog-header">
                                        <h3>{{ __('my-group-member.views.index.ul.li.h3.delete-invitation') }}</h3>
                                    </div>
                                    <div class="sign-in-form style-1">
                                        <p>{{ __('my-group-member.views.index.ul.li.p.sure') }}</p>
                                        <form method="post"
                                            action="{{ route('invitations.destroy',[
                                                'user_invitation' => $guest->id
                                            ]) }}"
                                        >
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="button">
                                                {{ __('my-group-member.views.index.ul.li.form.button.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            @if (app('profile.session')->isAdministratorOfThisGroup($myGroup) && $guest->canResendInvitationMail())
                                <a class="button resend"
                                    href="{{ route('invitations.resend-invitation-mail',[
                                            'user_invitation' => $guest->id
                                        ]) }}"
                                >
                                    <i class="sl sl-icon-envolope"></i>
                                    {{ __('my-group-member.views.index.ul.li.button.resend-invitation') }}
                                </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
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
