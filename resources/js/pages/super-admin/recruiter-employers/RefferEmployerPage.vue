<template>
    
    <div class="reffer__members-box">
        <div class="avatar__upload m__auto">
            <div class="avatar__preview">
                <div id="imagePreview" :style="{ backgroundImage: 'url(' + this.$public + 'person-placeholder.jpg' + ')' }"></div>
            </div>
        </div>
        <h3>Albert Michaels</h3>
        <span>Chirrrp</span>

        <SearchBox />
        
    </div>

    <div class="refer__post">

        <CardBlock />
        
        <div class="refer__post-btn">
            <router-link :to="{name:'EmployersPage'}" class="refer__post-btn-back">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.56635 5.58328L5.69535 8.71228L4.87052 9.53711L0.333355 4.99994L4.87052 0.462776L5.69536 1.28761L2.56635 4.41661L9.66669 4.41661L9.66669 5.58328L2.56635 5.58328Z" fill="#304254"/>
                </svg>                                            
                <span>Go Back</span>
            </router-link>
        </div>

    </div>

</template>

<script>
import CardBlock from '@/components/CardBlock.vue';
import SearchBox from '@/components/SearchBox.vue';

    export default {
        components:{
            CardBlock,
            SearchBox
        }
    }
</script>

<style lang="scss" scoped>

</style>