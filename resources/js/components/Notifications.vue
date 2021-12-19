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
                                <br/>
                            </div>
                            <div class="tab-content p-0 col-lg-12">
                                <div class="tab-pane fade active show" id="tab1">
                                    <div class="card">
                                        <div class="card-header text-right">
                                            مركز الإشعارات
                                        </div>
                                        <div class="card-body p-0 text-right">
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="notifications">
                                                        <li v-for="(notification,index) in notifications"
                                                            :class="{active:notification.seen == 0}">
                                                            <img :src="'/storage/images/sent/'+notification.image">
                                                            <p>
                                                                أرسل لك
                                                                <router-link to="":to="'/user/'+users[index].id">
                                                                    {{ users[index].name }}
                                                                </router-link>
                                                                صورته الشخصية.
                                                                <a href="#">
                                                                    عرض الصورة
                                                                </a>
                                                            </p>
                                                            <span>
                                                                <i class="fa fa-clock"></i>
                                                                {{ notification.created_at }}
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
    </section>
</template>
<style>
ul.notifications {
    margin: 0;
    padding: 0;
}
ul.notifications li {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid #eee;
    padding: 15px 10px;
    align-items: center;
}
ul.notifications img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}
ul.notifications li p {
    flex: 1;
    margin: 0 10px;
}
ul.notifications li span {
    color: var(--primary-font-color);
    font-size: 13px;
}
/* Active */
ul.notifications li.active {
    background-color: #f4f2f2 !important;
}
ul.notifications li.active p,
ul.notifications li.active span
{
    color: #000 !important;
}

</style>
<script>
import ProfileHeader from "../components/ProfileHeader"
import AccountStatus from "./partials/accountStatus"

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    mounted() {
        // get auth user id
        var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
        axios.get('/api/get-notifications/' + userId)
        .then((res) => {
            let i = 0
            for (i; i < res.data.length; i++) {
                this.notifications.push(res.data[i].data)
                this.users.push(res.data[i].data.sender)
            }
            // console.log(res.data)
            // console.log(this.users)
        })
        .catch((err) => {
            console.log(err)
        })
        // axios.post('/api/get-notifications-mark',{
        //     user_id: userId
        // })
    },
    data: function () {
        return {
            notifications: [],
            users: []
        }
    },
    components: {ProfileHeader, AccountStatus},
}
</script>
