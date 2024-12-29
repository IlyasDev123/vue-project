<template>
    <div class="working__mainWrapper">
        <div class="img__wrapper text__center">
            <img src="@/assets/images/talent-images/shaking__hand.svg" alt="shaking__hand">
        </div>
        <h1 class="text__center fw__700">Welcome Back!</h1>
        <p class="text__center">
            Are you experienced across multiple roles and industries? so, please add new you’re interested by answering few questions below!
        </p>
        <router-link :to="{name: 'RoleIndustry'}" class="big__blue__btn">
            Add Skill
        </router-link>
    </div>
</template>
<script>
    export default {
        name: 'WelcomeBack'
    }
</script>