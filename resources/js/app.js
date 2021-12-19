require('./bootstrap');

import Vue from 'vue'
import routes from "./router/index"

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';

import VueModal from '@kouts/vue-modal'
import '@kouts/vue-modal/dist/vue-modal.css'

Vue.component('Modal', VueModal)

Vue.component('register', require('./components/Register.vue').default);

const app = new Vue({
    el: '#app',
    router: routes,
    mounted() {
        // get auth user id
        var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
        this.auth_user_id = userId
        // this.getNewOnLoad()
        axios.get('/api/my-profile/' + userId)
            .then((res) => {
                this.user = res.data.user
                this.complete = res.data.complete
                this.activated = res.data.activated
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            user: {
                id: "",
                profileStatus: "",
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
                is_verify: "",
            },
            auth_user_id: 0,
            complete: null,
            activated: "",
            un_read_messages: 0
        }
    },
    methods: {
        getNewOnLoad: function () {
            // get auth user id
            var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
            axios.get('/api/get-new-messages/' + userId)
                .then((res) => {
                    this.un_read_messages = res.data
                })
                .catch((e) => {
                    console.log(e)
                })
        }
    }
});
