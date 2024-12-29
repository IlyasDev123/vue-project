<script>
import Login from "../../../components/Login/Login.vue";

export default {
    name: "AdminLogin",
    components: {
        Login,
    },
};
</script>
<template>
    <Login :isAdmin="true" />
</template>
