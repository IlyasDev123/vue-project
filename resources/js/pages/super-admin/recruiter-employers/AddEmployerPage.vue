<template>
    <div class="d__flex d__flex-h-between d__flex-v-center">
        <ComponentTitle pageTitle="Add New Employer" />                                 
    </div>

    <div class="add__member">

        <CreateUserForm createBtn="Create Employee"/>

    </div>
</template>

<script>
import CreateUserForm from '@/components/CreateUserForm.vue'
import ComponentTitle from '@/components/ComponentTitle.vue'

    export default {
        components:{
            CreateUserForm,
            ComponentTitle
        }
    }
</script>

<style lang="css" scoped>

</style>