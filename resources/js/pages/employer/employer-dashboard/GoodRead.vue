<template>
    <div class="post__box d__flex-d-col">
        <ViewPost />
        <ViewPost />
        <ViewPost />
        <ViewPost />
    </div>
</template>

<script>
import ViewPost from '@/components/ViewPost.vue';
    export default {
        name:"GoodRead",
        components:{
            ViewPost
        }
    }
</script>

<style lang="scss" scoped>

</style>