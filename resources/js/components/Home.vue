<template>
    <div class="profile">
        <div class="profile-header" id="profile-header" style="background-color:#ee3158">
            <!-- BEGIN profile-header-cover -->
            <div class="profile-header-cover"></div>
            <!-- END profile-header-cover -->
            <!-- BEGIN profile-header-content -->
            <div class="profile-header-content">
                <!-- BEGIN profile-header-img -->
                <div class="profile-header-img">
                    <a title="تغيير الصورة" style="color:black;cursor: pointer" @click="showModal=true">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>
                    <a href="#" title="أرسال الصورة" onclick="SendImageModal()"
                       style="color:black;padding: 0 17% 0 17%;"><i
                        class="fas fa-comments fa-lg"></i></a>
                    <a href="#" title="أختيار أيقونة" data-toggle="modal" data-target="#ChooseIcon"
                       style="color:black;"><i class="far fa-smile-beam fa-lg"></i></a>
                    <img :src="'/storage/images/'+user.image" ref="userImage">
                </div>
                <!-- END profile-header-img -->
                <!-- BEGIN profile-header-info -->
                <div class="profile-header-info" style="text-align:right">
                    <p style="text-align:left;padding:0 0 0 2%;color:white" id="ShownCheckText"
                       class="hidden-xs">مرئي</p>
                    <label class="switch hidden-xs" style="float:left">
                        <input type="checkbox" @click="changeStatus(user.id)" v-model="user.profileStatus"
                               id="ShownCheck">
                        <span class="slider round"></span>
                    </label>
                    <p class="m-b-10" style="color:white"> الرمز التعريفي : AE4888</p>
                    <p class="m-b-10" style="color:white">الجنسية :
                        <img class="hidden-xs" :src="'/assets/flags/SY.svg'" style="width: 40px;"/>
                        {{ words[user.country] }}
                    </p>
                    <p class="m-b-10" style="color:white">
                        السن :
                        {{ calcAge(user.birthday) }} سنة
                    </p>
                    <a v-if="userData && auth_user_id == userData.id" href="/profile/edit"
                       class="btn btn-sm btn-info mb-2">
                        تعديل الحساب
                    </a>
                </div>
                <div class="col-lg-12 hidden-xs" style="text-align:left">
                    <h6 style="color:white">غير لون الخلفية</h6>
                    <a href="#" onclick="ChangeColor('007bff')"><span class="circle"
                                                                      style="color:#007bff"></span></a>
                    <a href="#" onclick="ChangeColor('ee3158')"><span class="circle"
                                                                      style="color:#ee3158"></span></a>
                    <a href="#" onclick="ChangeColor('6d767f')"><span class="circle"
                                                                      style="color:#6d767f"></span></a>
                    <a href="#" onclick="ChangeColor('00B488')"><span class="circle"
                                                                      style="color:#00B488"></span></a>
                    <a href="#" onclick="ChangeColor('1DA1F2')"><span class="circle"
                                                                      style="color:#1DA1F2"></span></a>
                </div>
                <!-- END profile-header-info -->
            </div>
            <!-- END profile-header-content -->
            <!-- BEGIN profile-header-tab -->
            <ul class="profile-header-tab nav nav-tabs">
                <li class="nav-item">
                    <router-link to="/profile/me" class="nav-link" data-toggle="tab"
                                 :class="{active:activeTab=='profile'}">
                        بياناتي
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/interests" class="nav-link" data-toggle="tab"
                                 :class="{active:activeTab == 'interests'}">
                        إهتماماتي
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/chat" class="nav-link" data-toggle="tab"
                                 :class="{active:activeTab == 'chat'}">
                        المحادثات ({{ un_read }})
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/block-area" class="nav-link" data-toggle="tab"
                                 :class="{active:activeTab=='block-area'}">
                        قائمة التجاهل (0)
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/" class="nav-link" data-toggle="tab">
                        السجل
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/" class="nav-link" data-toggle="tab">
                        البريد (0)
                    </router-link>
                </li>
                <li class="nav-item" v-if="user.gender == 'female'">
                    <router-link to="/pending-requests" class="nav-link" data-toggle="tab"
                                 :class="{active:activeTab=='pending-requests'}">
                        طلبات معلقة (0)
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/active-requests" class="nav-link" data-toggle="tab"
                                 :class="{active:activeTab=='active-requests'}">
                        {{ (user.gender == 'female') ? 'طلبات نظرة شرعية (0)' : 'طلباتي (0)' }}
                    </router-link>
                </li>
            </ul>
            <!-- END profile-header-tab -->
        </div>

        <Modal v-model="showModal" title="تغيير صورة الملف الشخصي">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger text-center" v-if="empty">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى تحميل صورة جديدة
                            </p>
                        </div>
                        <div class="preview-image" v-if="imagePreview">
                            <img :src="imagePreview">
                            <button class="btn btn-danger mt-2" @click="imagePreview = '',image = ''">
                                <i class="fa fa-trash-alt"></i>
                                حذف
                            </button>
                        </div>
                        <div class="upload-image border" v-if="!image">
                            <input id="user-image" type="file" class="form-control"
                                   @change="imageUpload($event)">
                            <i class="fa fa-cloud-upload-alt"></i>
                        </div>
                        <div class="col-12 text-center">
                            <button @click="changeImage(user.id)" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>

    </div>
