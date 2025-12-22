<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('title', 'Trang chủ')

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/clients/img/favicon.png') }}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/font-icons.css') }}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/plugins.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('assets/clients/css/responsive.css') }}">
    <style>
        #flasher-container,
        .flashes,
        .toast {
            z-index: 999999 !important;
        }
    </style>

    <!-- Toastr CSS (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/clients/css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/custom.css') }}">
</head>

<body>
    <!-- Body main wrapper start -->
    <div class="body-wrapper">
        @include('clients.partials.header_home')
        <main>
            @yield('content')
        </main>
        @include('clients.partials.chat_ai')
        @include('clients.partials.footer_home')
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Easing Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Toastr JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Flasher core JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/@flasher/flasher/dist/flasher.min.js"></script>
    <!-- PAYPAL SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}"></script>
    <script>
        // Fix lỗi jQuery.easing.def không tồn tại
        if (typeof jQuery.easing === 'undefined') {
            jQuery.easing = {};
        }
        if (typeof jQuery.easing.def === 'undefined') {
            jQuery.easing.def = 'swing';
            jQuery.easing.swing = function(x, t, b, c, d) {
                return c * (t / d) + b;
            };
        }
    </script>
    <!-- All JS Plugins -->
    <script src="{{ asset('assets/clients/js/plugins.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/clients/js/main.js') }}"></script>
    <script src="{{ asset('assets/clients/js/chat.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/clients/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                if (typeof toastr !== 'undefined') {
                    toastr.success("{{ session('success') }}");
                }
            @endif
            @if (session('error'))
                if (typeof toastr !== 'undefined') {
                    toastr.error("{{ session('error') }}");
                }
            @endif
            @if (session('warning'))
                if (typeof toastr !== 'undefined') {
                    toastr.warning("{{ session('warning') }}");
                }
            @endif
            @if (session('info'))
                if (typeof toastr !== 'undefined') {
                    toastr.info("{{ session('info') }}");
                }
            @endif
        });
    </script>
    <script>
        $(window).on('load', function() {
            if ($('.ltn__tab-product-slider-one-active').length) {
                $('.ltn__tab-product-slider-one-active').slick('setPosition');
            }
        });

        /* Khi click tab */
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function() {
            $('.ltn__tab-product-slider-one-active').slick('setPosition');
        });
    </script>
</body>

</html>
