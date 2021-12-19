<template>
    <div class="card">
        <div class="card-header" style="text-align: center;" id="SearchDivBtn"
             @click="searchBox = !searchBox">
            <router-link to="/search" style="color: #555;">
                <i class="fa fa-search"></i>
                بحث جديد
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            searchBox: false,
        }
    },
}
</script>
