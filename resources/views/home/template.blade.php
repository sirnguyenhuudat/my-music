<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- Begin Head -->

<head>
    <title>
        @section('title_page')
            Music
        @show
    </title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Music">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="MobileOptimized" content="320">
    <!--Start Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_css') . 'fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_css') . 'bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_css') . 'font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_js') . 'plugins/swiper/css/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_js') . 'plugins/nice_select/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_js') . 'plugins/player/volume.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_js') . 'plugins/scroll/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_css') . 'style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(config('bower.home_css') . 'my-style.css') }}">
    <!-- Favicon Link -->
    <link rel="shortcut icon" type="image/png" href="{{ asset(config('bower.home_images') . 'favicon.png') }}">
    @yield('style')
    <style>
        #form_login .form-group .invalid-feedback{
            text-align: left;
        }
        #resigter_form .form-group .invalid-feedback{
            text-align: left;
        }
        .login_with_social{
            float: left;
            color: white;
        }
        .ms_lang_btn a.ms_btn{
            opacity: 1 !important;
        }
    </style>
    <script>
        var baseUrl = '{{ url('/') }}';
        var baseUrlImageBower = '{{ url('/') . '/' . config('bower.home_images') }}';
    </script>
</head>

<body>
<!-- Loader Start -->
<div class="ms_loader">
    <div class="wrap">
        <img src="{{ asset(config('bower.home_images') . 'loader.gif') }}" alt="">
    </div>
</div>
<!-- Main Wrapper Start -->
<div class="ms_main_wrapper">
    <!-- Side Menu Start -->
    @include('home.layouts.sidemenu')
    <!-- Main Content Start -->
    @yield('content')
    <!-- Footer Start -->
    @include('home.layouts.footer')
</div>
<!-- Register Modal Start -->
@include('home.layouts.modal')
<!--Main js file Style-->
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'plugins/swiper/js/swiper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'plugins/player/jplayer.playlist.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'plugins/player/jquery.jplayer.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'plugins/player/volume.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'plugins/nice_select/jquery.nice-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'plugins/scroll/jquery.mCustomScrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'custom.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'typeahead.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset(config('bower.home_js') . 'my-script.js') }}"></script>
@yield('script')
@error('email')
    <script type="text/javascript" src="{{ asset('js/frontend/login.js') }}"></script>
@enderror
@error('password')
    <script type="text/javascript" src="{{ asset('js/frontend/login.js') }}"></script>
@enderror
@error('name_reg')
    <script type="text/javascript" src="{{ asset('js/frontend/register.js') }}"></script>
@enderror
@error('email_reg')
    <script type="text/javascript" src="{{ asset('js/frontend/register.js') }}"></script>
@enderror
@error('password_reg')
    <script type="text/javascript" src="{{ asset('js/frontend/register.js') }}"></script>
@enderror
</body>

</html>
