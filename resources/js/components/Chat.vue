<template>
    <section class="about-creative-section large-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="content" class="content content-full-width">
                        <!-- begin profile -->
                        <profile-header :user="user" :auth_user_id="auth_user_id"
                                        :un_read_messages="un_read_messages" :activated="activated"></profile-header>
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
                                    <div class="messaging">
                                        <div class="inbox_msg">
                                            <chat-contacts :contacts="contacts"
                                                           @selected="startConversationWith"></chat-contacts>
                                            <chat-conversation :user="user"
                                                               :selectedContact="selectedContact"
                                                               :messages="messages"
                                                               @send="sendMessage"
                                                               ref="feed"
                                            ></chat-conversation>
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
.msg_send_btn {
    right: unset;
    left: 0;
}

.sent_msg {
    float: left;
    width: 50%;
}

.received_msg {
    display: inline-block;
    padding: 0 0 0 10px;
    vertical-align: top;
    width: 92%;
}

.received_withd_msg {
    width: 57%;
}

.time_date {
    color: #747474;
    display: block;
    font-size: 12px;
    margin: 8px 0 0;
}

.mesgs {
    text-align: right;
}
@media (max-width: 576px) {
    .inbox_msg .inbox_people {
        display: none;
    }
    .mesgs {
        width: 100% !important;
    }
    .show-contacts-btn {
        display: block !important;
    }
}
</style>

<script>
import ProfileHeader from "./ProfileHeader";
import SearchBox from "./SearchBox";
import ChatContacts from "./ChatContacts";
import ChatConversation from "./ChatConversation";
import AccountStatus from "./partials/accountStatus"

export default {
    props: ['user', 'auth_user_id', 'complete', 'activated', 'un_read_messages'],
    components: {ProfileHeader, SearchBox, ChatContacts, ChatConversation, AccountStatus},
    mounted() {
        Echo.private(`chat.${authUser.id}`)
            .listen('MessageSend', (e) => {
                // console.log(e.message.message);
                if(this.selectedContact && e.message.from_id == this.selectedContact.id) {
                    this.messages.push(
                        {
                            message: e.message.message,
                            from_id: e.message.from_id,
                            to_id: e.message.to_id,
                            created_at: e.message.created_at
                        }
                    )
                    this.getNewMessages()
                    this.scrollToBottom()
                    return
                }
                this.updateUnreadCount(e.message.from_contact, false);
                // console.log(this.messages)
            })
            .listen('MessageRead', (e) => {
                let messages = this.messages
                for(let i=0;i<messages.length;++i) {
                    if(messages[i].id == e.message.id) {
                        messages[i].seen = 1
                        console.log(messages[i])
                    }
                }
            });

        let userId = document.querySelector("meta[name='user-id']").getAttribute('content')
        axios.get('/api/get-contacts/' + userId)
            .then((res) => {
                this.loaded = true
                this.contacts = res.data
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            contacts: [],
            messages: [],
            selectedContact: null,
            loaded: false
        }
    },
    methods: {
        scrollToBottom: function () {
            setTimeout(() => {
                var area = document.getElementById('feed')
                area.scrollTop = area.scrollHeight - area.clientHeight
            }, 100);
        },
        startConversationWith: function (contact) {
            this.updateUnreadCount(contact, true);
            var myId = this.user.id
            axios.get('/api/get-conversation/' + contact.id + '/' + myId)
                .then((res) => {
                    this.messages = res.data
                    this.selectedContact = contact
                    this.scrollToBottom()
                })
        },
        sendMessage: function (data) {
            axios.post('/api/save-message', {
                message: data[0],
                from_id: data[1],
                to_id: data[2]
            })
                .then((res) => {
                    this.scrollToBottom();
                    this.messages.push(res.data)
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        getNewMessages: function () {
            if (this.selectedContact != null && this.$route.path == '/chat') {
                axios.get('/api/get-conversation/' + this.selectedContact.id + '/' + this.user.id)
                    .then((res) => {
                        if (res.data.length > this.messages.length) {
                            this.scrollToBottom()
                            this.messages = res.data
                        }
                    })
            }
        },
        updateUnreadCount: function (contact, reset) {
            this.contacts = this.contacts.map((single) => {
                if(single.id != contact.id) {
                    return single;
                }
                if(reset)
                    single.unread = 0;
                else
                    single.unread += 1;
                return single;
            })
        },
    }
}
</script>
