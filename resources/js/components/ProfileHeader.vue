<template>
    <div class="profile">
        <div class="card py-4">
            <div class="row h-100">
                <div class="col-12 col-md-3">
                    <div class="text-right center-div">
                        <h6>الجنسية</h6>
                        <p class="mb-3">
                            <img :src="'/assets/flags/' + user.nationality + '.svg'"
                                 class="ml-1"
                                 style="border-radius: 7px"
                                 width="30" height="30">
                            {{ getWords(user.nationality) }}
                        </p>
                        <h6>العمر</h6>
                        <p class="mb-3">
                            {{ calcAge(user.birthday) }} سنة
                        </p>
                        <h6>الرمز التعريفي</h6>
                        <p class="mb-3">
                            {{ user.user_code }}
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-center">
                    <ul class="img-options">
                        <li>
                            <button type="button" class="btn btn-link" @click="showModal=true">
                                <i class="fa fa-image"></i>
                                تغيير صورة الملف الشخصي
                            </button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-link" @click="showModalSend=true">
                                <i class="fa fa-paper-plane"></i>
                                إرسال الصورة
                            </button>
                        </li>
                    </ul>
                    <div class="profile-img">
                        <img :src="'/storage/images/'+user.image" v-if="user.image">
                        <img :src="'/assets/img/Icon/'+user.avatar + '.jpg'" v-if="user.avatar">
                        <i class="fa fa-check" v-if="activated == 1"></i>
                        <svg class="circle-chart" viewBox="0 0 33.83098862 33.83098862"
                             xmlns="http://www.w3.org/2000/svg">
                            <circle class="circle-chart__background" stroke="#f1f1f1" stroke-width="1" fill="none"
                                    cx="16.91549431" cy="16.91549431" r="15.91549431"></circle>
                            <circle class="circle-chart__circle" stroke="#2196f3" stroke-width="1.5"
                                    stroke-dasharray="90,100" stroke-linecap="round" fill="none" cx="16.91549431"
                                    cy="16.91549431" r="15.91549431"></circle>
                        </svg>
                    </div>
                    <h6 class="mt-2">{{ user.name }}</h6>
                </div>
                <div class="col-12 col-md-3 text-center">
                    <div class="left-div">
                        <h6 class="mb-2">مرئي</h6>
                        <label class="switch">
                            <input type="checkbox" id="ShownCheck" @click="changeStatus(user.id)"
                                   v-model="user.profileStatus">
                            <span class="slider round"></span>
                        </label>
                        <div>
                            <router-link to="/notifications" class="btn btn-primary d-inline-block mx-2">
                                <i class="fa fa-bell"></i>
                            </router-link>
                            <router-link to="/profile/edit" class="btn btn-primary d-inline-block mx-2">
                                <i class="fa fa-edit"></i>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="user-nav">
                        <li :class="{active:activeTab=='profile'}">
                            <router-link to="/profile/me">
                                <i class="fa fa-id-card-alt"></i>
                                بياناتي
                            </router-link>
                        </li>
                        <li :class="{active:activeTab == 'interests'}">
                            <router-link to="/interests">
                                <i class="fa fa-heart"></i>
                                إهتماماتي
                            </router-link>
                        </li>
                        <li :class="{active:activeTab == 'chat'}">
                            <router-link to="/chat" :class="{notify:un_read>0}">
                                <i class="fa fa-paper-plane"></i>
                                <span v-if="un_read">المحادثات ({{ un_read }})</span>
                                <span v-else>المحادثات</span>
                            </router-link>
                        </li>
                        <li :class="{active:activeTab=='block-area'}">
                            <router-link to="/block-area">
                                <i class="fa fa-ban"></i>
                                قائمة التجاهل
                            </router-link>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-file-alt"></i>
                                السجل
                            </a>
                        </li>
                        <li :class="{active:activeTab=='mail'}">
                            <router-link to="/mail">
                                <i class="fa fa-envelope"></i>
                                البريد
                            </router-link>
                        </li>
                        <li v-if="user.gender == 'female'" :class="{active:activeTab=='pending-requests'}">
                            <router-link to="/pending-requests">
                                <i class="fa fa-list"></i>
                                طلبات معلقة
                            </router-link>
                        </li>
                        <li :class="{active:activeTab=='active-requests'}">
                            <router-link to="/active-requests">
                                <i class="fa fa-list-alt"></i>
                                {{ (user.gender == 'female') ? 'طلبات نظرة شرعية' : 'طلباتي' }}
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <Modal v-model="showModal" title="تغيير صورة الملف الشخصي">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger text-center" v-if="empty">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى تحميل صورة جديدة أو اختيار شكل مناسب
                            </p>
                        </div>
                        <div v-if="imageOrAvatar == 'image'">
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
                        </div>
                        <div class="avatars my-2" v-if="imageOrAvatar == 'avatar'">
                            <img src="/assets/img/Icon/M1.jpg" @click="setAvatar('M1')"
                                 :class="{active: avatar == 'M1'}">
                            <img src="/assets/img/Icon/M2.jpg" @click="setAvatar('M2')"
                                 :class="{active: avatar == 'M2'}">
                            <img src="/assets/img/Icon/M3.jpg" @click="setAvatar('M3')"
                                 :class="{active: avatar == 'M3'}">
                            <img src="/assets/img/Icon/M4.jpg" @click="setAvatar('M4')"
                                 :class="{active: avatar == 'M4'}">
                            <img src="/assets/img/Icon/M5.jpg" @click="setAvatar('M5')"
                                 :class="{active: avatar == 'M5'}">
                            <img src="/assets/img/Icon/M6.jpg" @click="setAvatar('M6')"
                                 :class="{active: avatar == 'M6'}">
                            <img src="/assets/img/Icon/M7.jpg" @click="setAvatar('M7')"
                                 :class="{active: avatar == 'M7'}">
                        </div>
                        <div class="text-center">
                            <h6>أو</h6>
                            <button class="btn btn-link" v-if="imageOrAvatar=='image'"
                                    @click="setImageOrAvatar('avatar')">
                                اختيار شكل (avatar)
                            </button>
                            <button class="btn btn-link" v-if="imageOrAvatar=='avatar'"
                                    @click="setImageOrAvatar('image')">
                                رفع صورة
                            </button>
                        </div>
                        <hr>
                        <div class="col-12 text-center">
                            <button @click="changeImage(user.id)" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
        <Modal v-model="showModalSend" title="إرسال صورتي الشخصية">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger text-center" v-if="emptyCode">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى كتابة كود المستخدم
                            </p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="userCode"
                                   placeholder="كود الأنثى (مثال: PYJN8T)">
                        </div>
                        <div class="col-12 text-center">
                            <button @click="sendImageTo(auth_user_id)" class="btn btn-primary">إرسال</button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>

