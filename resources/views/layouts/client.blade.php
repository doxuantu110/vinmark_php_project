<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset ('assets/clients/img/favicon.png')}}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset ('assets/clients/css/font-icons.css')}}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset ('assets/clients/css/plugins.css')}}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset ('assets/clients/css/style.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset ('assets/clients/css/responsive.css')}}">
    <style>
        #flasher-container, .flashes, .toast { z-index: 999999 !important; }
    </style>
    
    <!-- Toastr CSS (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
    
<body>
    <!-- Body main wrapper start -->
    <div class="body-wrapper">
        @include('clients.partials.header')

        @hasSection('breadcrumb')
            @include('clients.partials.breadcrumb')
        @endif

        <main>
            @yield('content')
        </main>

        @include('clients.partials.feature')
        @include('clients.partials.footer')
    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- jQuery (CDN) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- All JS Plugins -->
    <script src="{{ asset ('assets/clients/js/plugins.js')}}"></script>
    <!-- Main JS -->
    <script src="{{ asset ('assets/clients/js/main.js')}}"></script>

    <!-- Toastr JS (CDN) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- JavaScript custom -->
    <script src="{{ asset('assets/clients/js/custom.js') }}"></script>

    <!-- Manual Toastr Script for Session Messages -->
    <script>
        $(document).ready(function() {
            @if(session('success'))
                if(typeof toastr !== 'undefined') {
                    toastr.success("{{ session('success') }}");
                }
            @endif
            @if(session('error'))
                if(typeof toastr !== 'undefined') {
                    toastr.error("{{ session('error') }}");
                }
            @endif
            @if(session('warning'))
                if(typeof toastr !== 'undefined') {
                    toastr.warning("{{ session('warning') }}");
                }
            @endif
            @if(session('info'))
                if(typeof toastr !== 'undefined') {
                    toastr.info("{{ session('info') }}");
                }
            @endif
        });
    </script>

    



</body>
</html>
