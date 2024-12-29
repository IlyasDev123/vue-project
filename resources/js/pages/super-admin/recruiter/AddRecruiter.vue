<template>
    <div class="d__flex d__flex-h-between d__flex-v-center">
        <h3>Add New Recruiter</h3>
    </div>

    <div class="add__member">
        <CreateUserForm :userType="this.$constants.RECURITER" createBtn="Create Recruiter" />
    </div>
</template>

<script>
import CreateUserForm from "@/components/CreateUserForm.vue";

export default {
    components: {
        CreateUserForm,
    },
};
</script>

<style lang="scss" scoped></style>
