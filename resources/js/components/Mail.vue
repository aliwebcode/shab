<template>
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile -->
                        <profile-header :user="user" :activated="activated"
                                        :auth_user_id="auth_user_id"></profile-header>
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
                                <div class="loading-area" v-if="!loaded">
                                    <i class="fas fa-spinner fa-pulse fa-2x"></i>
                                </div>
                                <br/>
                            </div>
                            <div class="tab-content p-0 col-lg-12" v-if="loaded">
                                <div class="tab-pane fade active show" id="tab1">
                                    <div class="card">
                                        <div class="card-header text-right">البريد</div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="notifications">
                                                        <li v-if="mails.length == 0">
                                                            <p class="text-center">لا يوجد بريد.</p>
                                                        </li>
                                                        <li class="text-right py-4" v-for="mail in mails.data"
                                                            :key="mail.id">
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
                                                    <pagination align="center" :data="mails"
                                                                @pagination-change-page="list"></pagination>
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
import ProfileHeader from "./ProfileHeader"
import AccountStatus from "./partials/accountStatus"
import SearchBox from "./SearchBox";
// import pagin from 'laravel-vue-pagination'

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    mounted() {
        this.list()
    },
    data: function () {
        return {
            mails: {
                type: Object,
            },
            showModal: false,
            selectedMessage: {
                title: "",
                message: ""
            },
            loaded: false
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
        },
        async list(page = 1) {
            await axios.get(`/api/get-mail/?page=${page}`)
                .then(({data}) => {
                    this.mails = data
                    this.loaded = true
                }).catch(({response}) => {
                    console.error(response)
                })
        }
    }
}
</script>
