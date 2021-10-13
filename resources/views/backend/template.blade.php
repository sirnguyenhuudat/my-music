<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="theme template">
    <meta name="author" content="Nguyen Huu Dat">
    <meta name="keywords" content="theme template">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>
        @section('title_page')
            Admin Page
        @show
    </title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('bower_components/package-music-online/css/mdi_font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('bower_components/package-music-online/css/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('bower_components/package-music-online/css/theme.css') }}" rel="stylesheet" media="all">
    @yield('style')
    <script>
        var baseUrl = '{{ url('/') }}';
    </script>
</head>

<!-- <body class="animsition"> -->
<body>
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    @include('backend.layouts.header_mobile')
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    @include('backend.layouts.sidemenu')
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        @include('backend.layouts.headers_desktop')
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        @yield('content')
        <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>

</div>

<!-- Jquery JS-->
<script src="{{ asset('bower_components/package-music-online/js/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('bower_components/package-music-online/js/bootstrap.min.js') }}"></script>
<!-- Vendor JS       -->
<script src="{{ asset('bower_components/package-music-online/js/animsition.min.js') }}"></script>
<!-- Main JS-->
<script src="{{ asset('bower_components/package-music-online/js/main.js') }}"></script>
@yield('script')
</body>

</html>
<!-- end document-->
