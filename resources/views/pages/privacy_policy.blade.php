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

    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile-content -->
                        <div class="profile-content row" style="padding: 25px 0">
                            <div class="tab-content col-lg-12">
                                <div class="tab-pane fade active show" id="tab1">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="my-2 text-right">سياسة الخصوصية</h5>
                                            <div class="card d-flex flex-column align-items-start p-3 text-right">
                                                <h6>مقدمة</h6>
                                                <p class="my-2">موقع شبكة يهتم بحماية خصوصية بياناتكم الشخصية، فنقر هذه السياسة لتبصيرك بالبيانات الشخصية التي يتم جمعها عنك وحدود استخدام هذه البيانات أو الكشف عنها، وبمجرد زيارتك للبرنامج أو تسجيلك فيه أو دخولك معنا فهذا يعني أن قد اطلعت على هذه السياسة ووافقت على كل ما ورد بها من أحكام وممارسات.</p>
                                                <strong>أولاً: التعريفات</strong>
                                                <strong>ثانيا: الخدمات التي يقدمها تطبيق وموقع شبكة</strong>
                                                <strong>ثالثا: ملفات تعريف الارتباط (سياسة الكوكيز)</strong>
                                                <strong>رابعًا: الإفصاح عن بياناتك الشخصية</strong>
                                                <strong>خامسا: التزامات المستخدم</strong>
                                                <strong>سادسًا: التعديلات</strong>
                                                <hr class="w-100">
                                                <h6>أولاً: التعريفات</h6>
                                                <p class="my-2">في هذه السياسة، وما لم يقتضي السياق خلاف ذلك يكون للمصطلحات التالية المعاني المشار إليها.
                                                    " شبكة" ،أو "الموقع" أو " التطبيق" أو "نحن" أو "ضمير المتكلم": يشير إلى تطبيق  وموقع شبكة.
                                                    "المستخدم" أو "أنت" أو "ضمير الملكية للمخاطب": تعني الشخص الذي يزور الموقع / التطبيق أو يستخدمه بأي شكل من الأشكال أو يدخل ويتصفح للحصول على الخدمات المعروضة من خلال التطبيق أو موقع شبكة.
                                                    "السياسة" تشير إلى هذه الوثيقة وما تتضمنه من شروط وأحكام.
                                                    "البيانات الشخصية" تشير إلى البيانات التي يمكن استخدامها لتحديد هوية شخص ما أو الاتصال به.
                                                </p>
                                                <hr class="w-100">
                                                <h6>ثانيا: الخدمات التي يقدمها موقع وتطبيق شبكة</h6>
                                                <p class="my-2">يعتبر موقع وتطبيق شبكة بمثابة حلقة الوصل بين الراغبين بالزواج وفقا للأحكام الشرعية الإسلامية فقط المتعارف به في دين الإسلام والسنة النبوية وذلك بهدف التيسير على المقبلين بالزواج وبمقابل مبلغ مالي مشار إليه في بنود وثيقة الشروط والأحكام.
                                                    (إقرأ الشروط والأحكام)
                                                </p>
                                                <hr class="w-100">
                                                <h6>ثالثًا: ملفات تعريف الارتباط (سياسة الكوكيز)</h6>
                                                <p class="my-2">
                                                    ملفات تعريف الارتباط هي ملفات نصية يتم تخزينها على الجهاز الخاص بك عند زيارة بعض صفحات الويب، وهذه الملفات لن تضر جهازك أو بياناتك، فهي تستخدم على النحو الآتي:
                                                </p>
                                                <ol class="my-2">
                                                    <li>تستخدم ملفات تعريف الارتباط بغرض تقديم المعلومات، فعلى سبيل المثال في التطبيق/الموقع تساعدنا بعض ملفات تعريف الارتباط التي نستخدمها على تحديد الأخطاء وإصلاحها وتطوير جودة المنتج.</li>
                                                    <li>تساعد بعض ملفات تعريف الارتباط على تذكر الصفحات والنماذج التي تشاهدها عند زيارتك لتطبيقنا أو موقعنا.</li>
                                                    <li>تهدف ملفات تعريف الارتباط إلى تحسين التطبيق/موقع شبكة في كل مرة تزوره.</li>
                                                    <li>هناك ملفات تعريف ارتباط لصفحات منشورة عبر برنامجنا غير تابعة لنا، كمحتوى الفيديو الخاص بموقع يوتيوب Youtube.com، وأنت تعلم وتوافق أننا لا نتحكم بملفات تعريف الارتباط الخاصة بمثل هذه المواقع وعليك الدخول على هذه المواقع والاطلاع على السياسات التي يتبعونها أو حظر مشاهدتها حسب الخصائص المتوفرة في كل متصفح.</li>
                                                    <li>تستطيع تغيير تفضيلات ملفات تعريف الارتباط من خلال دخولك على إعدادات جهازك واختيار المناسب لك أو حسب جودة المتصفح الذي تستخدمه.</li>
                                                </ol>
                                                <hr class="w-100">
                                                <h6>رابعا: الإفصاح عن بياناتك الشخصية</h6>
                                                <ol class="my-2">
                                                    <li>أنت تعلم وتوافق على أن الانترنت ليس وسيلة آمنة، وأن سرية بياناتك الشخصية لا يمكن مصادرتها أو بيعها أو الإتجار بها.</li>
                                                    <li>نتعهد نحن في تطبيق / موقع شبكة وفي حدود المسموح به قانونًا بعدم الكشف عن بياناتك السرية أو استخدامها بشكل يتعارض مع حقك في الخصوصية.</li>
                                                    <li>أنت تمنحنا الحق في السماح للموظفين لدينا بالتعامل على بياناتك الشخصية بكل حذر وسرية وفي حدود تقديم الخدمات في التطبيق / الموقع.</li>
                                                    <li>لا يجوز لنا الكشف عن بياناتك الشخصية لأي عضو/ فرد / جماعات خارج نطاق مسؤوليتنا إلا للسلطات القانونية وبمذكرات رسميه فقط ومن الجهات المخولة قانونا.</li>
                                                    <li>
                                                        قد نكشف بياناتك الشخصية للطرف الثالث في الحالات الاتية:
                                                        <ul style="list-style: square">
                                                            <li style="list-style: square">في حالة بيع أصول من المؤسسه، أو دخول شركاء بها، وتحت ضمان حقوق الخصوصية لكل مستخدم.</li>
                                                            <li style="list-style: square">الجهات التي تشاركنا تقديم الخدمات للحماية من مخاطر الائتمان وعمليات الاحتيال والقرصنة الالكترونية.</li>
                                                            <li style="list-style: square">إذا كنا مطالبين بالإفصاح عن بياناتك الشخصية أو مشاركتها أمام السلطات العليا من أجل حماية الحقوق والملكية أو سلامة التطبيق/الموقع أو موظفينا أو الآخرين.</li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        قد نكشف بياناتك الشخصية للامتثال للالتزامات القانونية أو التعاقدية في الأحوال الآتية:
                                                        <ul style="list-style: square">
                                                            <li style="list-style: square">إذا كنا مطالبين بالإفصاح عن بياناتك الشخصية أو مشاركتها من أجل الامتثال لأي التزام قانوني أو من أجل فرض أو تطبيق شروطنا وأحكامنا أو أي اتفاقية أخرى.</li>
                                                            <li style="list-style: square">في حالة صدور حكم قضائي أو قرار من الجهات القضائية المختصة.</li>
                                                            <li style="list-style: square">في حالة صدور قرار من السلطات العامة.</li>
                                                        </ul>
                                                    </li>
                                                </ol>
                                                <hr class="w-100">
                                                <h6>خامسا: التزامات المستخدم</h6>
                                                <ol class="my-2">
                                                    <li>يلتزم المستخدم" العميل" في بنود هذه السياسة.</li>
                                                    <li>يلتزم المستخدم بهذه السياسة والسياسات الأخرى المعروضة على التطبيق/الموقع.</li>
                                                    <li>يلتزم المستخدم بتوضيح المطلوب بدقة، وأن تكون قانونية وشرعية غير متطرفه لاتدخل بالديانات أو الأصول العرفيه والعرقيه وأن يتم احترام الرأي العام.</li>
                                                    <li>يلتزم المستخدم بأداء رسوم الاشتراك.</li>
                                                    <li>يلتزم أطراف هذه الاتفاقية بالمحافظة على سرية وخصوصية بياناتهم الشخصية، ويقرون وعلى مسئوليتهم الشخصية بأن إفصاح أيًا منهم عن المعلومات الشخصية للطرف الآخر يكون على مسئوليته دون أي تدخل منا، ودون أي مسئولية علينا.</li>
                                                    <li>أنت تقر بتجنب إتباع أي وسيلة من شأنها تساعد في جمع معلومات المستخدمين الآخرين بالموقع/التطبيق، بما في ذلك البريد الالكتروني وأرقام الجوال ووسائل الاتصال الأخرى الخاصة بهم.</li>
                                                </ol>
                                                <hr class="w-100">
                                                <h6>سادسا: التعديلات</h6>
                                                <ol class="my-2">
                                                    <li>يحق لنا تعديل هذه السياسة في أي وقت من الأوقات.</li>
                                                    <li>في حالة قيامنا بتعديل هذه السياسة سنقوم بنشر إشعار عبر التطبيق والموقع، ويفترض من كل مستخدم الاطلاع بهذه التعديلات بمجرد نشر الإشعار عبر التطبيق أو الموقع.</li>
                                                    <li>إن استمرارك في استخدام التطبيق أو الموقع الإلكتروني الخاص بنا يعني أنك موافق على التعديلات والتحديثات التي قمنا بها.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end profile-content -->
                    </div>
                </div>
            </div>
        </div>
    </section>

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
