<template>
        <div class="top__logo">
            <router-link :to="{name:'Login'}">
                <img src="@/assets/images/talent-images/small__logo.svg" alt="small_logo">
            </router-link>
        </div>
</template>
<script>
    export default {
        name: 'SignUpHeader'
    }
</script>