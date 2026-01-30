@extends('layouts.main')

@section('content')
<div class="container woocommerce">

    <div class="woocommerce col-md-12 margin-top-10">
		@auth
        <h2>{{ __('my-group-member.views.create.h2.invite') }}</h2>
        <form
            action=""
            class="register"
            method="post"
        >
            @csrf
			
			<p class="form-row col-md-3">
                <label for="gallery_name">Gallery Name<span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('gallery_name')) invalid @endif"
                    name="gallery_name"
                    id="gallery_name"
                    required
                >
                @if ($errors->has('gallery_name'))
                    <span class="text-danger">{{ $errors->first('gallery_name') }}</span>
                @endif
            </p>
			
            <p class="form-row col-md-3">
                <label for="first_name">Representative {{ __('my-group-member.views.create.form.p.label.first-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('first_name')) invalid @endif"
                    name="first_name"
                    id="first_name"
                    required
                >
                @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </p>
            <p class="form-row col-md-3">
                <label for="last_name">Representative {{ __('my-group-member.views.create.form.p.label.last-name') }} <span class="required">*</span></label>
                <input
                    type="text"
                    class="input-text form-control @if ($errors->has('last_name')) invalid @endif"
                    name="last_name"
                    id="last_name"
                    required
                >
                @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </p>
            <p class="form-row col-md-3">
                <label for="email">Representative {{ __('my-group-member.views.create.form.p.label.email') }} <span class="required">*</span></label>
                <input
                    type="email"
                    class="input-text form-control @if ($errors->has('email')) invalid @endif"
                    name="email"
                    id="email"
                    required
                >
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </p>
            <p class="form-row col-md-12">
                <input
                    type="submit"
                    class="button"
                    name="send"
                    value="Invite"
                >
            </p>
        </form>
		@else
            <p>Please log in to access this page.</p>
        @endauth
        
    </div>
</div>
@stop