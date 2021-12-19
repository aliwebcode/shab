@extends('layouts.app')
@section('style')
    <style>
        select.form-control {
            height: 46.5px !important;
            border-radius: 0;
        }
    </style>
@endsection
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
                        <form action="{{ route('profile.complete.action') }}" method="post">
                            @csrf
                            <div class="profile-content row">
                                <div class="col-12">
                                    <h5 class="text-center mb-4">إكمال التسجيل</h5>
                                </div>
                                @if ($errors->any())
                                    <div class="col-12">
                                        <div class="alert alert-danger text-center">
                                            <i class="fa fa-info-circle"></i>
                                            يرجى تعبئة كامل الحقول
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 col-md-6">
                                    <select class="form-control" name="skin">
                                        <option selected disabled value="">لون البشرة</option>
                                        <option value="أبيض"> أبيض</option>
                                        <option value="أبيض على إحمرار"> أبيض على إحمرار</option>
                                        <option value="حنطي فاتح"> حنطي فاتح</option>
                                        <option value="حنطي على إسمرار"> حنطي على أسمرار</option>
                                        <option value="أسمر داكن"> أسمر داكن</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select class="form-control" name="religion">
                                        <option selected disabled value="0">العقيدة</option>
                                        <option value="أباضي"> أباضي</option>
                                        <option value="سنّي"> سني</option>
                                        <option value="شيعي"> شيعي</option>
                                        <option value="غير ذلك"> غير ذلك</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select class="form-control" name="smoking">
                                        <option selected disabled value="0">هل تدخن</option>
                                        <option value="نعم">نعم</option>
                                        <option value="لا">لا</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select class="form-control" name="financial">
                                        <option selected disabled value="">الوضع المادي</option>
                                        <option value="ضعيف"> ضعيف</option>
                                        <option value="جيد"> جيد</option>
                                        <option value="جيد جداً"> جيد جدا</option>
                                        <option value="ممتاز"> ممتاز</option>
                                        <option value="ممتاز جداً"> ممتاز جدا</option>
                                        <option value="لا يوجد"> لا يوجد</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select class="form-control" name="financial_plus">
                                        <option selected disabled value="">هل يوجد مصدر أخر للدخل المادي</option>
                                        <option value="نعم"> نعم</option>
                                        <option value="لا"> لا</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <select class="form-control" name="body">
                                        <option selected disabled value="">البنية الجسمية</option>
                                        <option value="ضعيف"> ضعيف</option>
                                        <option value="رشيق"> رشيق</option>
                                        <option value="رياضي"> رياضي</option>
                                        <option value="وزن زائد"> وزن زائد</option>
                                        <option value="ضخم"> ضخم</option>
                                        <option value="سمين"> سمين</option>
                                        <option value="جسم غير متناسق مع الطول"> جسم غير متناسق مع الطول</option>
                                        <option value="غير ذلك"> غير ذلك</option>
                                    </select>
                                </div>
                                @if($user->gender == 'female')
                                    <div class="col-12 col-md-6">
                                        <select class="form-control" name="future_living">
                                            <option selected disabled value="">بعد الزواج سأسكن</option>
                                            <option value="مستقل"> مستقل</option>
                                            <option value="في ملحق"> في ملحق</option>
                                            <option value="منزل خاص"> منزل خاص</option>
                                            <option value="مع العائلة"> مع العائلة</option>
                                            <option value="لا أمانع"> لا أمانع</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="col-12 col-md-6">
                                    <select class="form-control" name="marriage_method">
                                        <option selected disabled value=""> طريقة الزواج</option>
                                        <option value="عن طريق النظرة الشرعية فقط"> عن طريق النظرة الشرعية فقط</option>
                                        <option value="عن طريق التعارف المسبق أولاً"> عن طريق التعارف المسبق أولا
                                        </option>
                                        <option value="كل ماسبق">كل ماسبق</option>
                                    </select>
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-success">حفظ</button>
                                </div>
                            </div>
                        </form>
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
