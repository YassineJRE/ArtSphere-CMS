<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>
            @yield('title') {{ __('admin-layouts.views.default.title') }}
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style_v2.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/fontawesome5.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/main-color.css') }}" rel="stylesheet" type="text/css" id="colors">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
        <![endif]-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('header_styles')
        @stack('styles')
    </head>
    <body>
        <div id="wrapper">
            @include('admin.components.header')

            <div id="dashboard">
                @include('admin.components.sidebar')

                <div class="dashboard-content">
                    @include('admin.components.title-bar')
                    @include('admin.components.notifications')

                    <div class="row">
                        @yield('content')
                    </div>
                    <div class="row margin-top-120">
                        @include('admin.components.copyrights')
                    </div>
                </div>
            </div>

            <div id="backtotop" class=""><a href="#"></a></div>
        </div>

        <script src="{{ asset('js/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/jquery-migrate-3.1.0.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/mmenu.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/chosen.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/slick.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/rangeslider.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/magnific-popup.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/waypoints.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/counterup.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/jquery-ui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/tooltips.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts/custom.js') }}" type="text/javascript"></script>
        @yield('app_scripts')
        @stack('scripts')
        @include('admin.components.style-switcher')
    </body>
</html>
