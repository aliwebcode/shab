<template>
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <profile-header :user="user" :auth_user_id="auth_user_id"
                                        :un_read_messages="un_read_messages" :activated="activated"></profile-header>
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
                            <div class="tab-content p-0 col-lg-8">
                                <div class="tab-pane fade active show" id="tab1">

                                    <div
                                        class="card contact-form-white d-flex flex-column align-items-center element-form-left"
                                        style="padding:5%">
                                        <h5 style="text-align:center">تغيير كلمة المرور</h5>
                                        <div class="alert alert-danger text-center w-100" v-if="errors.passwordNoMatch">
                                            <p>يرجى التأكد من تطابق كلمات المرور</p>
                                        </div>
                                        <div class="alert alert-danger text-center w-100" v-if="errors.empty">
                                            <p>يرجى تعبئة الحقول كاملة</p>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="password" placeholder="كلمة المرور"
                                                       class="input-small" v-model="password">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="password" placeholder="تأكيد كلمة المرور"
                                                       class="input-small" v-model="rePassword">
                                            </div>

                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-2">
                                                <button @click="send(user.id)" style="font-size: 15px;"
                                                        class="button-submit">
                                                    حفظ
                                                </button>
                                            </div>
                                            <div class="col-lg-5"></div>
                                        </div>
                                    </div>
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
</template>

<script>
import ProfileHeader from "../components/ProfileHeader"
import SearchBox from "../components/SearchBox"
import AccountStatus from "../components/partials/accountStatus"

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated', 'un_read_messages'],
    data: function () {
        return {
            password: "",
            rePassword: "",
            errors: {
                passwordNoMatch: 0,
                empty: 0,
            }
        }
    },
    components: {ProfileHeader, SearchBox, AccountStatus},
    methods: {
        send: function (id) {
            if (this.password == '' || this.rePassword == '') {
                this.errors.empty = 1
                return
            } else
                this.errors.empty = 0
            if (this.password != this.rePassword) {
                this.errors.passwordNoMatch = 1
                return
            } else
                this.errors.passwordNoMatch = 0
            axios.post('/api/change-password', {
                id: id,
                password: this.password
            })
                .then((res) => {
                    Swal.fire({
                        title: 'تهانينا!',
                        text: 'تم حفظ البيانات',
                        icon: 'success',
                        confirmButtonText: 'تم'
                    })
                })
                .catch((err) => {
                    console.log(err)
                })
        }
    }
}
</script>
