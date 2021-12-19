<template>
    <div>
        <div class="row mb-4">
            <div class="col-12 block">
                <div class="wrapper-progressBar">
                    <ul class="progressBar">
                        <li :class="{active:form >= 1}">المعلومات الأساسية</li>
                        <li :class="{active:form >= 2}">تفاصيل عنك</li>
                        <li :class="{active:form >= 3}">معلومات الحساب</li>
                    </ul>
                </div>
            </div>
        </div>
        <form action="" v-if="form == 1">
            <div class="row">
                <div class="col-12 col-md-6 m-auto">
                    <div class="alert alert-danger text-center" v-if="errors.empty">
                        <i class="fa fa-info-circle"></i>
                        يرجى تعبئة جميع الحقول وتحديد جنسك
                    </div>
                    <div class="alert alert-danger text-center" v-if="errors.age">
                        <i class="fa fa-info-circle"></i>
                        عذراً،عمرك أقل من العمر المسموح به (23 سنة)
                    </div>
                </div>
                <div class="col-12">
                    <h6 class="text-center">اختر جنسك</h6>
                    <div class="select-gender text-center my-4">
                        <div class="single-gender" :class="{active:user.gender=='male'}">
                            <input id="male" type="radio" @click="changeGender('male')">
                            <img src="assets/img/m.png" alt="ذكر">
                        </div>
                        <div class="single-gender" :class="{active:user.gender=='female'}">
                            <input id="female" type="radio" @click="changeGender('female')">
                            <img src="assets/img/f.png" alt="أنثى">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="contact-form-white d-flex flex-column element-form-left mx-4">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="text" class="input-small" placeholder="الاسم الثلاثي"
                                       v-model="user.name">
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="user.nationality">
                                    <option selected disabled value="">الجنسية</option>
                                    <option value="egypt">جمهوريّة مصر العربية</option>
                                    <option value="sudan">جمهوريّة السودان</option>
                                    <option value="syria">الجمهوريّة العربيّة السوريّة</option>
                                    <option value="tunisia">الجمهوريّة التونسيّة</option>
                                    <option value="somalia">جمهوريّة الصومال</option>
                                    <option value="algeria">ةالجمهوريّة الجزائريّة الديمقراطيّة الشعبيّ</option>
                                    <option value="morocco">المملكة المغربيّة</option>
                                    <option value="iraq">جمهوريّة العراق</option>
                                    <option value="saudi">المملكة العربيّة السعوديّة</option>
                                    <option value="yemen">الجمهوريّة اليمنيّة</option>
                                    <option value="libya">دولة ليبيا</option>
                                    <option value="jordan">المملكة الأردنيّة الهاشميّة</option>
                                    <option value="uae">دولة الإمارات العربيّة المتّحدة</option>
                                    <option value="lebanon">الجمهوريّة اللبنانيّة</option>
                                    <option value="mauritania">الجمهوريّة الإسلاميّة الموريتانيّة</option>
                                    <option value="kuwait">دولة الكويت</option>
                                    <option value="oman">سطنة عُمان</option>
                                    <option value="qatar">دولة قطر</option>
                                    <option value="djibouti">جمهوريّة جيبويتي</option>
                                    <option value="bahrain">مملكة البحرين</option>
                                    <option value="comoros">جمهوريّة القمر الاتّحاديّة الإسلاميّة</option>
                                    <option value="palestine">دولة فلسطين المحتلّة</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="user.country">
                                    <option selected disabled value="">بلد الإقامة</option>
                                    <option value="egypt">جمهوريّة مصر العربية</option>
                                    <option value="sudan">جمهوريّة السودان</option>
                                    <option value="syria">الجمهوريّة العربيّة السوريّة</option>
                                    <option value="tunisia">الجمهوريّة التونسيّة</option>
                                    <option value="somalia">جمهوريّة الصومال</option>
                                    <option value="algeria">الجمهوريّة الجزائريّة الديمقراطيّة الشعبيّة</option>
                                    <option value="morocco">المملكة المغربيّة</option>
                                    <option value="iraq">جمهوريّة العراق</option>
                                    <option value="saudi">المملكة العربيّة السعوديّة</option>
                                    <option value="yemen">الجمهوريّة اليمنيّة</option>
                                    <option value="libya">دولة ليبيا</option>
                                    <option value="jordan">المملكة الأردنيّة الهاشميّة</option>
                                    <option value="uae">دولة الإمارات العربيّة المتّحدة</option>
                                    <option value="lebanon">الجمهوريّة اللبنانيّة</option>
                                    <option value="mauritania">الجمهوريّة الإسلاميّة الموريتانيّة</option>
                                    <option value="kuwait">دولة الكويت</option>
                                    <option value="oman">سطنة عُمان</option>
                                    <option value="qatar">دولة قطر</option>
                                    <option value="djibouti">جمهوريّة جيبويتي</option>
                                    <option value="bahrain">مملكة البحرين</option>
                                    <option value="comoros">جمهوريّة القمر الاتّحاديّة الإسلاميّة</option>
                                    <option value="palestine">دولة فلسطين المحتلّة</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <select class="form-control" v-model="user.status">
                                    <option disabled value="">الحالة الإجتماعية</option>
                                    <option selected disabled value="" v-if="user.gender == ''">يجب تحديد جنسك أولاً
                                    </option>
                                    <option value="single" v-if="user.gender == 'male'"> أعزب</option>
                                    <option value="married" v-if="user.gender == 'male'"> متزوج</option>
                                    <option value="divorced" v-if="user.gender == 'male'"> مطلق</option>
                                    <option value="single" v-if="user.gender == 'female'"> عزباء</option>
                                    <option value="divorced" v-if="user.gender == 'female'"> مطلقة</option>
                                    <option value="widow" v-if="user.gender == 'female'"> أرملة</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="date" class="input-small" v-model="user.birthday">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form action="" v-if="form == 2">
            <div class="contact-form-white d-flex flex-column element-form-left mx-4">
                <div class="row" v-if="errors.empty">
                    <div class="col-12 col-md-6 m-auto">
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-info-circle"></i>
                            يرجى تعبئة جميع الحقول
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <input type="number" class="input-small" min="0" placeholder="الطول (سم)"
                               v-model="user.length">
                    </div>
                    <div class="col-12 col-md-3">
                        <input type="number" class="input-small" min="0" placeholder="الوزن (كغ)"
                               v-model="user.weight">
                    </div>
                    <div class="col-12 col-md-6">
                        <select class="form-control" v-model="user.ethnicity">
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
                    <div class="col-12 col-md-6" v-if="user.ethnicity == 'num2'">
                        <select class="form-control" v-model="user.ethnicity_parent">
                            <option selected disabled value="">اختر أيهما</option>
                            <option value="father">الأب</option>
                            <option value="mother">الأم</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <select class="form-control" v-model="user.study">
                            <option selected disabled value="">المؤهل العلمي</option>
                            <option value="phd"> دكتوراه</option>
                            <option value="ma"> ماجستير</option>
                            <option value="ba"> بكالوريوس</option>
                            <option value="university_diploma"> دبلوم جامعي</option>
                            <option value="diploma"> دبلوم عام</option>
                            <option value="high_school"> ثانوية</option>
                            <option value="middle_school"> إعدادية</option>
                            <option value="other"> غير ذلك</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <v-select
                            multiple
                            :options="(user.gender == 'male') ? options.male : options.female"
                            :placeholder="placeholder"
                            v-model="user.employee"
                            @input="selectWork"
                        />
                    </div>
                </div>
            </div>
        </form>
        <form action="" v-if="form == 3" enctype="multipart/form-data">
            <div class="contact-form-white d-flex flex-column element-form-left mx-4">
                <div class="row">
                    <div class="col-12 col-md-6 m-auto" v-if="errors.empty">
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-info-circle"></i>
                            يرجى تعبئة جميع الحقول
                        </div>
                    </div>
                    <div class="col-12 col-md-6 m-auto" v-if="errors.image">
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-info-circle"></i>
                            يرجى رفع صورة أو اختيار شكل
                        </div>
                    </div>
                    <div class="col-12 col-md-6 m-auto" v-if="errors.passwordNoMatch">
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-info-circle"></i>
                            يرجى التأكد من تطابق كلمة المرور
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12 col-md-5">
                        <p class="text-center">اختر صورة من جهازك</p>
                        <div class="preview-image" v-if="imagePreview">
                            <img :src="imagePreview">
                            <button class="btn btn-danger" @click="imagePreview = '',user.image = ''">
                                <i class="fa fa-trash-alt"></i>
                                حذف
                            </button>
                        </div>
                        <div class="upload-image border" v-if="!user.image">
                            <input id="user-image" type="file" class="form-control" @change="imageUpload($event)">
                            <i class="fa fa-cloud-upload-alt"></i>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="fix-or">
                            <h5>أو</h5>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <p class="text-center">اختر الشكل المناسب</p>
                        <div class="avatars">
                            <img src="assets/img/Icon/M1.jpg" @click="setAvatar('M1')"
                                 :class="{active: user.avatar == 'M1'}">
                            <img src="assets/img/Icon/M2.jpg" @click="setAvatar('M2')"
                                 :class="{active: user.avatar == 'M2'}">
                            <img src="assets/img/Icon/M3.jpg" @click="setAvatar('M3')"
                                 :class="{active: user.avatar == 'M3'}">
                            <img src="assets/img/Icon/M4.jpg" @click="setAvatar('M4')"
                                 :class="{active: user.avatar == 'M4'}">
                            <img src="assets/img/Icon/M5.jpg" @click="setAvatar('M5')"
                                 :class="{active: user.avatar == 'M5'}">
                            <img src="assets/img/Icon/M6.jpg" @click="setAvatar('M6')"
                                 :class="{active: user.avatar == 'M6'}">
                            <img src="assets/img/Icon/M7.jpg" @click="setAvatar('M7')"
                                 :class="{active: user.avatar == 'M7'}">
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-6">
                        <input type="text" class="input-small" placeholder="البريد الالكتروني" v-model="user.email">
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="text" class="input-small" placeholder="رقم الهاتف" v-model="user.phone">
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="password" class="input-small" placeholder="كلمة المرور"
                               v-model="user.password">
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="password" class="input-small" placeholder="تأكيد كلمة المرور"
                               v-model="user.rePassword">
                    </div>
                    <div class="col-12 col-md-6">
                        <textarea class="input-small" placeholder="اكتب وصف عن نفسك"
                                  v-model="user.userDescription"></textarea>
                    </div>
                    <div class="col-12 col-md-6">
                        <textarea class="input-small" placeholder="اكتب وصف عن شريكك الذي ترغب به"
                                  v-model="user.partnerDescription"></textarea>
                    </div>
                </div>
            </div>
        </form>
        <!-- Next & Previous Buttons -->
        <div class="row">
            <div class="col-12 text-center">
                <button v-if="form > 1" class="button-default-white mt-4 d-inline-block" type="button"
                        @click="prevFrom">
                    السابق
                </button>
                <button v-if="form < 3" class="button-submit mt-4 d-inline-block" type="button" @click="nextForm">
                    التالي
                </button>
                <button v-if="form == 3" class="button-submit mt-4 d-inline-block" type="button" @click="send">
                    تأكيد
                </button>
            </div>
        </div>
    </div>
