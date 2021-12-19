<template>
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile -->
                        <profile-header :user="user" :activated="activated" :auth_user_id="auth_user_id"></profile-header>
                        <!-- end profile -->
                        <!-- begin profile-content -->
                        <div class="profile-content row" style="padding: 25px 0">
                            <div class="col-lg-12">
                                <account-status
                                    :user="user"
                                    :auth_user_id="auth_user_id"
                                    :activated="activated"
                                    :complete="complete"></account-status>
                                <!-- Search Box -->
                                <div class="card">
                                    <div class="card-header text-center">
                                        بحث جديد
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="contact-form-white d-flex flex-column align-items-center element-form-left">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <select class="form-control" v-model="search.nationality">
                                                        <option selected value="">الجنسية</option>
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
                                                <div class="col-lg-2">
                                                    <select class="form-control" v-model="search.country">
                                                        <option selected value="">بلد الإقامة</option>
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
                                                <div class="col-lg-2">
                                                    <select class="form-control" v-model="search.religion">
                                                        <option selected value="">العقيدة</option>
                                                        <option value="أباضي"> أباضي</option>
                                                        <option value="سني"> سني</option>
                                                        <option value="شيعي"> شيعي</option>
                                                        <option value="غير ذلك"> غير ذلك</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-control" v-model="search.status">
                                                        <option selected value="">الحالة الإجتماعية</option>
                                                        <option value="single" v-if="user.gender == 'female'"> أعزب</option>
                                                        <option value="married" v-if="user.gender == 'female'"> متزوج</option>
                                                        <option value="divorced" v-if="user.gender == 'female'"> مطلق</option>
                                                        <option value="single" v-if="user.gender == 'male'"> عزباء</option>
                                                        <option value="divorced" v-if="user.gender == 'male'"> مطلقة</option>
                                                        <option value="widow" v-if="user.gender == 'male'"> أرملة</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-control" v-model="search.ethnicity">
                                                        <option selected value="">الأصل العرقي</option>
                                                        <option value="num1"> رقم 1 (الوالدان أصل وفصل)</option>
                                                        <option value="num2"> رقم 2 (أحد الوالدن أصل وفصل)</option>
                                                        <option value="num3"> رقم 3 (الوالدان من البشرة السمراء)</option>
                                                        <option value="p1"> بيسر 1 (عرق مخلوط من نسل أبيض البشره)</option>
                                                        <option value="p2">بيسر 2 (عرق مخلوط من نسل أسمر البشره)</option>
                                                        <option value="p3">بيسر 3 (عرق مخلوط من نسل مخلوط البشره)</option>
                                                        <option value="other"> غير ذلك</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-control" v-model="search.study">
                                                        <option selected value="">المؤهل العلمي</option>
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
                                                <div class="col-lg-2">
                                                    <select class="form-control" v-model="search.skin">
                                                        <option selected value="">لون البشرة</option>
                                                        <option value="أبيض"> أبيض</option>
                                                        <option value="أبيض على إحمرار"> أبيض على إحمرار</option>
                                                        <option value="حنطي فاتح"> حنطي فاتح</option>
                                                        <option value="حنطي على إسمرار"> حنطي على أسمرار</option>
                                                        <option value="أسمر داكن"> أسمر داكن</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-control" v-model="search.financial">
                                                        <option selected value="">الوضع المادي</option>
                                                        <option value="ضعيف"> ضعيف</option>
                                                        <option value="جيد"> جيد</option>
                                                        <option value="جيد جداً"> جيد جدا</option>
                                                        <option value="ممتاز"> ممتاز</option>
                                                        <option value="ممتاز جداً"> ممتاز جدا</option>
                                                        <option value="لا يوجد"> لا يوجد</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2" v-if="user.gender=='male'">
                                                    <select class="form-control">
                                                        <option selected value="">مكان السكن بعد الزواج</option>
                                                        <option value="مستقل"> مستقل</option>
                                                        <option value="في ملحق"> في ملحق</option>
                                                        <option value="منزل خاص"> منزل خاص</option>
                                                        <option value="مع العائلة"> مع العائلة</option>
                                                        <option value="لا أمانع"> لا أمانع</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <input type="number" placeholder=" العمر من"
                                                                   class="input-small" v-model="search.age_from">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="number" placeholder="إلي"
                                                                   class="input-small" v-model="search.age_to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <input type="number" placeholder=" الوزن من"
                                                                   class="input-small" v-model="search.weight_from">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="number" placeholder="إلي"
                                                                   class="input-small" v-model="search.weight_to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <input type="number" placeholder=" الطول من"
                                                                   class="input-small" v-model="search.length_from">
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <input type="number" placeholder="إلي"
                                                                   class="input-small" v-model="search.length_to">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button style="font-size: 14px;" class="button-submit" type="button"
                                                        @click="send(user.gender)">
                                                    بحث
                                                </button>
                                                <button type="button" class="button-default-white d-inline-block"
                                                        @click="clearFields">
                                                    مسح الحقول
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                            </div>
                            <div class="tab-content col-lg-12">
                                <div class="tab-pane fade active show" id="tab1">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header text-center">
                                                    نتائج البحث
                                                </div>
                                                <div class="card-body">
                                                    <div class="row w-100">
                                                        <div class="col-12 text-center" v-if="loading">
                                                            <i class="fas fa-spinner fa-pulse fa-2x"></i>
                                                        </div>
                                                        <div class="col-12 col-md-3" v-for="result in results">
                                                            <div class="s-result">
                                                                <img :src="'/storage/images/'+result.image" v-if="result.image != null">
                                                                <img :src="'/assets/img/Icon/'+result.avatar + '.jpg'" v-if="result.avatar">
                                                                <div class="s-result-info">
                                                                    <h6>
                                                                        <a :href="'/user/' + result.id">{{ result.name }}</a>
                                                                    </h6>
                                                                    <ul>
                                                                        <li>
                                                                            <a :href="'/user/' + result.id">
                                                                                <i class="fa fa-id-card-alt"></i>
                                                                                الملف الشخصي
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0);"
                                                                               @click="showModalChatHandle(result.id,result.name)">
                                                                                <i class="fa fa-paper-plane"></i>
                                                                                تواصل
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        <Modal v-model="showModalChat" title="ابدأ المراسلة">
            <div class="container">
                <div class="row">
                    <div class="col-12" v-if="modalLoading">
                        <div class="col-12 text-center">
                            <i class="fas fa-spinner fa-pulse fa-2x"></i>
                        </div>
                    </div>
                    <div class="col-12" v-if="checkChatRes == 0">
                        <div class="alert alert-danger text-center" v-if="empty.modalMessage">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى كتابة رسالتك الأولى
                            </p>
                        </div>
                        <h6 class="text-center my-2" style="color: #666">
                            ألقِ التحية على
                            <span>{{ modalChat.name }}</span>
                            <i class="fa fa-handshake"></i>
                        </h6>
                        <div class="form-group">
                            <textarea class="form-control" cols="30" rows="10" placeholder="اكتب رسالتك الترحيبية"
                                      v-model="modalMessage"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button @click="sendMessageTo(modalChat.id)" class="btn btn-primary">إرسال</button>
                        </div>
                    </div>
                    <div class="col-12" v-else>
                        <div class="text-center">
                            <a href="/chat" class="btn btn-outline-success">توجه إلى المحادثات</a>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    </section>
