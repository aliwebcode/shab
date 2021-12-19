<template>
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile -->
                        <profile-header :user="user" :auth_user_id="auth_user_id"></profile-header>
                        <!-- end profile -->
                        <!-- begin profile-content -->
                        <div class="profile-content row" v-if="activated == 'n' || activated == -1">
                            <div class="col-12">
                                <div class="alert alert-danger text-center" v-if="activated == -1">
                                    <h6>
                                        <i class="fa fa-times-circle"></i>
                                        تمت مراجعة الوثيقة ورفضها من قبل الإدارة، يمكنك رفع صورة أخرى
                                    </h6>
                                </div>
                                <h5 class="text-center mb-4">توثيق الحساب</h5>
                            </div>
                            <div class="col-12">
                                <div class="alert alert-danger text-center" v-if="empty">
                                    <i class="fa fa-info-circle"></i>
                                    يرجى رفع صورة واختيار نوع الوثيقة
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="col-12 text-center">
                                        <h6 class="text-center py-4">اختر أحد الطرق لتفعيل حسابك</h6>
                                        <div class="radio-box" :class="{active:activeRadio == 1}">
                                            <input @click="changeActive(1)" type="radio" v-model="image_type" value="جواز سفر">
                                            <div class="radio-title">
                                                <i class="fa fa-passport fa-lg"></i>
                                                <span>جواز سفر</span>
                                            </div>
                                        </div>
                                        <div class="radio-box" :class="{active:activeRadio == 2}">
                                            <input @click="changeActive(2)" type="radio" v-model="image_type" value="الهوية الشخصية">
                                            <div class="radio-title">
                                                <i class="fa fa-id-card fa-lg"></i>
                                                <span>الهوية الشخصية</span>
                                            </div>
                                        </div>
                                        <div class="radio-box" :class="{active:activeRadio == 3}">
                                            <input @click="changeActive(3)" type="radio" v-model="image_type" value="شهادة الميلاد">
                                            <div class="radio-title">
                                                <i class="fa fa-id-card-alt fa-lg"></i>
                                                <span>شهادة الميلاد</span>
                                            </div>
                                        </div>
                                        <div class="radio-box" :class="{active:activeRadio == 4}">
                                            <input @click="changeActive(4)" type="radio" v-model="image_type" value="الشهادة الدراسية">
                                            <div class="radio-title">
                                                <i class="fa fa-certificate fa-lg"></i>
                                                <span>الشهادة الدراسية</span>
                                            </div>
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-3" v-if="showBtn">
                                <button @click="send(user.id)" class="btn btn-success">حفظ</button>
                            </div>
                        </div>
                        <!-- end profile-content -->
                        <div class="profile-content row" v-else-if="activated == 1">
                            <div class="col-12">
                                <div class="alert alert-success text-center">
                                    <h6>
                                        <i class="fa fa-check-circle"></i>
                                        تم مراجعة الوثيقة وقبولها من طرف الإدارة.
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="profile-content row" v-else-if="activated == 0">
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    <h6>
                                        <i class="fa fa-info-circle"></i>
                                        طلبك قيد المراجعة من قبل الإدارة
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
.radio-box {
    position: relative;
    width: 115px;
    height: 115px;
    background: #f9f9f9;
    border: 1px solid #eee;
    display: inline-block;
    margin: 20px 10px;
    border-radius: 8px;
}
.radio-box.active {
    border: 2px solid #ee3158;
}
.radio-box:hover {
    box-shadow: 0 0 6px 1px #eaeaea;
}

.radio-box input {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    z-index: 99999;
    cursor: pointer;
}

.radio-box .radio-title {
    position: absolute;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.radio-box .radio-title i {
    display: block;
}
</style>

<script>
import ProfileHeader from "../components/ProfileHeader"
import SearchBox from "../components/SearchBox"

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    mounted() {

    },
    data: function () {
        return {
            activeRadio: "",
            empty: 0,
            imagePreview: "",
            image: "",
            image_type: "",
            showBtn: 1,
        }
    },
    components: {ProfileHeader, SearchBox},
    methods: {
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
        send: function (id) {
            if(this.image_type == '' || this.image == '') {
                this.empty = 1
                return
            }
            this.showBtn = 0
            const fd = new FormData()
            fd.append('image', this.image)
            fd.append('image_type', this.image_type)
            fd.append('user_id', id)
            for (var [key, value] of fd.entries()) {
                fd[key] = value
            }
            axios({
                method: "post",
                url: "/api/activate",
                data: fd,
                headers: { "Content-Type": "multipart/form-data" },
            })
            .then((res) => {
                if(res.data == 1) {
                    Swal.fire({
                        title: 'تهانينا!',
                        text: 'تم إرسال الوثيقة للإدارة',
                        icon: 'success',
                        confirmButtonText: 'تم'
                    })
                    window.setTimeout(function(){
                        window.location.href = "/profile";
                    }, 2000);
                }
            })
            .catch((err) => {
                console.log(err)
            })
        },
        changeActive: function (num) {
            this.activeRadio = num
        }
    }
}
</script>
