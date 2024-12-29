<template>
    <div class="d__flex d__flex-h-between d__flex-v-center" style="width: 100%;">
        <h3>Edit Employer Details</h3>
    </div>
    <div class="add__member">
        <ViewUserForm :userType="this.$constants.EMPLOYER" />
    </div>
</template>

<script>
import ViewUserForm from "@/components/ViewUserForm.vue";

export default {
    components: {
        ViewUserForm,
    },
};
</script>

<style lang="scss" scoped></style>
