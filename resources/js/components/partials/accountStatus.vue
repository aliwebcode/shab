<template>
    <div class="account-status-area">
        <div v-if="!user.is_verify && auth_user_id == user.id" class="alert alert-danger" role="alert"
             style="text-align:right">
            <i class="fa fa-times-circle"></i>يرجى تأكيد بريدك الالكتروني
            <form class="d-inline" method="POST" action="">
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                    إرسال الرمز مجدداً
                </button>
                .
            </form>
        </div>

        <div v-if="!complete" class="alert alert-warning" role="alert" style="text-align:right">
            <i class="fa fa-info-circle"></i> بياناتك غير مكتملة
            <router-link to="/profile/complete">أكمل ملفك الشخصي</router-link>
            .
        </div>

        <div v-if="activated == -1" class="alert alert-danger" role="alert" style="text-align:right">
            <i class="fa fa-info-circle"></i> تم رفض توثيق الحساب
            <router-link to="/profile/activate">أرسل توثيق جديد</router-link>
            .
        </div>
        <div v-if="activated == 'n'" class="alert alert-warning" role="alert" style="text-align:right">
            <i class="fa fa-info-circle"></i> حسابك غير موثق
            <router-link to="/profile/activate">قم بتوثيق حسابك الان</router-link>
            .
        </div>
    </div>
</template>

<script>
export default {
    props: ['user', 'auth_user_id', 'complete', 'activated', 'un_read_messages'],
    name: "accountStatus"
}
</script>

<style scoped>

</style>
