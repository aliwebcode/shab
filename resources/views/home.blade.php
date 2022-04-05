<!doctype html>
<html lang="ar" dir="rtl">

<head>

    @if (Auth::check())
        <meta name="user-id" content="{{ Auth::user()->id }}">
    @endif
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset=UTF-8>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#ee3158"/>
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#ee3158"/>
    <meta name=msapplication-TileColor content=#FFFFFF>
    <meta name=msapplication-TileImage content=favicon.ico>
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-transcluent"/>
    <title> موقع شبكة للزواج الاسلامي </title>
    <!-- IE-Support -->
    <script src="{{ asset('assets/js/ie-support.min.js') }}" defer></script>
    <!-- css-files -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&amp;display=swap" rel="stylesheet">
    @yield('style')
    <style>
        .navigation-type-2 .inner-wrapper .navigation-wrapper .right-side .social-list li a i {
            font-size: 16px;
            color: var(--black-color) !important;
        }
        footer ul {
            text-align: center;
            font-size: 0;
        }
        footer ul li {
            display: inline-block;
            font-size: 13px;
        }
        footer ul li::after {
            font-family: "Font Awesome 5 Free";
            content: "\f111";
            color: #d88de3;
            margin: 0 10px;
            font-size: 8px;
            font-weight: bold;
        }
        footer ul li:last-child:after {
            content: '';
        }
        footer ul li a {
            color: #E6E6E6;
        }
        footer ul li a:hover {
            color: #d88de3 !important;
        }
        .pagination {
            margin-top: 20px;
            direction: ltr;
        }
    </style>
</head>

<body>
<!-- Page Loader -->
<div class="loader">
    <div class="loading">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<div id="main-wrapper" class="wrapper-hidden z-index-100">
    <!-- Navigation-Menu -->
    <nav class="navigation navigation-type-2">
        <div class="inner-wrapper">
            <div class="navigation-wrapper">
                <div class="logotype-wrapper">
                    <a href="#">
                        <img src="{{ asset('assets/img/logo/cv1.png') }}"
                             alt="Logo">
                    </a>
                </div>
                <div class="right-side">
                    <div class="menu-list-wrapper">
                        <ul class="menu-list">
                            <li class="menu-item"><a href="/">الصفحة الرئيسية</a></li>
                            <li class="menu-item"><a href="/">عن الموقع</a></li>
                            <li class="menu-item"><a href="/"> المدونة</a></li>
                            <li class="menu-item"><a href="/">تواصل معنا</a></li>
                            <li class="menu-item"><a href="/logout">تسجيل الخروج</a></li>
                        </ul>
                    </div>
{{--                    <ul class="social-list">--}}
{{--                        <li>--}}
{{--                            <a href="#">--}}
{{--                                <i class="fa fa-bell"--}}
{{--                                   style="color: #3B5999;"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#">--}}
{{--                                <i class="fa fa-envelope"--}}
{{--                                   style="color: #3B5999;"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                </div>
            </div>
        </div>
    </nav>
    <nav class="navigation-mobile">
        <div class="inner-wrapper">
            <!-- Logotype -->
            <div class="logotype-wrapper">
                <a href="/">
                    <img src="{{ asset('assets/img/logo/cv1.png') }}"
                         alt="Logo">
                </a>
            </div>
            <div class="navigation-side">
                <div class="menu-toggle-wrapper">
                    <div class="menu-toggle toggle-button">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu list -->
        <div class="menu-list-wrapper" data-back-link="go back">
            <div class="menu-toggle-close">
                <i class="far fa-times-circle"></i>
            </div>
            <ul class="menu-list">
                <li class="menu-item"><a href="#">الصفحة الرئيسية</a></li>
                <li class="menu-item"><a href="#">عن الموقع</a></li>
                <li class="menu-item"><a href="#"> المدونة</a></li>
                <li class="menu-item"><a href="#">تواصل معنا</a></li>
                <li class="menu-item"><a href="/login">تسجيل الدخول</a></li>
                <li class="menu-item"><a href="/join">تسجيل جديد</a></li>
            </ul>
        </div>
    </nav>

    <div id="app">
        <router-view :user="user" :auth_user_id="auth_user_id" :complete="complete"
                     :activated="activated" :un_read_messages="un_read_messages"></router-view>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container-fluid footer-inner">
            <div class="footer-body">
                <div class="container">
                    <div class="footer-sidebar">
                        <div class="row">
                            <div class="col-12" style="text-align: center;">
                                <div class="sidebar-widget text-widget">
                                    <img src="{{ asset('assets/img/logo/logo2.png') }}"
                                         style="max-width: 400px;">
                                    <h6 class="sidebar-title" style="font-size: 14px;">
                                        للزواج الشرعي الإسلامي وليس للتعارف و عقد الصداقات
                                    </h6>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <ul>
                                    <li><a href="/">عن الموقع</a></li>
                                    <li><a href="/">تواصل معنا</a></li>
                                    <li><a href="/">سياسة الخصوصية</a></li>
                                    <li><a href="/">الشروط والأحكام</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="copyright-wrapper">
                        <p class="copyright" style="text-align: center;">
                            جميع الحقوق محفوظة لشركة BRLNT
                            &copy;
                            {{ Date("Y") }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- js-files -->
<!-- JQuery -->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- AOS -->
<script src="{{ asset('assets/js/aos.min.js') }}"></script>
<!-- Parallax -->
<script src="{{ asset('assets/js/parallax.min.js') }}"></script>
<!-- Progress Bars -->
<script src="{{ asset('assets/js/progressbar.min.js') }}"></script>
<!-- Magnific -->
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Three -->
<script src="{{ asset('assets/js/three.min.js') }}"></script>
<!-- Projector -->
<script src="{{ asset('assets/js/projector.min.js') }}"></script>
<!-- Renderer -->
<script src="{{ asset('assets/js/canvas-renderer.min.js') }}"></script>
<!-- ImageLoaded -->
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- Anime -->
<script src="{{ asset('assets/js/anime.min.js') }}"></script>
<!-- Isotope -->
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<!-- TweenLite -->
<script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>
<!-- Hover3D -->
<script src="{{ asset('assets/js/jquery.hover3d.min.js') }}"></script>
<!-- EasePack -->
<script src="{{ asset('assets/js/EasePack.min.js') }}"></script>
<!-- Particles -->
<script src="{{ asset('assets/js/particles.min.js') }}"></script>
<!-- JSColor -->
<script src="{{ asset('assets/js/jscolor.min.js') }}"></script>
<!-- YoutubeBackground -->
<script src="{{ asset('assets/js/jquery.youtubebackground.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
<!-- Swiper -->
<script src="{{ asset('assets/js/swiper.min.js') }}"></script>
<!-- Main JS-file -->
<script src="{{ asset('assets/js/main.js') }}"></script>

@if(auth()->check())
    <script>
        let authUser =@JSON(auth()->user())
    </script>
@endif
<script src="{{ asset('js/app.js') }}"></script>
{{--<script src="//code.tidio.co/tjgsenausnuptzoyb15djxrsuwp66tjg.js" async></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"--}}
{{--        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"--}}
{{--        crossorigin="anonymous"></script>--}}
{{--<link href="{{ asset('assets/js/magicsuggest.css') }}" rel="stylesheet" type="text/css">--}}
{{--<script src="{{ asset('assets/js/magicsuggest.js') }}"></script>--}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@yield('script')
</body>
</html>
