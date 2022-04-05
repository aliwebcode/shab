<template>
    <div class="mesgs" style="width: 70%" v-if="selectedContact">
        <div class="msg_history" id="feed">
            <div v-for="message in messages">
                <div v-if="message.from_id === selectedContact.id">
                    <div class="incoming_msg">
                        <div class="incoming_msg_img">
                            <a :href="'/user/' + selectedContact.id">
                                <img v-if="selectedContact.image" :src="'/storage/images/' + selectedContact.image" style="border-radius: 50%">
                                <img v-else-if="selectedContact.avatar" :src="'/assets/img/Icon/' + selectedContact.avatar + '.jpg'" style="border-radius: 50%">
                            </a>
                        </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>
                                    {{ message.message }}
                                </p>
                                <span class="time_date" dir="ltr">
                                    {{ message.time }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>
                                {{ message.message }}
                            </p>
                            <span class="time_date" dir="ltr">
                                <i class="fa fa-check" style="color: #555;" v-if="message.seen"></i>
                                {{ message.time }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="type_msg">
            <div class="input_msg_write">
                <textarea placeholder="اكتب رسالتك"
                          class="msg_area"
                          rows="10"
                          v-model="message"
                          @keyup.enter="sendMessage(user.id,selectedContact.id)"
                          required></textarea>
                <button class="msg_send_btn" style="float:left" type="button" @click="sendMessage(user.id,selectedContact.id)">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
    <div v-else class="row" style="height: 500px">
        <div class="col-12 text-center" style="margin: auto">
            <img src="/assets/img/people.svg" style="width: 400px;">
            <h4 style="color: #444" class="mt-5">ابدأ محادثاتك الان</h4>
        </div>
    </div>
</template>
<style>
.input_msg_write {
    display: flex;
    align-items: center;
}

textarea.msg_area {
    background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px;
    color: rgb(76, 76, 76);
    font-size: 15px;
    min-height: 48px;
    width: 100%;
    height: 89px;
    border: 1px solid #ccc;
    margin: 5px;
    padding: 10px;
}

button.msg_send_btn {
    position: static;
}
</style>
<script>
export default {
    props: ['selectedContact', 'messages', 'user'],
    data: function () {
        return {
            message: "",
            checkAll: false
        }
    },
    methods: {
        getDate: function (d) {
            let date = new Date(d)
            let res = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes()
            return res
        },
        sendMessage: function (myId,userId) {
            this.$emit('send',[this.message,myId,userId])
            this.message = ""
        },
    }
}
</script>
