<template>
    <div class="d__flex d__flex-h-between d__flex-v-center">
        <h3>Add New Talent</h3>                                  
    </div>

    <div class="add__member">
        <CreateUserForm />
    </div>
    
</template>

<script>

import CreateUserForm from '@/components/CreateUserForm.vue'

    export default {
        components:{
            CreateUserForm
        }
    }
</script>

<style lang="scss" scoped>

</style>