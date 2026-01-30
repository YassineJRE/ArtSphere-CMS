<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-seo :title="__('home.views.index.title')" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main-color.css') }}" rel="stylesheet" type="text/css" id="colors">
    <link href="{{ asset('css/frontend-legacy.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">

    
    <!--[if lt IE 9]>
   <script src="assets/js/html5shiv.min.js"></script>
   <script src="assets/js/respond.min.js"></script>
        <![endif]-->




    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('header_styles')
    @stack('styles')
    <style type="text/css">
        .transparent-header .alt-search-box.main-search-container:before {
            background: none;
        }

        .transparent-header #header:not(.cloned) .user-menu .user-name:hover {
            color: #ff6600 !important;
        }

        #chartdiv {
            width: 100%;
            height: 550px;
        }

        @media (min-width: 767px) {
            #header .container {
                padding-left: 0px;
                padding-right: 0px;
            }
        }
    </style>
</head>

<body class="transparent-header">

    <div id="wrapper">
        @include('home.partials.header')

        <div class="main-search-container full-height alt-search-box centered"
            data-background-image="{{ asset('img/background.jpg') }}">
            <div class="main-search-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @yield('content')
                            @include('home.partials.banner')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('home.partials.srm')
        @include('home.partials.about-us')
        @include('home.partials.thanks')
        @include('home.partials.contact')
        @include('components.footer')
        <div id="backtotop" class=""><a href="#"></a></div>
    </div>

    <script src="{{ asset('js/scripts/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/jquery-migrate-3.1.0.min.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('js/scripts/jquery-2.2.0.min.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('js/scripts/mmenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/chosen.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/rangeslider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/magnific-popup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/tooltips.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    @yield('app_scripts')
    @stack('scripts')
    @include('components.style-switcher')
</body>

</html>