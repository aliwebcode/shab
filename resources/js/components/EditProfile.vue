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
                        <div class="profile-content row">
                            <div class="col-12">
                                <h5 class="text-center mb-4">تعديل الملف الشخصي</h5>
                            </div>
                            <div class="col-12">
                                <div class="alert alert-danger text-center" v-if="empty">
                                    <i class="fa fa-info-circle"></i>
                                    يرجى تعبئة كامل الحقول
                                </div>
                            </div>
                            <div class="contact-form-white w-100">
                                <div class="white-section p-3">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">اسمك الكامل</label>
                                            <input type="text" class="input-small"
                                                   v-model="userData.name">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">البريد الالكتروني</label>
                                            <input type="text" class="input-small"
                                                   v-model="userData.email">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">الجنسية</label>
                                            <select v-model="userData.nationality" class="form-control">
                                                <option selected disabled :value="user.nationality">{{
                                                        user.nationality
                                                    }}
                                                </option>
                                                <option value="egypt">جمهوريّة مصر العربية</option>
                                                <option value="sudan">جمهوريّة السودان</option>
                                                <option value="syria">الجمهوريّة العربيّة السوريّة</option>
                                                <option value="tunisia">الجمهوريّة التونسيّة</option>
                                                <option value="s">جمهوريّة الصومال</option>
                                                <option value="algeria">الجمهوريّة الجزائريّة الديمقراطيّة الشعبيّة
                                                </option>
                                                <option value="morocco">المملكة المغربيّة</option>
                                                <option value="iraq">جمهوريّة العراق</option>
                                                <option value="saudi">المملكة العربيّة السعوديّة</option>
                                                <option value="yemen">الجمهوريّة اليمنيّة</option>
                                                <option value="libya">دولة ليبيا</option>
                                                <option value="jordan">المملكة الأردنيّة الهاشميّة</option>
                                                <option value="uae">دولة الإمارات العربيّة المتّحدة</option>
                                                <option value="lebanon">الجمهوريّة اللبنانيّة</option>
                                                <option value="m">الجمهوريّة الإسلاميّة الموريتانيّة</option>
                                                <option value="egypt">دولة الكويت</option>
                                                <option value="oman">سطنة عُمان</option>
                                                <option value="qatar">دولة قطر</option>
                                                <option value="j">جمهوريّة جيبويتي</option>
                                                <option value="bahrain">مملكة البحرين</option>
                                                <option value="s">جمهوريّة القمر الاتّحاديّة الإسلاميّة</option>
                                                <option value="palestine">دولة فلسطين المحتلّة</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">بلد الإقامة</label>
                                            <select v-model="userData.country" class="form-control">
                                                <option selected disabled :value="user.nationality">{{
                                                        user.nationality
                                                    }}
                                                </option>
                                                <option value="egypt">جمهوريّة مصر العربية</option>
                                                <option value="sudan">جمهوريّة السودان</option>
                                                <option value="syria">الجمهوريّة العربيّة السوريّة</option>
                                                <option value="tunisia">الجمهوريّة التونسيّة</option>
                                                <option value="s">جمهوريّة الصومال</option>
                                                <option value="algeria">الجمهوريّة الجزائريّة الديمقراطيّة الشعبيّة
                                                </option>
                                                <option value="morocco">المملكة المغربيّة</option>
                                                <option value="iraq">جمهوريّة العراق</option>
                                                <option value="saudi">المملكة العربيّة السعوديّة</option>
                                                <option value="yemen">الجمهوريّة اليمنيّة</option>
                                                <option value="libya">دولة ليبيا</option>
                                                <option value="jordan">المملكة الأردنيّة الهاشميّة</option>
                                                <option value="uae">دولة الإمارات العربيّة المتّحدة</option>
                                                <option value="lebanon">الجمهوريّة اللبنانيّة</option>
                                                <option value="m">الجمهوريّة الإسلاميّة الموريتانيّة</option>
                                                <option value="egypt">دولة الكويت</option>
                                                <option value="oman">سطنة عُمان</option>
                                                <option value="qatar">دولة قطر</option>
                                                <option value="j">جمهوريّة جيبويتي</option>
                                                <option value="bahrain">مملكة البحرين</option>
                                                <option value="s">جمهوريّة القمر الاتّحاديّة الإسلاميّة</option>
                                                <option value="palestine">دولة فلسطين المحتلّة</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">الحالة الاجتماعية</label>
                                            <select class="form-control" v-model="userData.status">
                                                <option disabled value="">الحالة الإجتماعية</option>
                                                <option value="single" v-if="user.gender == 'male'"> أعزب</option>
                                                <option value="married" v-if="user.gender == 'male'"> متزوج</option>
                                                <option value="divorced" v-if="user.gender == 'male'"> مطلق</option>
                                                <option value="single" v-if="user.gender == 'female'"> عزباء</option>
                                                <option value="divorced" v-if="user.gender == 'female'"> مطلقة</option>
                                                <option value="widow" v-if="user.gender == 'female'"> أرملة</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">تاريخ الميلاد</label>
                                            <input type="date" v-model="userData.birthday">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">الطول</label>
                                            <input type="number" class="input-small"
                                                   v-model="userData.length">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">الوزن</label>
                                            <input type="number" class="input-small"
                                                   v-model="userData.weight">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">الأصل العرقي</label>
                                            <select class="form-control" v-model="userData.ethnicity">
                                                <option selected disabled value="">الأصل العرقي</option>
                                                <option value="num1"> رقم 1 (الوالدان أصل وفصل)</option>
                                                <option value="num2"> رقم 2 (أحد الوالدن أصل وفصل)</option>
                                                <option value="num3"> رقم 3 (الوالدان من البشرة السمراء)</option>
                                                <option value="p1"> بيسر 1 (عرق مخلوط من نسل أبيض البشره)</option>
                                                <option value="p2">بيسر 2 (عرق مخلوط من نسل أسمر البشره)</option>
                                                <option value="p3">بيسر 3 (عرق مخلوط من نسل مخلوط البشره)</option>
                                                <option value="other"> غير ذلك</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6" v-if="userData.ethnicity == 'num2'">
                                            <label class="float-right">اختر أيهما</label>
                                            <select class="form-control" v-model="userData.ethnicity_parent">
                                                <option selected disabled value="">اختر أيهما</option>
                                                <option value="father">الأب</option>
                                                <option value="mother">الأم</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">المؤهل العلمي</label>
                                            <select class="form-control" v-model="userData.study">
                                                <option selected disabled value="">المؤهل العلمي</option>
                                                <option value="phd"> دكتوراه</option>
                                                <option value="ma"> ماجستير</option>
                                                <option value="ba"> بكالوريوس</option>
                                                <option value="university diploma"> دبلوم جامعي</option>
                                                <option value="diploma"> دبلوم عام</option>
                                                <option value="high school"> ثانوية</option>
                                                <option value="middle school"> إعدادية</option>
                                                <option value="other"> غير ذلك</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">الوظيفة</label>
                                            <select class="form-control" v-model="userData.employee">
                                                <option selected disabled value="" v-if="user.gender == 'male'"> هل انت موظف ؟</option>
                                                <option selected disabled value="" v-if="user.gender == 'female'"> هل انت موظفة ؟
                                                </option>
                                                <option value="government"> قطاع حكومي</option>
                                                <option value="private"> قطاع خاص</option>
                                                <option value="looking fo job"> باحث عن عمل</option>
                                                <option value="retired" v-if="user.gender != 'female'"> متقاعد</option>
                                                <option value="no work"> لا أرغب بالعمل</option>
                                                <option value="house wife" v-if="user.gender != 'male'"> ربة منزل</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="float-right">رقم الهاتف</label>
                                            <input type="text" class="input-small"
                                                   v-model="userData.phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-3" v-if="showBtn">
                                <button @click="send(user.id)" class="btn btn-success" type="button">حفظ</button>
                            </div>
                        </div>
                        <!-- end profile-content -->
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
        // get auth user id
        var userId = document.querySelector("meta[name='user-id']").getAttribute('content')

        axios.get('/api/my-profile/' + userId)
            .then((res) => {
                this.userData = res.data.user
                // this.complete = res.data.complete
                // this.activated = res.data.activated
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            userData: {},
            empty: 0,
            showBtn: 1,
        }
    },
    components: {ProfileHeader},
    methods: {
        send: function (id) {
            if (this.userData.name == '' || this.userData.country == '' ||
                this.userData.nationality == '' || this.userData.status == '' ||
                this.userData.birthday == '' || this.userData.length == '' ||
                this.userData.weight == '' || this.userData.ethnicity == '' ||
                this.userData.study == '' || this.userData.employee == '' ||
                this.userData.email == '' || this.userData.phone == '') {
                this.empty = 1
                window.scrollTo(0, 60)
                return
            }
            let data = this.userData
            axios({
                method: "post",
                url: "/api/edit-profile",
                data: data
            })
            .then((res) => {
                if (res.data == 1) {
                    Swal.fire({
                        title: 'تهانينا!',
                        text: 'تم التعديل بنجاح',
                        icon: 'success',
                        confirmButtonText: 'تم'
                    })
                }
            })
            .catch((err) => {
                console.log(err)
            })
        }
    }
}
</script>