</template>

<style>
/* Global */
select.form-control {
    height: 46.5px !important;
    border-radius: 0;
}

button {
    font-size: 16px !important;
}

.button-default-white {
    border: 0;
    cursor: pointer;
}

/* End Global */
.wrapper-progressBar {
    width: 100%
}

.progressBar li {
    list-style-type: none;
    float: right;
    width: 33%;
    position: relative;
    text-align: center;
}

.progressBar li:before {
    content: " ";
    line-height: 30px;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    display: block;
    text-align: center;
    margin: 0 auto 10px;
    background-color: white
}

.progressBar li:after {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: #ddd;
    top: 15px;
    right: -50%;
    z-index: -1;
}

.progressBar li:first-child:after {
    content: none;
}

.progressBar li.active {
    color: #ee3158;
}

.progressBar li.active:before {
    border-color: #ee3158;
    background-color: #ee3158
}

.select-gender .single-gender {
    width: 100px;
    height: 100px;
    display: inline-block;
    position: relative;
    border: 1px solid #ccc;
    border-radius: 50%;
    overflow: hidden;
    padding: 15px;
    margin: 0 10px;
    transition: .1s all;
}

.select-gender .single-gender:hover {
    /*transform: scale(1.1,1.1);*/
    box-shadow: 0 0 3px 3px #eaeaea;
}

