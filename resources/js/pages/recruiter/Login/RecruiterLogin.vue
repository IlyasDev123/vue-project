<script>
import Login from "../../../components/Login/Login.vue";

export default {
    name: "RecruiterLogin",
    components: {
        Login,
    },
};
</script>
<template>
    <!-- <h1>hiii</h1> -->
    <Login :isRecruiter="true" />
</template>
