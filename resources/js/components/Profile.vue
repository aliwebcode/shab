<template>
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile -->
                        <profile-header :user="user" :activated="activated" :auth_user_id="auth_user_id"
                                        :userData="userData"></profile-header>
                        <!-- end profile -->
                        <!-- begin profile-content -->
                        <div class="profile-content row">
                            <div class="col-lg-12">
                                <account-status
                                    :user="user"
                                    :auth_user_id="auth_user_id"
                                    :activated="activated"
                                    :complete="complete"></account-status>
                                <search-box></search-box>
                                <br/>
                            </div>
                            <div class="col-12" v-if="profileHidden">
                                <div class="card text-center">
                                    <div class="card-header">عذراً</div>
                                    <div class="card-body">
                                        <p>المستخدم غير متوفر</p>
                                    </div>
                                </div>
                            </div>
                            <div v-if="!profileHidden" class="col-lg-4">
                                <div class="card">
                                    <div class="card-body" style="text-align: center;">
                                        <img :src="'/storage/images/' + userData.image"
                                             class="user-profile-image" v-if="userData.image">
                                        <img :src="'/assets/img/Icon/' + userData.avatar + '.jpg'"
                                             class="user-profile-image" v-if="userData.avatar">
                                        <h6>{{ userData.name }}</h6>
                                        <p class="hy-2">{{ userData.user_code }}</p>
                                        <hr/>
                                        <ul class="profile-options" v-if="auth_user_id != userData.id">
                                            <li>
                                                <a href="javascript:void(0);"
                                                   @click="showModalChatHandle(userData.id,userData.name)">
                                                    <i class="fa fa-envelope"></i>
                                                    تواصل
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-exclamation-triangle"></i>
                                                    إبلاغ عن مشكلة
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <br/>
                                <button
                                    class="btn btn-success btn-block py-3 mb-3"
                                    @click="sendRequest(auth_user_id,userData.id)"
                                    v-if="userData.gender == 'female' && userData.id !=  auth_user_id && user.gender == 'male'">
                                    <i class="fa fa-paper-plane"></i>
                                    أرسل طلب رؤية شرعية
                                </button>
                                <button
                                    @click="blockUser"
                                    type="button"
                                    class="btn btn-danger btn-block py-3 mb-3"
                                    v-if="userData.id !=  auth_user_id">
                                    <i class="fa fa-ban"></i>
                                    حظر <span>{{ userData.name }}</span>
                                </button>
                            </div>
                            <div v-if="!profileHidden" class="tab-content p-0 col-lg-8">
                                <div class="tab-pane fade active show" id="tab1">
                                    <div class="card contact-form-white d-flex flex-column element-form-left mb-4"
                                         style="padding:5%">
                                        <h6 class="text-right section-heading">
                                            <i class="fa fa-info-circle"></i>
                                            نبذة عن <span>{{ userData.name }}</span>
                                        </h6>
                                        <div class="row text-right">
                                            <div class="col-12 col-lg-6 mt-3">
                                                <p>
                                                    الجنسية:
                                                    <img
                                                        :src="'/assets/flags/' + userData.nationality + '.svg'"
                                                        class="ml-1"
                                                        style="border-radius: 7px"
                                                        width="30" height="30">
                                                    <strong>
                                                        {{ getWords(userData.nationality) }}
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <p>
                                                    بلد الإقامة:
                                                    <img
                                                        :src="'/assets/flags/' + userData.country + '.svg'"
                                                        class="ml-1"
                                                        style="border-radius: 7px"
                                                        width="30" height="30">
                                                    <strong>
                                                        {{ getWords(userData.country) }}
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <p>
                                                    الجنس:
                                                    <strong>
                                                        <i class="fa fa-male" v-if="userData.gender=='male'"></i>
                                                        <i class="fa fa-female" v-if="userData.gender=='female'"></i>
                                                        {{ getWords(userData.gender) }}
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <p>
                                                    الحالة الاجتماعية:
                                                    <strong>
                                                        {{ getWords(userData.status) }}
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <p>
                                                    تاريخ الميلاد:
                                                    <strong>
                                                        {{ userData.birthday }}
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <p>
                                                    الأصل العرقي:
                                                    <strong>
                                                        {{ getWords(userData.ethnicity) }}
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <p>
                                                    الطول:
                                                    <strong>
                                                        <span>{{ userData.length }}</span>
                                                        سم
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <p>
                                                    الوزن:
                                                    <strong>
                                                        <span>{{ userData.weight }}</span>
                                                        كغ
                                                    </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <h6 class="text-right section-heading">
                                            <i class="fa fa-user-graduate"></i>
                                            شهادة التعليم
                                        </h6>
                                        <div class="row text-right">
                                            <div class="col-12 col-lg-6">
                                                <p>
                                                    <strong>
                                                        {{ getWords(userData.study) }}
                                                    </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <h6 class="text-right section-heading">
                                            <i class="fa fa-user-cog"></i>
                                            العمل
                                        </h6>
                                        <div class="row text-right">
                                            <div class="col-12 col-lg-6">
                                                <p v-for="emp in employee" class="mt-3">
                                                    <strong>
                                                        {{ getWords(emp) }}
                                                    </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <h6 class="text-right section-heading">
                                            <i class="fa fa-user-plus"></i>
                                            تفاصيل إضافية
                                        </h6>
                                        <div class="row text-right">
                                            <div class="col-12 col-lg-6 mt-3" v-if="userProfile.skin">
                                                <p>
                                                    لون البشرة:
                                                    <strong>{{ userProfile.skin }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3" v-if="userProfile.religion">
                                                <p>
                                                    العقيدة:
                                                    <strong>{{ userProfile.religion }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3" v-if="userProfile.smoking">
                                                <p>
                                                    التدخين:
                                                    <strong>{{ userProfile.smoking }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3" v-if="userProfile.financial">
                                                <p>
                                                    الوضع المادي:
                                                    <strong>{{ userProfile.financial }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3" v-if="userProfile.financial_plus">
                                                <p>
                                                    مصدر دخل إضافي:
                                                    <strong>{{ userProfile.financial_plus }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3" v-if="userProfile.body">
                                                <p>
                                                    البنية الجسمية:
                                                    <strong>{{ userProfile.body }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3" v-if="userProfile.marriage_method">
                                                <p>
                                                    طريقة الزواج:
                                                    <strong>{{ userProfile.marriage_method }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3"
                                                 v-if="userProfile.future_living && userData.gender == 'female'">
                                                <p>
                                                    بعد الزواج ستسكن:
                                                    <strong>{{ userProfile.future_living }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <h6 class="text-right section-heading">
                                            <i class="fa fa-info-circle"></i>
                                            كلام
                                            {{ userData.name }}
                                            عن نفسه/ ـها
                                        </h6>
                                        <p class="text-right">{{ userData.userDescription }}</p>
                                        <h6 class="text-right section-heading">
                                            <i class="fa fa-info-circle"></i>
                                            كلام
                                            {{ userData.name }}
                                            عن شريكه/ ـها
                                        </h6>
                                        <p class="text-right">{{ userData.partnerDescription }}</p>
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
.user-profile-image {
    width: 230px;
    border-radius: 50%;
}

.co-loading {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 99999;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
}

.co-loading i {
    color: #fff;
}

.section-heading {
    border-bottom: 2px dashed #ccc;
    padding-bottom: 10px;
    margin: 20px 0;
}

.profile-options {
    padding: 0;
    text-align: right;
}

.profile-options li {
    margin: 10px 0;
}

.profile-options li a {
    color: #555;
    font-size: 16px;
}

.profile-options li a:hover {
    color: #222;
}
</style>
<script>
import ProfileHeader from "../components/ProfileHeader"
import SearchBox from "../components/SearchBox"
import AccountStatus from "./partials/accountStatus"

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    data: function () {
        return {
            userData: {},
            userProfile: {},
            employee: null,
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
            },
            profileHidden: false
        }
    },
    components: {ProfileHeader, SearchBox, AccountStatus},
    mounted() {
        var id = this.$route.params.id
        var myId = document.querySelector("meta[name='user-id']").getAttribute('content')
        axios.get('/api/profile/' + id +  '/' + myId)
            .then((res) => {
                if (res.data == -1) {
                    this.profileHidden = true
                } else {
                    this.userData = res.data
                    this.employee = res.data.employee.split(",")
                    axios.post('/api/profile-details/', {
                        user_id: id,
                        my_id: myId
                    })
                        .then((result) => {
                            if (result.data == -1) {
                                this.profileHidden = true
                            } else
                                this.userProfile = result.data
                        })
                        .catch((error) => {
                            console.log(error)
                        })
                }
            })
            .catch((err) => {
                console.log(err)
            })
    },
    methods: {
        sendMessageTo: function (to_id) {
            axios.post('/api/save-message', {
                message: this.modalMessage,
                from_id: this.user.id,
                to_id: to_id
            })
                .then((res) => {
                    setTimeout(function () {
                        window.location.href = "/chat"
                    }, 1000);
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        showModalChatHandle: function (id, name) {
            this.modalLoading = true
            this.showModalChat = true
            axios.post("/api/check-chat", {
                my_id: this.user.id,
                user_id: id
            })
                .then((res) => {
                    if (res.data > 0)
                        this.checkChatRes = 1
                    else {
                        this.checkChatRes = 0
                        this.modalChat.id = id
                        this.modalChat.name = name
                    }
                    this.modalLoading = false
                })
        },
        getWords: function (w) {
            let words = {
                male: "ذكر",
                female: "أنثى",
                // Countries
                egypt: "جمهوريّة مصر العربية",
                sudan: "جمهوريّة السودان",
                syria: "الجمهوريّة العربيّة السوريّة",
                tunisia: "الجمهوريّة التونسيّة",
                somalia: "جمهوريّة الصومال",
                algeria: "الجمهوريّة الجزائريّة الديمقراطيّة الشعبية",
                morocco: "المملكة المغربيّة",
                iraq: "جمهوريّة العراق",
                saudi: "المملكة العربيّة السعوديّة",
                yemen: "الجمهوريّة اليمنيّة",
                libya: "دولة ليبيا",
                jordan: "المملكة الأردنيّة الهاشميّة",
                uae: "دولة الإمارات العربيّة المتّحدة",
                lebanon: "الجمهوريّة اللبنانيّة",
                mauritania: "الجمهوريّة الإسلاميّة الموريتانيّة",
                kuwait: "دولة الكويت",
                oman: "سطنة عُمان",
                qatar: "دولة قطر",
                jubbuti: "جمهوريّة جيبويتي",
                bahrain: "مملكة البحرين",
                comoros: "جمهوريّة القمر الاتّحاديّة الإسلاميّة",
                palestine: "دولة فلسطين المحتلّة",
                // Status
                single: this.userData.gender == "male" ? "أعزب" : "عزباء",
                married: "متزوج",
                divorced: this.userData.gender == "male" ? "مطلق" : "مطلقة",
                widow: "أرملة",
                // Ethnicity
                num1: "رقم 1",
                num2: "رقم 2",
                num3: "رقم 3",
                p1: "بيسر 1",
                p2: "بيسر 2",
                p3: "بيسر3",
                other: "غير ذلك",
                // Ethnicity Parent
                father: "الأب",
                mother: "الأم",
                // Study
                phd: "دكتوراه",
                ma: "ماجستير",
                ba: "بكالوريوس",
                university_diploma: "دبلوم جامعي",
                diploma: "دبلوم عام",
                high_school: "ثانوية",
                middle_school: "إعدادية",
                // Work
                government: "قطاع حكومي",
                private: "قطاع خاص",
                looking_for_job: this.userData.gender == "male" ? "باحث عن عمل" : "باحثة عن عمل",
                retired: "متقاعد",
                no_work: "لا أرغب بالعمل",
                house: "ربة منزل"
            }
            return words[w]
        },
        sendRequest: function (my_id, user_id) {
            axios.post("/api/send-request", {
                from_id: my_id,
                to_id: user_id
            })
                .then((res) => {
                    if (res.data == 1) {
                        Swal.fire({
                            title: 'تهانينا!',
                            text: 'تم إرسال الطلب بنجاح',
                            icon: 'success',
                            confirmButtonText: 'تم'
                        })
                    } else if (res.data == 0) {
                        Swal.fire({
                            title: 'تنبيه!',
                            text: 'أرسلت طلب رؤية شرعية مسبقاً',
                            icon: 'warning',
                            confirmButtonText: 'تم'
                        })
                    }
                })
        },
        blockUser: function () {
            axios.post("/api/block-user", {
                myId: this.auth_user_id,
                userId: this.userData.id
            })
            .then((res) => {
                if(res.data == 1) {
                    Swal.fire({
                        title: 'تهانينا!',
                        text: 'تم حظر المستخدم بنجاح',
                        icon: 'success',
                        confirmButtonText: 'تم'
                    })
                }
            })
        }
    }
}
</script>