<style>
.user-nav li a.notify {
    font-weight: bold;
    color: #f00;
}
.profile .card {
    padding-bottom: 0 !important;
}

.profile-img {
    position: relative;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    margin: 10px auto;
    text-align: center;
    padding: 13px;
}

.profile-img img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.profile-img svg {
    height: 200px;
    width: 200px;
    fill: none;
    stroke: #2a4cd0;
    stroke-width: 3;
    stroke-linecap: round;
    position: absolute;
    left: 0;
    top: 0;
}

.profile-img i {
    position: absolute;
    font-size: 20px;
    bottom: 15px;
    right: 25px;
    background: #1ad00b;
    padding: 5px;
    color: #fff;
    border-radius: 50%;
    z-index: 9999;
}

.circle-chart__circle {
    animation: circle-chart-fill 1s reverse;
    transform: rotate(-90deg);
    transform-origin: center;
}

.user-nav {
    width: 100%;
    text-align: right;
    margin-top: 10px;
    border-top: 1px solid #eee;
}

.user-nav li {
    display: inline-block;
    padding: 10px 15px;
}

.user-nav li.active {
    border-bottom: 3px solid #2196f3;
    transition: .3s all;
}

.user-nav li a {
    color: #555;
}

.user-nav li a i {
    margin-left: 3px;
}

.img-options li {
    margin: 0 8px;
    display: inline-block;
}

.img-options li button {
    color: #555 !important;
}

.img-options li button:hover {
    text-decoration: none !important;
}

