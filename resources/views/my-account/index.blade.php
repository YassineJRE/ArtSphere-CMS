@extends('layouts.my-account')

@section('header_styles')

@stop

@section('title')
    {{ __('my-account.views.index.title') }}
    @parent
@endsection

@section('page-title')
    {{ __('my-account.views.index.page-title') }}
@stop

@section('breadcrumbs')
    @include('components.breadcrumbs', ['breadcrumbs' => [
        __('my-account.views.index.breadcrumbs.account') => route('my-account.index'),
        __('my-account.views.index.breadcrumbs.details')
    ]])
@stop

@section('content')
<div class="woocommerce-MyAccount-content">
    @include('components.notifications')
    <div class="u-columns woocommerce-Addresses col2-set addresses">
        <header class="woocommerce-Address-title title">
            <h3>{{ __('my-account.views.index.h3.title') }}</h3>
        </header>
        <div class="u-column1 col-1 woocommerce-Address">
            <address>
                {{ __('my-account.views.index.address-section.pronoun') }} <b>{{ $user->pronoun }}</b><br>
                {{ __('my-account.views.index.address-section.first-name') }} <b>{{ $user->first_name }}</b><br>
                {{ __('my-account.views.index.address-section.last-name') }} <b>{{ $user->last_name }}</b><br>
                {{ __('my-account.views.index.address-section.address') }} <b>{{ $user->address }}</b><br>
                {{ __('my-account.views.index.address-section.city') }} <b>{{ $user->city }}</b><br>
                {{ __('my-account.views.index.address-section.country') }} <b>{{ $user->country }}</b><br>
                {{ __('my-account.views.index.address-section.ethnicity') }} <b>{{ $user->ethnicity }}</b><br>
            </address>
            <a href="{{ route('my-account.edit') }}" 
                class="edit button"
            ><i class="sl sl-icon-note"></i> {{ __('my-account.views.index.button.edit') }}</a>
        </div>
        <div class="u-column1 col-1 woocommerce-Address">
            <address>
                {{ __('my-account.views.index.address-section.email') }} <b>{{ $user->email }}</b><br>
                {{ __('my-account.views.index.address-section.password') }} <b>***********</b><br>
            </address>
            <a href="{{ route('my-account.change-password') }}" 
                class="edit button"
            ><i class="sl sl-icon-note"></i> {{ __('my-account.views.index.button.change-password') }}</a>
        </div>
    </div>
</div>
@stop