</template>

<style>
.s-result {
    margin: 15px 0;
    border: 1px solid #eee;
    padding-bottom: 10px;
}

.s-result img {
    /*border-radius: 10px;*/
}

.s-result .s-result-info {
    text-align: center;
}

.s-result .s-result-info h6 a {
    color: #333;
}

.s-result ul li {
    text-align: right;
    margin: 10px 0;
}

.s-result ul li a {
    color: #777;
}

.s-result ul li a i {
    margin-left: 5px;
}
</style>

<script>
import ProfileHeader from "../components/ProfileHeader"
import SearchBox from "../components/SearchBox"
import AccountStatus from "../components/partials/accountStatus"

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    data: function () {
        return {
            search: {
                nationality: "",
                country: "",
                religion: "",
                status: "",
                ethnicity: "",
                study: "",
                skin: "",
                financial: "",
                age_from: "",
                age_to: "",
                weight_from: "",
                weight_to: "",
                length_from: "",
                length_to: "",
            },
            loading: false,
            results: [],
            showModalChat: false,
            empty: {
                modalMessage: 0,
            },
            modalLoading: false,
            modalMessage: "",
            checkChatRes: null,
            modalChat: {
                id: null,
                name: null
            }
        }
    },
    components: {ProfileHeader, AccountStatus},
    methods: {
        send: function (g) {
            // console.log(this.search)
            this.results = []
            this.loading = true
            axios.post('/api/search', {
                search: this.search,
                gender: g,
                my_id: this.auth_user_id
            })
                .then((res) => {
                    this.loading = false
                    this.results = res.data
                    // console.log(res.data)
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        clearFields: function () {
            this.search.nationality = ""
            this.search.country = ""
            this.search.religion = ""
            this.search.status = ""
            this.search.ethnicity = ""
            this.search.study = ""
            this.search.skin = ""
            this.search.financial = ""
            this.search.age_from = ""
            this.search.age_to = ""
            this.search.weight_from = ""
            this.search.weight_to = ""
            this.search.length_from = ""
            this.search.length_to = ""
        },
        sendMessageTo: function (to_id) {
            axios.post('/api/save-message', {
                message: this.modalMessage,
                from_id: this.user.id,
                to_id: to_id
            })
                .then((res) => {
                    setTimeout(function(){
                        window.location.href = "/chat"
                    },1000);
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        showModalChatHandle: function (id,name) {
            this.modalLoading = true
            this.showModalChat = true
            axios.post("api/check-chat",{
                my_id: this.user.id,
                user_id: id
            })
            .then((res) => {
                if(res.data > 0)
                    this.checkChatRes = 1
                else {
                    this.checkChatRes = 0
                    this.modalChat.id = id
                    this.modalChat.name = name
                }
                this.modalLoading = false
            })
        }
    }
}
</script>
