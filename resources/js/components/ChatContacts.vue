<template>
    <div>
        <button class="btn btn-primary d-none show-contacts-btn" @click="contactsModel=true">
            جهات الاتصال
        </button>
        <div class="inbox_people" style="float: right;width: 30%">
            <div class="inbox_chat">
                <div class="chat_list" v-for="contact in sortedContacts" :key="contact.id"
                     @click="selectContact(contact)" :class="{active_chat:contact===selected}">
                    <div class="chat_people">
                        <div class="chat_img" style="float:right">
                            <img v-if="contact.image" :src="'/storage/images/' + contact.image" style="border-radius: 50%">
                            <img v-else-if="contact.avatar" :src="'/assets/img/Icon/' + contact.avatar + '.jpg'" style="border-radius: 50%">
                        </div>
                        <div class="chat_ib" style="text-align:right">
                            <h5 class="mr-2">
                                {{ contact.name }}
                                <span class="unread-count" style="float:left" v-if="contact.unread">{{ contact.unread }}</span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <Modal v-model="contactsModel" title="جهات الاتصال">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="inbox_people mobile-contacts" style="float: right;width: 30%">
                                <div class="inbox_chat">
                                    <div class="chat_list" v-for="contact in sortedContacts" :key="contact.id"
                                         @click="selectContact(contact),contactsModel=false" :class="{active_chat:contact===selected}">
                                        <div class="chat_people">
                                            <div class="chat_img" style="float:right">
                                                <img v-if="contact.image" :src="'/storage/images/' + contact.image" style="border-radius: 50%">
                                                <img v-else-if="contact.avatar" :src="'/assets/img/Icon/' + contact.avatar + '.jpg'" style="border-radius: 50%">
                                            </div>
                                            <div class="chat_ib" style="text-align:right">
                                                <h5 class="mr-2">
                                                    {{ contact.name }}
                                                    <span class="unread-count" style="float:left" v-if="contact.unread">{{ contact.unread }}</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Modal>
        </div>
    </div>
</template>
<style>
.mobile-contacts {
    width: 100% !important;
}
.chat_list {
    cursor: pointer;
}
.unread-count {
    float: left;
    width: 18px;
    height: 18px;
    background: #ea4545;
    text-align: center;
    color: white;
    border-radius: 4px;
}
</style>
<script>
export default {
    props: ['contacts'],
    computed: {
      sortedContacts() {
          return _.sortBy(this.contacts, [(contact) => {
              if(contact == this.selected) {
                  return Infinity;
              }
              return contact.unread;
          }]).reverse();
      }
    },
    data: function () {
        return {
            selected: 0,
            contactsModel: false
        }
    },
    methods: {
        selectContact: function (contact) {
            this.selected = contact
            this.$emit('selected',contact)
        }
    }
}
</script>
