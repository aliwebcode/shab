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
                            <div class="tab-content p-0 col-lg-12">
                                <div class="tab-pane fade active show" id="tab1">
                                    <div class="card">
                                        <div class="card-header text-right">البريد</div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="notifications">
                                                        <li class="text-right py-4" v-for="mail in mails">
                                                            <i class="fa fa-user-tie fa-2x"></i>
                                                            <p style="cursor: pointer" @click="showMessage(mail)">
                                                                {{ mail.title }}
                                                            </p>
                                                            <span>
                                                                <i class="fa fa-clock"></i>
                                                                {{ getDate(mail.created_at) }}
                                                            </span>
                                                        </li>
                                                    </ul>
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
        <Modal v-model="showModal" title="عرض الرسالة">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div style="overflow-y: scroll">
                            <h5>{{ selectedMessage.title }}</h5>
                            <p>{{ selectedMessage.message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    </section>
</template>

<script>
import ProfileHeader from "../components/ProfileHeader"
import AccountStatus from "./partials/accountStatus"
import SearchBox from "./SearchBox";

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    mounted() {
        axios.get('/api/get-mail/')
        .then((res) => {
            this.mails = res.data
        })
    },
    data: function () {
        return {
            mails: [],
            showModal: false,
            selectedMessage: {
                title: "",
                message: ""
            }
        }
    },
    components: {ProfileHeader, AccountStatus, SearchBox},
    methods: {
        getDate: function (d) {
            var date = new Date(d)
            var res = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes()
            return res
        },
        showMessage: function (m) {
            this.selectedMessage.title = m.title
            this.selectedMessage.message = m.message
            this.showModal = true
        }
    }
}
</script>
