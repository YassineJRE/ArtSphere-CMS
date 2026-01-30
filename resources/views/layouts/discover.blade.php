<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-seo :title=" '| Artolog'" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/frontend-legacy.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/fontawesome5.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main-search.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/parent-style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/font-awesome-5-shims.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/woocommerce.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/listeo-dokan.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/dokan-style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/elementor-frontend.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
   <script src="assets/js/html5shiv.min.js"></script>
   <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    @yield('header_styles')
    @stack('styles')
</head>

<body class="woocommerce-account">
    <div id="wrapper" class="@if (str_starts_with(Route::currentRouteName(), 'app.')) discover @endif">
        @include('components.header')
        <div class="clearfix"></div>
        @include('components.titlebar')
        <div class="container full-width discover">
            <div class="row">
                @include('components.navigations.discover')
                @yield('content')
            </div>
        </div>
        @yield('external')
        <div class="clearfix"></div>
        @include('components.footer')
        <div id="backtotop"><a href="#"></a></div>
    </div>

    <!-- list of scripts -->
    <script src="{{ asset('js/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/jquery-migrate-3.1.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/magnific-popup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/rangeslider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/tooltips.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/chosen.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/mmenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/bootstrap-slider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/flatpickr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/custom.v2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    <script type='text/javascript'>
        window.asset = "{{ asset('/') }}";
        /* <![CDATA[ */
        var listeo_core = {};
        var artolog_core = {
            "maxFilesize": "1.5",
            "dictFileTooBig": "{{ __('validation.dict_file_too_big', ['max_file_size' => 1.5]) }}"
        };
        /* ]]> */
    </script>
    @yield('app_scripts')
    @stack('scripts')
    <!-- End of list of scripts -->
</body>

</html>
