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
                                <div class="loading-area" v-if="!loaded">
                                    <i class="fas fa-spinner fa-pulse fa-2x"></i>
                                </div>
                                <br/>
                            </div>
                            <div class="tab-content p-0 col-lg-12" v-if="loaded">
                                <div class="tab-pane table-responsive fade active show" id="tab2">
                                    <table v-if="user.gender=='female'" class="table table-bordered"
                                           style="text-align:center">
                                        <thead>
                                        <tr>
                                            <th scope="col">المرسل</th>
                                            <th scope="col">تاريخ المقابلة</th>
                                            <th scope="col">خيارات</th>
                                            <th scope="col">الوقت المتبقي</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-if="requests.length == 0">
                                            <td colspan="4" class="text-center">لا يوجد طلبات.</td>
                                        </tr>
                                        <tr v-for="(request,index) in requests">
                                            <td>
                                                <a :href="'/user/'+users[index].id">
                                                    {{ users[index].name }} ({{ users[index].user_code }})
                                                </a>
                                            </td>
                                            <td v-if="request.status == 1 && requestDate[index] != 0">
                                                {{ requestDate[index] }}
                                                <br>
                                                <bdi>
                                                    <span>
                                                        {{ requestHour[index] - 12 > 0 ? requestHour[index] - 12 : requestHour[index] }}
                                                    </span>:
                                                    <span>{{
                                                            requestMinute[index] == 0 ? '00' : requestMinute[index]
                                                        }}</span>
                                                    <span>
                                                        {{ requestHour[index] - 12 > 0 ? ' PM' : ' AM' }}
                                                    </span>
                                                </bdi>
                                            </td>
                                            <td v-else-if="request.status == 'C'">
                                                <button class="btn btn-danger btn-sm" type="button">ملغية</button>
                                            </td>
                                            <td v-else>في انتظار الطرف الاخر</td>
                                            <td v-if="requestDate[index] != 0 && request.status == 1">
                                                <input type="button"
                                                       value="تمديد الوقت"
                                                       class="btn btn-info btn-sm"
                                                       v-if="getDateStatus(requestDate[index],requestHour[index],requestMinute[index]) == -1"
                                                />
                                                <input
                                                    v-if="getDateStatus(requestDate[index],requestHour[index],requestMinute[index])!=-1"
                                                    type="button"
                                                    @click="cancelMeeting(request.id)"
                                                    value="إلغاء المقابلة"
                                                    class="btn btn-danger btn-sm"/>
                                                <input
                                                    v-if="getDateStatus(requestDate[index],requestHour[index],requestMinute[index])==-1"
                                                    type="button"
                                                    value="موافق"
                                                    class="btn btn-success btn-sm"
                                                />
                                                <input
                                                    v-if="getDateStatus(requestDate[index],requestHour[index],requestMinute[index])==-1"
                                                    type="button"
                                                    @click="showTheModal = true,t=request.id"
                                                    value="غير موافق"
                                                    class="btn btn-danger btn-sm"
                                                />
                                            </td>
                                            <td v-else>-</td>
                                            <td v-if="requestDate[index] != 0 && request.status == 1">
                                                {{
                                                    getDate(requestDate[index], requestHour[index], requestMinute[index])
                                                }}
                                            </td>
                                            <td v-else>-</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table v-if="user.gender=='male'" class="table table-bordered"
                                           style="text-align:center">
                                        <thead>
                                        <tr>
                                            <th scope="col">المرسل لها</th>
                                            <th scope="col">تاريخ المقابلة</th>
                                            <th scope="col">خيارات</th>
                                            <th scope="col">الوقت المتبقي</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-if="requests.length == 0">
                                            <td colspan="4" class="text-center">لا يوجد طلبات.</td>
                                        </tr>
                                        <tr v-for="(request,index) in requests">
                                            <td>
                                                <a :href="'/user/'+users[index].id">
                                                    {{ users[index].name }} ({{ users[index].user_code }})
                                                </a>
                                            </td>
                                            <td v-if="request.status == 0">بانتظار الموافقة وتحديد موعد</td>
                                            <td v-else-if="request.status == 1 && requestDate[index] != 0">
                                                {{ requestDate[index] }}
                                                <br>
                                                <bdi>
                                                    <span>
                                                        {{ requestHour[index] - 12 > 0 ? requestHour[index] - 12 : requestHour[index] }}
                                                    </span>:
                                                    <span>{{
                                                            requestMinute[index] == 0 ? '00' : requestMinute[index]
                                                        }}</span>
                                                    <span>
                                                        {{ requestHour[index] - 12 > 0 ? ' PM' : ' AM' }}
                                                    </span>
                                                </bdi>
                                            </td>
                                            <td v-else-if="request.status == 1 && requestDate[index]==0">
                                                <button class="btn btn-info btn-sm"
                                                        @click="getDates(request.id)">اختيار موعد
                                                </button>
                                            </td>
                                            <td v-else-if="request.status == 'C'">
                                                <strong class="text-danger">ملغية</strong>
                                            </td>
                                            <td v-else-if="request.status == 'R'">
                                                <strong class="text-danger">مرفوضة</strong>
                                                <br>
                                                <p class="text-center">سبب الرفض:</p>
                                                <p class="text-right">{{ request.reject_reason }}</p>
                                            </td>
                                            <td v-else>في انتظار تحديد موعد</td>
                                            <td v-if="requestDate[index] != 0 && request.status == 1">
                                                <input type="button"
                                                       value="تمديد الوقت"
                                                       class="btn btn-info btn-sm"
                                                       v-if="getDateStatus(requestDate[index],requestHour[index],requestMinute[index]) == -1"
                                                />
                                                <input
                                                    v-if="getDateStatus(requestDate[index],requestHour[index],requestMinute[index])!=-1"
                                                    type="button"
                                                    @click="cancelMeeting(request.id)"
                                                    value="إلغاء المقابلة"
                                                    class="btn btn-danger btn-sm"/>
                                            </td>
                                            <td v-else>-</td>
                                            <td v-if="requestDate[index] != 0 && request.status == 1">
                                                {{
                                                    getDate(requestDate[index], requestHour[index], requestMinute[index])
                                                }}
                                            </td>
                                            <td v-else>-</td>
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
        <!-- Reject Modal -->
        <Modal v-model="showTheModal" title="اختر سبب الرفض">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger text-center" v-if="empty.reject">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى اختيار سبب واحد
                            </p>
                        </div>
                        <div class="modal-body" style="text-align:right">
                            <br>
                            <input type="radio" name="radio_r" @click="changeReason('التقاليد غير متوافقة')">التقاليد
                            غير
                            متوافقه
                            <br>
                            <input type="radio" name="radio_r" @click="changeReason('الأصل والعرق مختلف')">الأصل والعرق
                            مختلف
                            <br>
                            <input type="radio" name="radio_r" @click="changeReason('لا يوجد جدية بالزواج')">لايوجد جدية
                            بالزواج
                            <br>
                            <input type="radio" name="radio_r" @click="changeReason('other')"> أسباب أخرى كتابة السبب
                            100
                            كلمة:
                            <br>
                            <textarea class="form-control" v-if="showOther" v-model="rejectReason">
                            </textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button @click="sendReject(t)" class="btn btn-primary">إرسال</button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
        <!-- Select Date Modal -->
        <Modal v-model="showSelectDateModal" title="اختيار موعد">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger text-center" v-if="empty.reject">
                            <p>
                                <i class="fa fa-info-circle"></i>
                                يرجى اختيار موعد واحد
                            </p>
                        </div>
                        <div class="modal-body" style="text-align:right">
                            <div v-for="date in dates">
                                <input type="radio"
                                       name="radio_r"
                                       @click="selectDate(date.id)">
                                <bdi>
                                    تاريخ:
                                    {{ date.rec_date }}
                                    الوقت:
                                    {{
                                        date.rec_hour - 12 > 0 ? date.rec_hour - 12 : date.rec_hour
                                    }}:{{ date.rec_minute == 0 ? '00' : date.rec_minute }}
                                    {{ date.rec_hour - 12 > 0 ? ' PM' : ' AM' }}
                                </bdi>
                            </div>
                        </div>
                        <div class="col-12 text-center" v-if="datesError">
                            <div class="alert alert-danger">يرجى اختيار إما موعد أو شهر مناسب لك</div>
                        </div>
                        <div class="col-12 text-center">
                            <button @click="sendDate" class="btn btn-primary">إرسال</button>
                        </div>
                    </div>
                </div>
            </div>
        </Modal>

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
            requests: [],
            users: [],
            requestDate: [],
            requestHour: [],
            requestMinute: [],
            gender: "",
            showTheModal: false,
            showOther: false,
            rejectReason: "",
            empty: {
                reject: false,
            },
            showSelectDateModal: false,
            dates: [],
            selected: null,
            datesError: false,
            loaded: false
        }
    },
    mounted() {
        // get auth user id
        var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
        // Get User Gender
        axios.get('/api/get-user-gender/' + userId)
            .then((response) => {
                if (response.data == 'male') {
                    this.gender = "male"
                    axios.get('/api/get-male-requests/' + userId)
                        .then((r) => {
                            var i = 0
                            for (i; i < r.data.length; i++) {
                                this.requests.push(r.data[i].request)
                                this.users.push(r.data[i].user)
                                this.requestDate.push(r.data[i].requestDate)
                                this.requestHour.push(r.data[i].requestHour)
                                this.requestMinute.push(r.data[i].requestMinute)
                            }
                            this.loaded = true
                            // console.log(this.reqDate)
                        })
                } else if (response.data == 'female') {
                    this.gender = "female"
                    axios.get('/api/get-active-requests/' + userId)
                        .then((res) => {
                            var i = 0
                            for (i; i < res.data.length; i++) {
                                this.requests.push(res.data[i].request)
                                this.users.push(res.data[i].user)
                                this.requestDate.push(res.data[i].requestDate)
                                this.requestHour.push(res.data[i].requestHour)
                                this.requestMinute.push(res.data[i].requestMinute)
                            }
                            this.loaded = true
                            // console.log(this.reqDate)
                        })
                }
            })
    },
    methods: {
        getDate: function (d, h, m) {
            var today = new Date()
            var tmp = new Date(d)

            // Results
            var years = tmp.getFullYear() - today.getFullYear()
            var months = (tmp.getMonth() + 1) - (today.getMonth() + 1)
            var days = tmp.getDate() - today.getDate()
            var hours = h - today.getHours()
            var minutes = m - today.getMinutes()
            var result = ""
            if (years > 0)
                result += years + " سنة "
            if (months > 0)
                result += months + " شهر "
            if (days > 0)
                result += days + " يوم "
            if (years <= 0 && months <= 0 && days == 0) {
                if (hours > 0) {
                    if (minutes < 0) {
                        hours--
                        minutes = (60 - Math.abs(minutes))
                    }
                    result = hours + " ساعة "
                    result += minutes + " دقيقة "
                }
                if (hours <= 0 && minutes > 0)
                    result = Math.abs(minutes) + " دقيقة "
            }
            // console.log(result)
            if (result == "") {
                if (years == 0 && months == 0) {
                    if (days <= -5)
                        return "انتهى وقت التفكير"
                    else
                        return "بقي " + (5 + days) + " أيام لاتخاذ القرار";
                }
            } else
                return result
        },
        getDateStatus: function (d, h, m) {
            var today = new Date()
            var tmp = new Date(d)

            // Results
            var years = tmp.getFullYear() - today.getFullYear()
            var months = (tmp.getMonth() + 1) - (today.getMonth() + 1)
            var days = tmp.getDate() - today.getDate()
            var hours = h - today.getHours()
            var minutes = m - today.getMinutes()
            var result = ""
            if (years > 0)
                result += years + " سنة "
            if (months > 0)
                result += months + " شهر "
            if (days > 0)
                result += days + " يوم "
            if (years <= 0 && months <= 0 && days == 0) {
                if (hours > 0) {
                    if (minutes < 0) {
                        hours--
                        minutes = (60 - Math.abs(minutes))
                    }
                    result = hours + " ساعة "
                    result += minutes + " دقيقة "
                }
                if (hours <= 0 && minutes > 0)
                    result = Math.abs(minutes) + " دقيقة "
            }
            // console.log(result)
            if (result == "") {
                return -1
            } else
                return result
        },
        cancelMeeting: function (d) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تستطيع التراجع عن الحذف بعد التأكيد",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("/api/cancel-request", {
                        id: d
                    })
                        .then((res) => {
                            this.requests = []
                            this.users = []
                            Swal.fire(
                                'تهانينا!',
                                'تم إلغاء المقابلة بنجاح.',
                                'success'
                            )
                            var userId = document.querySelector("meta[name='user-id']").getAttribute('content')
                            this.auth_user_id = userId
                            axios.get('/api/get-active-requests/' + userId)
                                .then((res) => {
                                    var i = 0
                                    for (i; i < res.data.length; i++) {
                                        this.requests.push(res.data[i].request)
                                        this.users.push(res.data[i].user)
                                        this.requestDate.push(res.data[i].requestDate)
                                    }
                                    // console.log(this.reqDate)
                                })
                        })
                }
            })
        },
        changeReason: function (r) {
            if (r == 'other') {
                this.showOther = true
                return
            } else
                this.showOther = false
            this.rejectReason = r
        },
        sendReject: function (d) {
            if (this.rejectReason == '') {
                this.empty.reject = true
                return
            } else
                this.empty.reject = false
        },
        getDates: function (id) {
            this.showSelectDateModal = true
            this.request_id = id
            axios.get("/api/get-dates/" + id)
                .then((res) => {
                    this.dates = res.data
                })
        },
        selectDate: function (d) {
            this.selected = d
        },
        sendDate: function () {
            let type = this.selected != null ? "id" : "month"
            axios.post("/api/select-date", {
                id: this.selected,
                type: type,
                month: this.selectedMonth,
                request_id : this.request_id
            })
                .then((res) => {
                    if(res.data == 1) {
                        Swal.fire(
                            'تهانينا!',
                            'تم تحديد موعد المقابلة',
                            'success'
                        )
                        setTimeout(function(){
                            window.location.href = "/active-requests"
                        },1000);
                    }
                })
            this.showSelectDateModal = false
            this.selected = null
            this.selectedMonth = ""
            this.request_id = ""
        }
    },
}
</script>

<style>
.modal-lg {
    max-width: 800px !important;
}
</style>

