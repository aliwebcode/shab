<template>
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile -->
                        <profile-header :user="user" :auth_user_id="auth_user_id" :activated="activated"></profile-header>
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
                            <div class="col-12">
                                <div class="alert alert-danger text-center" v-if="empty">
                                    <i class="fa fa-info-circle"></i>
                                    يرجى تعبئة كامل الحقول
                                </div>
                            </div>
                            <div class="tab-content p-0 col-lg-12">
                                <div class="tab-pane fade active show" id="tab1">
                                    <form
                                        class="card contact-form-white d-flex flex-column align-items-center element-form-left"
                                        style="padding:5%">
                                        <h5 style="text-align:center"> إهتماماتي</h5>
                                        <hr/>
                                        <div class="row" style="width: 100%;">
                                            <div class="col-lg-6">
                                                <h6 class="text-center">وصف عن نفسك</h6>
                                                <textarea v-model="userDescription" class="input-small"
                                                          :placeholder="user.userDescription">
                                                </textarea>
                                            </div>
                                            <div class="col-lg-6">
                                                <h6 class="text-center">وصف عن الشريك</h6>
                                                <textarea v-model="partnerDescription" class="input-small"
                                                          :placeholder="user.partnerDescription">
                                                </textarea>
                                            </div>
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-2">
                                                <button @click="send(user.id)" style="font-size: 15px;"
                                                        class="button-submit" type="button">
                                                    حفظ
                                                </button>
                                            </div>
                                            <div class="col-lg-5"></div>
                                        </div>
                                    </form>
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
import AccountStatus from "./partials/accountStatus"

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    data: function () {
        return {
            userDescription: "",
            partnerDescription: "",
            empty: 0
        }
    },
    components: {ProfileHeader, SearchBox, AccountStatus},
    methods: {
        send: function (id) {
            if (this.userDescription == '' || this.partnerDescription == '') {
                this.empty = 1
                window.scrollTo(0, 200)
                return
            } else
                this.empty = 0

            let data = this.userData
            axios({
                method: "post",
                url: "/api/edit-interests",
                data: {
                    user_id: id,
                    userDescription: this.userDescription,
                    partnerDescription: this.partnerDescription
                }
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