.profile .center-div, .profile .left-div {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.loading-area {
    text-align: center;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
}

@media (max-width: 768px) {
    .profile {
        margin-top: 40px;
    }
}


</style>

<script>
export default {
    props: ['user', 'auth_user_id', 'userData', 'un_read_messages', 'activated'],
    mounted() {
        // Get unread message count
        var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
        axios.get('/api/get-new-messages/' + userId)
            .then((res) => {
                this.un_read = res.data
                // console.log(this.un_read)
            })
            .catch((e) => {
                console.log(e)
            })

        Echo.private(`chat.${authUser.id}`)
            .listen('MessageSend', (e) => {
                this.un_read++
            });

        Echo.private(`App.User.${authUser.id}`)
            .notification((notification) => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-start',
                    showConfirmButton: true,
                    confirmButtonText: '<a href="/notifications" style="color:white">مركز الإشعارات</a>',
                    timerProgressBar: false,
                    showCloseButton: true,
                    // didOpen: (toast) => {
                    //     toast.addEventListener('mouseenter', Swal.stopTimer)
                    //     toast.addEventListener('mouseleave', Swal.resumeTimer)
                    // }
                })
                Toast.fire({
                    icon: 'info',
                    title: 'لديك إشعار جديد'
                })
            });

        let activeTab = ''
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
        else if (this.$route.path == '/mail')
            activeTab = 'mail'
        this.activeTab = activeTab

        // window.setInterval(() => {
        //     // this.getNew()
        // }, 5000);
    },
    data: function () {
        return {
            activeTab: '',
            showModal: false,
            showModalSend: false,
            imagePreview: "",
            image: "",
            avatar: "",
            imageOrAvatar: "image",
            empty: 0,
            un_read: 0,
            userCode: "",
            emptyCode: 0,
            counts: {
                mails: null,
                requests: null
            }
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
                    if (res.status == 200) {
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
                        if(res.data == 1) {
                            Toast.fire({
                                icon: 'success',
                                title: 'تم التعديل بنجاح سوف يظهر ملفك الشخصي للعامة'
                            })
                        } else {
                            Toast.fire({
                                icon: 'success',
                                title: 'تم التعديل بنجاح لن يظهر ملفك الشخصي للعامة'
                            })
                        }
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
            if (this.image == '' && this.avatar == '') {
                this.empty = 1
                return
            }
            const fd = new FormData()
            // Set Image Request
            if (this.image != '') {
                fd.append('image', this.image)
            }
            // Set UserId Request
            fd.append('user_id', id)
            // Set Avatar Request
            if (this.avatar != '') {
                fd.append('avatar', this.avatar)
            }
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
                        this.image = ""
                        this.imagePreview = ""
                        this.avatar = ""
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
                            title: 'تم التعديل بنجاح، سيتم إعادة تحميل الصفحة'
                        })
                        setTimeout(function () {
                            location.reload()
                        }, 4000);
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        sendImageTo: function (from_id) {
            if (this.userCode == '') {
                this.emptyCode = true
                return
            }
            axios.post("/api/send-image", {
                user_code: this.userCode,
                from_id: from_id
            })
                .then((res) => {
                    if (res.data == -1) {
                        Swal.fire({
                            title: 'تنبيه!',
                            text: 'قم بتحميل صورة لإرسالها',
                            icon: 'warning',
                            confirmButtonText: 'تم'
                        })
                    } else if (res.data == 0) {
                        Swal.fire({
                            title: 'تنبيه!',
                            text: 'عذراً لم يتم إيجاد المستخدم المطلوب',
                            icon: 'warning',
                            confirmButtonText: 'تم'
                        })
                    } else {
                        Swal.fire({
                            title: 'تهانينا!',
                            text: 'تم إرسال الصورة إلى ' + res.data.name,
                            icon: 'success',
                            confirmButtonText: 'تم'
                        })
                        this.userCode = ""
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
                    if (res.data > this.un_read) {
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
        },
        setAvatar: function (n) {
            this.image = ""
            this.imagePreview = ""
            this.avatar = n
        },
        setImageOrAvatar: function (e) {
            this.imageOrAvatar = e
            if (e == 'image')
                this.avatar = ""
            else {
                this.image = ""
                this.imagePreview = ""
            }
        },
        getWords: function (w) {
            let words = {
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
            }
            return words[w]
        }
    },
}
</script>
