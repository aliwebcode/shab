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
                                <div class="tab-pane fade active show" id="tab2">
                                    <table class="table table-bordered" style="text-align:center">
                                        <thead>
                                        <tr>
                                            <th scope="col">المرسل</th>
                                            <th scope="col">نوع الطلب</th>
                                            <th scope="col"> التاريخ</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-if="requests.length == 0">
                                            <td colspan="4" class="text-center">لا يوجد طلبات.</td>
                                        </tr>
                                        <tr v-for="(request,index) in requests">
                                            <th>
                                                <router-link :to="'/user/'+users[index].id">{{
                                                        users[index].name
                                                    }}
                                                </router-link>
                                            </th>
                                            <td>طلب رؤية شرعية</td>
                                            <td>{{ getDate(request.created_at) }}</td>
                                            <td>
                                                <input type="button" @click="showTheModalAcc=true,tmp=request.id"
                                                       value="تأكيد"
                                                       class="btn btn-success btn-sm"/>
                                                <input type="button" @click="showTheModal=true,t=request.id"
                                                       value="تجاهل" class="btn btn-danger btn-sm"/>
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
        <!-- Reject Model -->
        <Modal v-model="showTheModal" title="اختر سبب الرفض">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger text-center" v-if="empty.reject">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى كتابة سبب الرفض
                            </p>
                        </div>
                        <div class="modal-body" style="text-align:right">
                            يرجى كتابة سبب الرفض (100 كلمة)
                            <textarea class="form-control" v-model="reject">
                            </textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button @click="sendReject(t)" class="btn btn-primary">إرسال</button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
        <!-- Accept Model -->
        <Modal v-model="showTheModalAcc" title="تأكيد طلب الرؤية الشرعية" :modal-class="`${modalClass}`">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger text-center" v-if="empty.accept">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى اختيار مواعيد و الشخص المستضيف
                            </p>
                        </div>
                        <div class="alert alert-info text-right">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى إضافة مواعيد عديدة بحيث تناسب الطرف الآخر (حد أدنى 3 مواعيد)
                            </p>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6 style="text-align:right" class="mb-3">اختيار التاريخ المناسب</h6>

                                    <div v-for="(date, index) in row.dates">
                                        <input type="date" v-model="date.value" :key="index" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h6 style="text-align:right" class="mb-3">اختيار الوقت المناسب</h6>
