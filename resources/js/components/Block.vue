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
                            <div class="tab-content p-0 col-lg-12">
                                <div class="tab-pane table-responsive fade active show" id="tab2">
                                    <table class="table table-bordered" style="text-align:center">
                                        <thead>
                                        <tr>
                                            <th scope="col">المستخدم</th>
                                            <th scope="col">تاريخ الحظر</th>
                                            <th scope="col">خيارات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(block,index) in blocks">
                                            <th>
                                                <router-link :to="'/user/'+users[index].id">{{
                                                        users[index].name
                                                    }}
                                                </router-link>
                                            </th>
                                            <td>{{ getDate(block.created_at) }}</td>
                                            <td>
                                                <input type="button" @click="cancelBlock(block.id)" value="إلغاء الحظر"
                                                       class="btn btn-primary btn-sm">
                                                <input type="button" value="إبلاغ عن إساءة"
                                                       class="btn btn-danger btn-sm">
                                            </td>
                                            <td>
                                                -
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
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
import ProfileHeader from "./ProfileHeader";
import SearchBox from "./SearchBox";
import AccountStatus from "./partials/accountStatus";

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    components: {ProfileHeader, SearchBox, AccountStatus},
    data: function () {
        return {
            blocks: [],
            users: [],
        }
    },
    mounted() {
        // get auth user id
        var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
        axios.get('/api/get-blocked/' + userId)
            .then((res) => {
                var i = 0
                for (i; i < res.data.length; i++) {
                    this.blocks.push(res.data[i].block)
                    this.users.push(res.data[i].user)
                }
            })
    },
    methods: {
        getDate: function (d) {
            var date = new Date(d)
            var res = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes()
            return res
        },
        cancelBlock: function (id) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تستطيع التراجع بعد التأكيد",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("/api/cancel-block", {
                        id: id
                    })
                        .then((res) => {
                            var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
                            this.auth_user_id = userId
                            axios.get('/api/get-blocked/' + userId)
                                .then((res) => {
                                    this.blocks = []
                                    this.users = []
                                    var i = 0
                                    for (i; i < res.data.length; i++) {
                                        this.blocks.push(res.data[i].block)
                                        this.users.push(res.data[i].user)
                                    }
                                })
                            Swal.fire(
                                'تهانينا!',
                                'تم إلغاء الحظر بنجاح.',
                                'success'
                            )
                        })
                }
            })
        }
    }
}
</script>

<style>
.modal-lg {
    max-width: 800px !important;
}
</style>