</template>
<style>
.vm-titlebar {
    text-align: center !important;
}

.new_not_color {
    color: #f71717 !important;
}
</style>
<script>
export default {
    props: ['user', 'auth_user_id', 'userData', 'un_read_messages'],
    mounted() {
        var activeTab = ''
        if (this.$route.path == '/interests')
            activeTab = 'interests'
        else if (this.$route.path == '/profile/me')
            activeTab = 'profile'
        else if (this.$route.path == '/chat')
            activeTab = 'chat'
        else if (this.$route.path == '/pending-requests')
            activeTab = 'pending-requests'
        else if (this.$route.path == '/active-requests')
            activeTab = 'active-requests'
        else if (this.$route.path == '/block-area')
            activeTab = 'block-area'
        this.activeTab = activeTab

        window.setInterval(() => {
            // this.getNew()
        }, 5000);
    },
    data: function () {
        return {
            words: {
                syria: "الجمهورية العربية السورية",
            },
            userCountry: this.user,
            activeTab: '',
            showModal: false,
            imagePreview: "",
            image: "",
            empty: 0,
            un_read: 0
        }
    },
    methods: {
        calcAge: function (dateString) {
            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        },
        changeStatus: function (e) {
            axios.post('/api/change-profile-status', {
                id: e
            })
                .then((res) => {
                    if (res.data == 1) {
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
                            title: 'تم التعديل بنجاح'
                        })
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        imageUpload(event) {
            this.imagePreview = URL.createObjectURL(event.target.files[0])
            this.image = event.target.files[0]
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
        changeImage(id) {
            if (this.image == '') {
                this.empty = 1
                return
            }
            const fd = new FormData()
            fd.append('image', this.image)
            fd.append('user_id', id)
            for (var [key, value] of fd.entries()) {
                fd[key] = value
            }
            axios({
                method: "post",
                url: "/api/change-image",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
                .then((res) => {
                    if (res.data == 1) {
                        this.$refs.userImage.src = this.imagePreview
                        this.image = ""
                        this.imagePreview = ""
                        this.showModal = false
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
                            title: 'تم التعديل بنجاح'
                        })
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        getNew: function () {
            // Get New Messages
            var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
            axios.get('/api/get-new-messages/' + userId)
                .then((res) => {
                    if(res.data > this.un_read) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-start',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'info',
                            title: 'لديك رسائل جديدة'
                        })
                    }
                    this.un_read = res.data
                })
                .catch((e) => {
                    console.log(e)
                })
        }
    },
}
</script>