<!--                                    <div class="row">-->
                                        <div v-for="(time, index) in row.times" class="row">
                                            <div class="col-6 text-right">
                                                <select class="form-control" style="direction: ltr" v-model="time.hour" :key="index">
                                                    <option disabled selected value="">الساعة</option>
                                                    <option value="00">00 AM</option>
                                                    <option value="01">1 AM</option>
                                                    <option value="02">2 AM</option>
                                                    <option value="03">3 AM</option>
                                                    <option value="04">4 AM</option>
                                                    <option value="05">5 AM</option>
                                                    <option value="06">6 AM</option>
                                                    <option value="07">7 AM</option>
                                                    <option value="08">8 AM</option>
                                                    <option value="09">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                </select>
                                            </div>
                                            <div class="col-6 text-right">
                                                <select class="form-control" style="direction: ltr" v-model="time.minute" :key="index">
                                                    <option disabled selected value="">الدقائق</option>
                                                    <option value="00">00</option>
                                                    <option value="05">05</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="35">35</option>
                                                    <option value="40">40</option>
                                                    <option value="45">45</option>
                                                    <option value="50">50</option>
                                                    <option value="55">55</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                                <a href="javascript:void(0);" @click="newDate">إضافة موعد جديد</a>
                                <a href="javascript:void(0);"
                                   class="mr-4"
                                   v-if="row.dates.length > 0"
                                   @click="row.dates = [],row.times = []">حذف المواعيد</a>
                                <div class="col-lg-12">
                                    <br>
                                    <hr>
                                </div>
                                <div class="col-lg-12">
                                    <br>
                                    <hr>
                                    <select class="form-control" v-model="row.host">
                                        <option value="" disabled>اختيار المستضيف</option>
                                        <option value="الأب">الأب</option>
                                        <option value="الأم">الأم</option>
                                        <option value="الأخ">الأخ</option>
                                        <option value="العم">العم</option>
                                        <option value="الخال">الخال</option>
                                        <option value="الجد">الجد</option>
                                        <option value="الجدة">الجدة</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary mx-2" @click="sendAccept(tmp)">حفظ</button>
                            <button type="button" class="btn btn-secondary" @click="showTheModalAcc = false">أغلاق
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    </section>
</template>
<style scoped>
select.form-control:not([size]):not([multiple]) {
    height: calc(2.25rem + 2px) !important;
}
select.form-control {
    border-radius: .25rem !important;
}
</style>
<script>
import ProfileHeader from "./ProfileHeader";
import SearchBox from "./SearchBox";
import AccountStatus from "./partials/accountStatus"

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated'],
    components: {ProfileHeader, SearchBox, AccountStatus},
    data: function () {
        return {
            requests: [],
            users: [],
            showTheModal: false,
            showTheModalAcc: false,
            modalClass: "modal-lg",
            empty: {
                reject: 0,
                accept: 0,
            },
            reject: "",
            row: {
                req_id: "",
                dates: [],
                times: [],
                location: "",
                host: "",
            },
            loaded: false
        }
    },
    mounted() {
        // get auth user id
        var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
        axios.get('/api/get-user-gender/' + userId)
            .then((response) => {
                if(response.data == 'male')
                    window.location.href = '/profile'
            })
        axios.get('/api/get-pending-requests/' + userId)
            .then((res) => {
                // console.log(res.data)
                var i = 0
                for (i; i < res.data.length; i++) {
                    this.requests.push(res.data[i].request)
                    this.users.push(res.data[i].user)
                }
                this.loaded = true
                // console.log(this.requests)
                // console.log(this.users)
            })
            .catch((err) => {
                console.log(err)
            })
    },
    methods: {
        getDate: function (d) {
            var date = new Date(d)
            var res = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes()
            return res
        },
        sendReject: function (id) {
            if (this.reject == '') {
                this.empty.reject = 1
                return
            } else
                this.empty.reject = 0
            axios.post("/api/send-reject-reason", {
                id: id,
                reject: this.reject
            })
                .then((res) => {
                    if (res.data == 1) {
                        this.requests = []
                        var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
                        axios.get('/api/get-pending-requests/' + userId)
                            .then((resp) => {
                                // console.log(resp.data)
                                var i = 0
                                for (i; i < resp.data.length; i++) {
                                    this.requests.push(resp.data[i].request)
                                    this.users.push(resp.data[i].user)
                                }
                            })
                            .catch((err) => {
                                console.log(err)
                            })
                        Swal.fire({
                            title: 'تم!',
                            text: 'تم رفض الطلب بنجاح',
                            icon: 'success',
                            confirmButtonText: 'تم'
                        })
                        this.showTheModal = 0
                    }
                })
        },
        sendAccept: function (id) {
            if(this.row.dates.length == 0 || this.row.host == '') {
                this.empty.accept = 1
                return
            } else
                this.empty.accept = 0
            this.row.req_id = id
            axios.post("/api/send-first-accept", {
                row: this.row
            })
                .then((res) => {
                    console.log(res.data)
                    this.requests = []
                    this.users = []
                    var i = 0
                    for (i; i < res.data.length; i++) {
                        this.requests.push(res.data[i].request)
                        this.users.push(res.data[i].user)
                    }
                    Swal.fire({
                        title: 'تم!',
                        text: 'تم قبول الطلب بنجاح..بانتظار موافقة الطرف الاخر',
                        icon: 'success',
                        confirmButtonText: 'تم'
                    })
                    this.showTheModalAcc = false
                    // if (res.data == 1) {
                    //     this.requests = []
                    //     var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
                    //     axios.get('/api/get-pending-requests/' + userId)
                    //         .then((resp) => {
                    //             // console.log(resp.data)
                    //             var i = 0
                    //             for (i; i < resp.data.length; i++) {
                    //                 this.requests.push(resp.data[i].request)
                    //                 this.users.push(resp.data[i].user)
                    //             }
                    //         })
                    //         .catch((err) => {
                    //             console.log(err)
                    //         })
                    //     Swal.fire({
                    //         title: 'تم!',
                    //         text: 'تم قبول الطلب بنجاح..بانتظار موافقة الطرف الاخر',
                    //         icon: 'success',
                    //         confirmButtonText: 'تم'
                    //     })
                    //     this.showTheModalAcc = 0
                    // }
                })
        },
        newDate: function () {
            this.row.dates.push({value: ''});
            this.row.times.push({hour: '',minute: ''})
            console.log(this.row.dates.length)
            console.log(this.row.times.length)
        }
    }
}
</script>

<style>
.modal-lg {
    max-width: 800px !important;
}
</style>