.select-gender .single-gender.active {
    border: 3px solid #ee3158;
    box-shadow: 0 0 4px 4px #eaeaea;
}

.select-gender .single-gender img {
    width: 100%;
    height: 100%;
}

.select-gender .single-gender input {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    opacity: 0;
    z-index: 9999;
    cursor: pointer;
}

/* File Uploader */
.upload-image {
    width: 300px;
    height: 230px;
    background-color: #f9f9f9;
    margin: 15px auto;
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 8px
}

.upload-image.border {
    border: 5px dashed #ccc !important;
}

.upload-image input {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

.upload-image i {
    font-size: 46px;
}

.preview-image {
    margin: 15px auto;
    text-align: center;
    width: 300px;
    border: 3px solid #f2f2f2;
    border-radius: 5px;
    padding: 10px;
}

.preview-image img {
    width: 100%;
    height: 100%;
}

/* Avatars */
.avatars {
    text-align: center;
}

.avatars img {
    width: 100px;
    display: inline-block;
    cursor: pointer;
}

.avatars img.active {
    background-color: #ee3158;
    border: 1px solid #ee3158;
    border-radius: 50%;
    padding: 1px;
}


.fix-or {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
/* Multi select */
.v-select {
    direction: rtl !important;
}
.v-select input {
    padding: 0 !important;
    padding-right: 5px !important;
    border: 0 !important;
    margin: 10px 0;
}
.vs__actions {
    padding: 4px 3px 0 6px !important;
}
.vs__selected {
    border-radius: 0 !important;
}
.vs__dropdown-menu {
    text-align: right !important;
}

.contact-form-white button {
    margin-top: 0 !important;
    margin-left: 0;
    margin-right: 4px;
}

</style>

<script>
export default {
    data: function () {
        return {
            form: 1,
            imagePreview: "",
            user: {
                gender: "",
                name: "",
                nationality: "",
                country: "",
                status: "",
                birthday: "",
                length: "",
                weight: "",
                ethnicity: "",
                ethnicity_parent: "",
                study: "",
                employee: "",
                image: "",
                avatar: "",
                email: "",
                phone: "",
                password: "",
                rePassword: "",
                userDescription: "",
                partnerDescription: "",
            },
            errors: {
                empty: 0,
                age: 0,
                image: 0,
                passwordNoMatch: 0,
            },
            options: {
                male: [
                    {
                        name: "government",
                        label: "قطاع حكومي"
                    },
                    {
                        name: "private",
                        label: "قطاع خاص"
                    },
                    {
                        name: "looking_for_job",
                        label: "باحث عن عمل"
                    },
                    {
                        name: "retired",
                        label: "متقاعد"
                    },
                    {
                        name: "no_work",
                        label: "لا أرغب بالعمل"
                    },
                ],
                female: [
                    {
                        name: "government",
                        label: "قطاع حكومي"
                    },
                    {
                        name: "private",
                        label: "قطاع خاص"
                    },
                    {
                        name: "looking_for_job",
                        label: "باحثة عن عمل"
                    },
                    {
                        name: "no_work",
                        label: "لا أرغب بالعمل"
                    },
                    {
                        name: "house",
                        label: "ربة منزل"
                    },
                ],
            },
            placeholder: "وظيفتك",
        }
    },
    methods: {
        selectWork: function () {
            console.log(this.user.employee)
        },
        changeGender: function (dt) {
            this.user.gender = dt
        },
        nextForm: function () {
            window.scrollTo(0, 0)
            if (this.form == 1) {
                if (this.user.gender == '' || this.user.name == '' ||
                    this.user.country == '' || this.user.nationality == '' ||
                    this.user.status == '' ||
                    this.user.birthday == '') {
                    this.errors.empty = 1
                    return
                } else {
                    this.errors.empty = 0
                }
                // Calculate Age
                var a = new Date(this.user.birthday)
                var month_diff = Date.now() - a.getTime();
                var age_dt = new Date(month_diff);
                var year = age_dt.getUTCFullYear();
                var age = Math.abs(year - 1970);
                if (age < 23) {
                    this.errors.age = 1
                    return
                } else {
                    this.errors.age = 0
                }
                this.form++
            } else if (this.form == 2) {
                if (this.user.length == '' || this.user.weight == '' ||
                    this.user.ethnicity == '' || this.user.study == '' || this.user.employee == '') {
                    this.errors.empty = 1
                    return
                } else {
                    this.errors.empty = 0
                    let i = 0;
                    let res = "";
                    let empCount = this.user.employee.length
                    for (i; i < empCount; i++) {
                        if (i != empCount - 1) {
                            res += this.user.employee[i].name + ","
                        } else {
                            res += this.user.employee[i].name
                        }
                    }
                    this.user.employee = res
                }
                this.form++
            }
        },
        prevFrom: function () {
            this.form--
            window.scrollTo(0, 0)
        },
        setAvatar: function (num) {
            this.user.avatar = num
            this.user.image = ""
        },
        imageUpload(event) {
            this.imagePreview = URL.createObjectURL(event.target.files[0])
            this.user.image = event.target.files[0]
            this.user.avatar = ""
            // Show Success Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: 'تم رفع الصورة بنجاح'
            })
        },
        send: function () {
            if (this.user.image == '' && this.user.avatar == '') {
                this.errors.image = 1
                return
            } else {
                this.errors.image = 0
            }
            if (this.user.email == '' || this.user.password == '' ||
                this.user.phone == '' || this.user.userDescription == '' ||
                this.user.partnerDescription == '') {
                this.errors.empty = 1
                return
            } else {
                this.errors.empty = 0
            }
            if (this.user.password != this.user.rePassword) {
                this.errors.passwordNoMatch = 1
                return
            } else {
                this.errors.passwordNoMatch = 0
            }
            // var userImage = document.getElementById('user-image').files[0]
            const fd = new FormData()
            fd.append('image', this.user.image)
            fd.append('avatar', this.user.avatar)
            fd.append('gender', this.user.gender)
            fd.append('name', this.user.name)
            fd.append('email', this.user.email)
            fd.append('password', this.user.password)
            fd.append('birthday', this.user.birthday)
            fd.append('nationality', this.user.nationality)
            fd.append('country', this.user.country)
            fd.append('status', this.user.status)
            fd.append('length', this.user.length)
            fd.append('weight', this.user.weight)
            fd.append('ethnicity', this.user.ethnicity)
            fd.append('ethnicity_parent', this.user.ethnicity_parent)
            fd.append('study', this.user.study)
            fd.append('employee', this.user.employee)
            fd.append('phone', this.user.phone)
            fd.append('userDescription', this.user.userDescription)
            fd.append('partnerDescription', this.user.partnerDescription)
            for (var [key, value] of fd.entries()) {
                fd[key] = value
            }
            axios({
                method: "post",
                url: "/api/register/save",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
                .then((res) => {
                    console.log(res.data)
                    if (res.data == 1) {
                        Swal.fire({
                            title: 'تهانينا!',
                            text: 'تم التسجيل بنجاح',
                            icon: 'success',
                            confirmButtonText: 'ابدأ'
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
