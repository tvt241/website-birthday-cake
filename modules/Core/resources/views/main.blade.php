<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title", "Bánh kem hương vị Việt")</title>
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/font-awesome.min.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/elegant-icons.css") }}" type="text/css">  
    <link rel="stylesheet" href="{{ asset("assets/css/jquery-ui.min.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/owl.carousel.min.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/slicknav.min.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/sweetalert2.min.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/toast.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}" type="text/css">
    <script src="{{ asset("assets/js/helper.js") }}"></script>
    @stack("css")
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <div class="humberger__menu__overlay"></div>
    @include("core::layouts.header-mobile")
    @include("core::layouts.header")
    
    @yield("content")

    @include("core::layouts.footer")
    <!-- Js Plugins -->
    <script src="{{ asset("assets/js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery-ui.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.slicknav.js") }}"></script>
    <script src="{{ asset("assets/js/mixitup.min.js") }}"></script>
    <script src="{{ asset("assets/js/owl.carousel.min.js") }}"></script>
    <script src="{{ asset("assets/js/sweetalert2.all.min.js") }}"></script>
    <script src="{{ asset('assets/js/echo.js') }}"></script>
    <script src="{{ asset('assets/js/pusher.min.js') }}"></script>
    <script src="{{ asset("assets/js/helper2.js") }}"></script>
    <script src="{{ asset("assets/js/config.js") }}"></script>
    <script src="{{ asset("assets/js/main.js") }}"></script>

    @stack("js")
</body>

</html>