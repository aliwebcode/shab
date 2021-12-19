<template>
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile -->
                        <profile-header :user="user" :auth_user_id="auth_user_id"></profile-header>
                        <!-- end profile -->
                        <!-- begin profile-content -->
                        <div class="profile-content row" v-if="!complete">
                            <div class="col-12">
                                <h5 class="text-center mb-4">إكمال التسجيل</h5>
                            </div>
                            <div class="col-12">
                                <div class="alert alert-danger text-center" v-if="empty">
                                    <i class="fa fa-info-circle"></i>
                                    يرجى تعبئة كامل الحقول
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="profile.skin">
                                    <option selected disabled value="">لون البشرة</option>
                                    <option value="أبيض"> أبيض</option>
                                    <option value="أبيض على إحمرار"> أبيض على إحمرار</option>
                                    <option value="حنطي فاتح"> حنطي فاتح</option>
                                    <option value="حنطي على إسمرار"> حنطي على أسمرار</option>
                                    <option value="أسمر داكن"> أسمر داكن</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="profile.religion">
                                    <option selected disabled value="">العقيدة</option>
                                    <option value="أباضي"> أباضي</option>
                                    <option value="سنّي"> سني</option>
                                    <option value="شيعي"> شيعي</option>
                                    <option value="غير ذلك"> غير ذلك</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="profile.smoking">
                                    <option selected disabled value="">هل تدخن</option>
                                    <option value="نعم">نعم</option>
                                    <option value="لا">لا</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="profile.financial">
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
                                <select class="form-control" v-model="profile.financial_plus">
                                    <option selected disabled value="">هل يوجد مصدر أخر للدخل المادي</option>
                                    <option value="نعم"> نعم</option>
                                    <option value="لا"> لا</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="profile.body">
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
                            <div class="col-12 col-md-6" v-if="user.gender == 'female'">
                                <select class="form-control" v-model="profile.future_living">
                                    <option selected disabled value="">بعد الزواج سأسكن</option>
                                    <option value="مستقل"> مستقل</option>
                                    <option value="في ملحق"> في ملحق</option>
                                    <option value="منزل خاص"> منزل خاص</option>
                                    <option value="مع العائلة"> مع العائلة</option>
                                    <option value="لا أمانع"> لا أمانع</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="profile.marriage_method">
                                    <option selected disabled value=""> طريقة الزواج</option>
                                    <option value="عن طريق النظرة الشرعية فقط"> عن طريق النظرة الشرعية فقط</option>
                                    <option value="عن طريق التعارف المسبق أولاً"> عن طريق التعارف المسبق أولا
                                    </option>
                                    <option value="كل ماسبق">كل ماسبق</option>
                                </select>
                            </div>
                            <div class="col-12 text-center mt-3" v-if="showBtn">
                                <button @click="send(user.gender,user.id)" class="btn btn-success">حفظ</button>
                            </div>
                        </div>
                        <!-- end profile-content -->
                        <div class="profile-content row" v-if="complete">
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    <h5>انتهت صلاحية وصولك لهذه الصفحة</h5>
                                </div>
                                <h6 class="text-center">
                                    <router-link to="/profile/me">اضغط لتحويلك إلى الملف الشخصي</router-link>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import ProfileHeader from "../components/ProfileHeader"
import SearchBox from "../components/SearchBox"

export default {
    props: ['user', 'auth_user_id', 'complete'],
    mounted() {

    },
    data: function () {
        return {
            profile: {
                user_id: "",
                skin: "",
                religion: "",
                smoking: "",
                financial: "",
                financial_plus: "",
                body: "",
                marriage_method: "",
                future_living: "",
            },
            empty: 0,
            showBtn: 1,
        }
    },
    components: {ProfileHeader, SearchBox},
    methods: {
        send: function (e,id) {
            this.profile.user_id = id
            if (this.profile.skin == '' || this.profile.religion == '' || this.profile.smoking == '' || this.profile.financial == ''
                || this.profile.financial_plus == '' || this.profile.body == '' || this.profile.marriage_method == ''
            ) {
                this.empty = 1
                return
            } else {
                this.empty = 0
            }
            if (e == 'female' && this.profile.future_living == '') {
                this.empty = 1
                return
            } else {
                this.empty = 0
            }
            this.showBtn = 0
            axios.post('../api/complete-profile',this.profile)
            .then((res) => {
                if(res.data == 1) {
                    Swal.fire({
                        title: 'تهانينا!',
                        text: 'تم حفظ البيانات',
                        icon: 'success',
                        confirmButtonText: 'تم'
                    })
                    window.setTimeout(function(){
                        window.location.href = "/profile";
                    }, 2000);
                }
            })
            .catch((err) => {
                console.log(err)
            })

        }
    }
}
</script>
