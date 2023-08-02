<!DOCTYPE html>

<!--
   Template:   Waldo - Responsive HTML5 Portfolio Website Template
   Author:     Themetorium
   URL:        http://themetorium.net
   Notes:		You are free to use prepared helper classes to customize your website. Look into "helper.css" file for more info.
-->

<html lang="en">
<head>

    <!-- Title -->
    <title>Home - Waldo</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Responsive One Page HTML5 Website Template">
    <meta name="keywords" content="HTML5, CSS3, Bootsrtrap, Responsive, Template, Theme, Website"/>
    <meta name="author" content="themetorium.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon (http://www.favicon-generator.org/) -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google font (https://www.google.com/fonts) -->
    <link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,400italic,700,700italic' rel='stylesheet'
          type='text/css'> <!-- Body font (Ubuntu Mono) -->

    <!-- Bootstrap CSS (http://getbootstrap.com) -->
    {{--		<link rel="stylesheet" type='text/css' href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}"> <!-- bootstrap CSS (http://getbootstrap.com) -->--}}

    <!-- Libs and Plugins CSS -->
    {{--		<link rel="stylesheet" href="{{asset('frontend/vendor/jquery/css/jquery-ui.min.css')}}"> <!-- jquery UI CSS (https://jquery.com) -->--}}
    <link rel="stylesheet" href="{{asset('frontend/vendor/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- Font Icons CSS (https://fontawesome.com) Free version! -->
    <link rel="stylesheet" href="{{asset('frontend/vendor/owl-carousel/css/owl.carousel.min.css')}}">
    <!-- Owl Carousel CSS (https://owlcarousel2.github.io/OwlCarousel2/) -->
    <link rel="stylesheet" href="{{asset('frontend/vendor/owl-carousel/css/owl.theme.default.min.css')}}">
    <!-- Owl Carousel default theme CSS (https://owlcarousel2.github.io/OwlCarousel2/) -->
    <link rel="stylesheet" href="{{asset('frontend/vendor/magnific-popup/css/magnific-popup.css')}}">
    <!-- Magnific Popup CSS (http://dimsemenov.com/plugins/magnific-popup/) -->
    <link rel="stylesheet" href="{{asset('frontend/vendor/ytplayer/css/jquery.mb.YTPlayer.min.css')}}">
    <!-- YTPlayer CSS (more info: https://github.com/pupunzi/jquery.mb.YTPlayer) -->

    <!-- Theme master CSS -->
    <link rel="stylesheet" type='text/css' href="{{asset('frontend/css/helper.css')}}">
    <link rel="stylesheet" type='text/css' href="{{asset('frontend/css/theme.css')}}">


</head>

<body>

<!-- Begin global search (simple)
==================================
* Use class "gl-search-dark" to enable global search dark style.
-->
<div id="global-search" class="gl-s">

    <!-- Begin global search close button -->
    <div class="global-search-close-wrap">
        <a href="#0" class="global-search-close" title="Close">
            <i class="fas fa-close"></i>
        </a>
    </div>
    <!-- End global search close button -->

    <!-- Begin global search form -->
    <form id="global-search-form" method="get" action="search-results-2.html">
        <input type="text" class="form-control" id="global-search-input" name="search"
               placeholder="Type your keywords...">
    </form>
    <!-- End global search form -->

</div>
<!-- End global search -->


<!-- ===================
///// Begin header /////
==================== -->
@include('partials.header')
<!-- End header -->


<!-- *************************************
*********** Begin body content ***********
************************************** -->
<div id="body-content">



    <!-- Begin content container -->
    @yield('body')
    <!-- End content container -->


    <!-- ===================
    ///// Begin footer /////
    ========================
    * Use class "fixed-footer" to enable fixed footer (no effect on small devices).
    -->
    @include('partials.footer')
    <!-- End footer -->


</div>
<!-- End body content -->


<!-- ====================
///// Scripts below /////
===================== -->

<!-- Core JS -->
<script src="{{asset('frontend/vendor/jquery/js/jquery.min.js')}}"></script> <!-- jquery JS (https://jquery.com) -->
<script src="{{asset('frontend/vendor/jquery/js/jquery-ui.min.js')}}"></script>
<!-- jquery UI JS (https://jquery.com) -->
<script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- bootstrap JS (http://getbootstrap.com) -->

<!-- Libs and Plugins JS -->
<script src="{{asset('frontend/vendor/pace.min.js')}}"></script>
<!-- Pace (page loader) JS (http://github.hubspot.com/pace/docs/welcome/) -->
<script src="{{asset('frontend/vendor/jquery.easing.min.js')}}"></script>
<!-- Easing JS (http://gsgd.co.uk/sandbox/jquery/easing/) -->
<script src="{{asset('frontend/vendor/isotope.pkgd.min.js')}}"></script>
<!-- Isotope JS (http://isotope.metafizzy.co) -->
<script src="{{asset('frontend/vendor/imagesloaded.pkgd.min.js')}}"></script>
<!-- ImagesLoaded JS (https://github.com/desandro/imagesloaded) -->
<script src="{{asset('frontend/vendor/jquery.mousewheel.min.js')}}"></script>
<!-- A jQuery plugin that adds cross browser mouse wheel support (https://github.com/jquery/jquery-mousewheel) -->
<script src="{{asset('frontend/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>
<!-- Owl Carousel JS (https://owlcarousel2.github.io/OwlCarousel2/) -->
<script src="{{asset('frontend/vendor/magnific-popup/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Magnific Popup JS (http://dimsemenov.com/plugins/magnific-popup/) -->
<script src="{{asset('frontend/vendor/ytplayer/js/jquery.mb.YTPlayer.min.js')}}"></script>
<!-- YTPlayer JS (more info: https://github.com/pupunzi/jquery.mb.YTPlayer) -->

<!-- Theme master JS -->
<script src="{{asset('frontend/js/theme.js')}}"></script>


<!--==============================
///// Begin Google Analytics /////
============================== -->

<!-- Paste your Google Analytics code here.
Go to http://www.google.com/analytics/ for more information. -->

<!-- End Google Analytics -->


</body>

</html>
