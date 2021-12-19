@extends('layouts.app')
@section('content')
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile -->
                        <div class="profile">
                            <div class="profile-header" id="profile-header" style="background-color:#ee3158">
                                <!-- BEGIN profile-header-cover -->
                                <div class="profile-header-cover"></div>
                                <!-- END profile-header-cover -->
                                <!-- BEGIN profile-header-content -->
                                <div class="profile-header-content">
                                    <!-- BEGIN profile-header-img -->
                                    <div class="profile-header-img">
                                        <a href="#" title="تغيير الصورة" style="color:black;"><i
                                                class="fa fa-edit fa-lg"></i></a>
                                        <a href="#" title="أرسال الصورة" onclick="SendImageModal()"
                                           style="color:black;padding: 0 17% 0 17%;"><i
                                                class="fas fa-comments fa-lg"></i></a>
                                        <a href="#" title="أختيار أيقونة" data-toggle="modal" data-target="#ChooseIcon"
                                           style="color:black;"><i class="far fa-smile-beam fa-lg"></i></a>
                                        @if($user->image)
                                            <img src="{{ asset('storage/images/'.$user->image) }}"
                                                 alt="{{ $user->name }}">
                                        @else
                                            <img src="{{ asset('assets/img/Icon/'.$user->avatar.'.jpg') }}"
                                                 alt="{{ $user->name }}">
                                        @endif
                                    </div>
                                    <!-- END profile-header-img -->
                                    <!-- BEGIN profile-header-info -->
                                    <div class="profile-header-info" style="text-align:right">
                                        <p style="text-align:left;padding:0 0 0 2%;color:white" id="ShownCheckText"
                                           class="hidden-xs">مرئي</p>
                                        <label class="switch hidden-xs" style="float:left">
                                            <input type="checkbox" onchange="ShownCheck()" id="ShownCheck" checked>
                                            <span class="slider round"></span>
                                        </label>
                                        <p class="m-b-10" style="color:white"> الرمز التعريفي : AE4888</p>
                                        <p class="m-b-10" style="color:white">الجنسية : <img class="hidden-xs"
                                                                                             src="assets/img/AR.png"
                                                                                             style="width: 40px;"/>
                                            سعودي</p>
                                        <p class="m-b-10" style="color:white"> السن : 27 سنة</p>
                                        <a href="#" class="btn btn-sm btn-info mb-2">تعديل الحساب</a>
                                    </div>
                                    <div class="col-lg-12 hidden-xs" style="text-align:left">
                                        <h6 style="color:white">غير لون الخلفية</h6>
                                        <a href="#" onclick="ChangeColor('007bff')"><span class="circle"
                                                                                          style="color:#007bff"></span></a>
                                        <a href="#" onclick="ChangeColor('ee3158')"><span class="circle"
                                                                                          style="color:#ee3158"></span></a>
                                        <a href="#" onclick="ChangeColor('6d767f')"><span class="circle"
                                                                                          style="color:#6d767f"></span></a>
                                        <a href="#" onclick="ChangeColor('00B488')"><span class="circle"
                                                                                          style="color:#00B488"></span></a>
                                        <a href="#" onclick="ChangeColor('1DA1F2')"><span class="circle"
                                                                                          style="color:#1DA1F2"></span></a>
                                    </div>
                                    <!-- END profile-header-info -->
                                </div>
                                <!-- END profile-header-content -->
                                <!-- BEGIN profile-header-tab -->
                                <ul class="profile-header-tab nav nav-tabs">
                                    <li class="nav-item" onclick="Open('Profile.html')"><a href="Profile.html"
                                                                                           class="nav-link active show"
                                                                                           data-toggle="tab">بياناتي</a>
                                    </li>
                                    <li class="nav-item" onclick="Open('Interest.html')"><a href="Interest.html"
                                                                                            class="nav-link"
                                                                                            data-toggle="tab">أهتماماتي</a>
                                    </li>
                                    <li class="nav-item" onclick="Open('Chat.html')"><a href="Chat.html"
                                                                                        class="nav-link"
                                                                                        data-toggle="tab">المحادثات
                                            (0)</a></li>
                                    <li class="nav-item" onclick="Open('IgnoringList.html')"><a href="IgnoringList.html"
                                                                                                class="nav-link"
                                                                                                data-toggle="tab">قائمة
                                            التجاهل (0)</a></li>
                                    <li class="nav-item" onclick="Open('RecordList.html')"><a href="RecordList.html"
                                                                                              class="nav-link"
                                                                                              data-toggle="tab">السجل</a>
                                    </li>
                                    <li class="nav-item" onclick="Open('Mail.html')"><a href="Mail.html"
                                                                                        class="nav-link"
                                                                                        data-toggle="tab">البريد (0)</a>
                                    </li>
                                    <li class="nav-item" onclick="Open('PenddingRequest.html')"><a
                                            href="PenddingRequest.html" class="nav-link" data-toggle="tab">طلبات معلقة
                                            (0)</a></li>
                                    <li class="nav-item" onclick="Open('LegitimateRequest.html')"><a
                                            href="LegitimateRequest.html" class="nav-link" data-toggle="tab">طلبات نظرة
                                            شرعية (0)</a></li>
                                </ul>
                                <!-- END profile-header-tab -->
                            </div>
                        </div>
                        <!-- end profile -->
                        <!-- begin profile-content -->
                        <div class="profile-content row">

                            <div class="col-lg-12">
                                @if($user->hasVerifiedEmail() == 0)
                                    <div class="alert alert-danger" role="alert" style="text-align:right">
                                        <i class="fa fa-times-circle"></i>يرجى تأكيد بريدك الالكتروني
                                        <form class="d-inline" method="POST"
                                              action="{{ route('verification.resend') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                                إرسال الرمز مجدداً
                                            </button>
                                            .
                                        </form>
                                    </div>
                                @endif
                                @if(!$user->profile)
                                    <div class="alert alert-warning" role="alert" style="text-align:right">
                                        <i class="fa fa-info-circle"></i> بياناتك غير مكتملة
                                        <a href="{{ route('profile.complete') }}">أكمل ملفك الشخصي</a>.
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header" style="text-align: center;" id="SearchDivBtn"
                                         onclick="ShowSearchDiv()"> بحث جديد
                                    </div>
                                    <div class="card-body" id="SearchDiv" style="display: none;">
                                        <div
                                            class="contact-form-white d-flex flex-column align-items-center element-form-left">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <select class="form-control">
                                                        <option selected disabled>العقيدة</option>
                                                        <option> أباضي</option>
                                                        <option> سني</option>
                                                        <option> شيعي</option>
                                                        <option> غير ذلك</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-control">
                                                        <option selected>الحالة الإجتماعية</option>
                                                        <option value="1"> أعزب</option>
                                                        <option value="2"> متزوج</option>
                                                        <option value="3"> مطلق</option>
                                                        <option value="4"> أرملة</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-control">
                                                        <option selected>الأصل العرقي</option>
                                                        <option>رقم 1</option>
                                                        <option>رقم 2</option>
                                                        <option> رقم 3</option>
                                                        <option> بيسر</option>
                                                        <option> غير ذلك</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div id="magicsuggest"></div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select class="form-control">
                                                        <option selected>المؤهل العلمي</option>
                                                        <option> دكتوراه</option>
                                                        <option> ماجستير</option>
                                                        <option> بكالوريوس</option>
                                                        <option> دبلوم جامعي</option>
                                                        <option> دبلوم عام</option>
                                                        <option> ثانوية</option>
                                                        <option> إعدادية</option>
                                                        <option> غير ذلك</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select class="form-control">
                                                        <option selected>لون البشرة</option>
                                                        <option> أبيض</option>
                                                        <option> أبيض على إحمرار</option>
                                                        <option> حنطي فاتح</option>
                                                        <option> حنطي على أسمرار</option>
                                                        <option> أسمر داكن</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select class="form-control">
                                                        <option selected>الوضع المادي</option>
                                                        <option> ضعيف</option>
                                                        <option> جيد</option>
                                                        <option> جيد جدا</option>
                                                        <option> ممتاز</option>
                                                        <option> ممتاز جدا</option>
                                                        <option> لايوجد</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select class="form-control">
                                                        <option selected>مكان السكن بعد الزواج</option>
                                                        <option> مستقل</option>
                                                        <option> في ملحق</option>
                                                        <option> منزل خاص</option>
                                                        <option> مع العائلة</option>
                                                        <option> لا أمانع</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div id="magicsuggest2"></div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <input type="number" placeholder=" العمر من"
                                                                   class="input-small">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="number" placeholder="إلي" class="input-small">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <input type="number" placeholder=" الوزن من"
                                                                   class="input-small">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="number" placeholder="إلي" class="input-small">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <input type="number" placeholder=" الطول من"
                                                                   class="input-small">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="number" placeholder="إلي" class="input-small">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button style="font-size: 14px;" class="button-submit" type="submit">
                                                    بحث
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                            </div>
                            <div class="tab-content p-0 col-lg-8">
                                <div class="tab-pane fade active show" id="tab1">

                                    <form
                                        class="card contact-form-white d-flex flex-column align-items-center element-form-left"
                                        style="padding:5%">
                                        <h5 style="text-align:center">بيانات الحساب</h5>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" placeholder="الإسم الثلاثي" class="input-small">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder=" رقم الهوية / الجواز"
                                                       class="input-small">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="email" placeholder="البريد الإلكتروني" class="input-small">

                                            </div>
                                            <div class="col-lg-6">
                                                <input type="tel" placeholder="رقم الهاتف" class="input-small">

                                            </div>
                                            <div class="col-lg-6">
                                                <input type="password" placeholder=" الرقم السري بحد أقل 8 أحرف"
                                                       class="input-small">

                                            </div>
                                            <div class="col-lg-6">
                                                <input type="password" placeholder="تأكيد الرقم السري"
                                                       class="input-small">

                                            </div>

                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-2">
                                                <button style="font-size: 15px;" class="button-submit" type="submit">
                                                    حفظ
                                                </button>
                                            </div>
                                            <div class="col-lg-5"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body" style="text-align: center;">
                                        <h5 class="card-title" style="text-align:center">برج الجوزاء</h5>
                                        <hr/>
                                        <p class="card-text" style="text-align:center">
                                            برج الجوزاء هو ثالث برج من الأبراج الإثنى عشر من دائرة البروج أي قوس من
                                            دائرة مسار الشمس. برج من الجهة الشمالية للسماء. تمر الشمس في برج الجوزاء من
                                            21 مايو إلى 21 يونيو. تكون الشمس في هذا البرج عند أواخر الربيع.
                                        </p>
                                        <hr/>
                                        <a href="#">حظك اليوم</a>
                                    </div>
                                </div>
                                <br/>
                                <div class="card">
                                    <div class="card-body" style="text-align: center;">
                                        <h5 class="card-title" style="text-align:center"> فرصتك للزواج 70%</h5>
                                        <hr/>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                 role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 75%"></div>
                                        </div>
                                        <hr/>
                                        <a href="#" onclick="$('#SearchDivBtn').click();">أبحث الأن و لا تتردد</a>
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
@endsection

@section('script')
    <script>
        function ChangeColor(Color) {
            $('#profile-header').css("background-color", "#" + Color);
        }
    </script>
@endsection
