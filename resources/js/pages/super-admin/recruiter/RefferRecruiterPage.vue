<template>
    
    <div class="reffer__members-box">
        <div class="avatar__upload m__auto"> 
            <div class="avatar__preview">
                <div id="imagePreview" :style="{ backgroundImage: 'url(' + $public + '' + referedTalents?.avatar + ')'}"></div>
            </div>
        </div>
        <h3>{{this.referedTalents?.first_name}} {{this.referedTalents?.last_name}}</h3>
        <span></span>     
    </div>
    
    <div class="recruiters__tab d__flex d__flex-h-between">
        <button class="recruiters__tab-btn" :class="{active: isActive1}" @click="tab1">Refer Talents ({{ this.referedTalentCount }})</button>
        <button class="recruiters__tab-btn" :class="{active: isActive2}" @click="tab2">Refer Employers ({{ this.referedEmployerCount }})</button>
    </div>

    <div class="refer__post">

        <template v-if="refferTalent">
            <template v-for="referedTalent in referedTalents?.refers" :key="referedTalent.id">
                <CardBlock 
                    :referedTalent="referedTalent"
                    :userType="this.$constants.TALENT"
                    :routeName="TalentDetail"
                    :routeTitle="`View Profile`"
                    :routeId="referedTalent?.talent?.id"
                /> 
            </template>
        </template>
        <template v-if="refferEmployer">
            <template v-for="referedEmployer in referedEmployers?.refers" :key="referedEmployer.id">
                <CardBlock 
                    :referedTalent="referedEmployer"
                    :userType="this.$constants.EMPLOYER"
                    :routeName="positionDetail"
                    :routeTitle="`View Profile`"
                    :routeId="referedEmployer?.company?.id"
                /> 
            </template>
        </template>
        
        <div class="refer__post-btn">
            <router-link :to="{name:'DetailRecruiterPage', params: { id: this.$route.params.id },}" class="refer__post-btn-back">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.56635 5.58328L5.69535 8.71228L4.87052 9.53711L0.333355 4.99994L4.87052 0.462776L5.69536 1.28761L2.56635 4.41661L9.66669 4.41661L9.66669 5.58328L2.56635 5.58328Z" fill="#304254"/>
                </svg>                                            
                <span>Go Back</span>
            </router-link>
        </div>

    </div>

</template>

<script>
    import CardBlock from '../../../components/CardBlock.vue';
    import userService from '../../../Services/userService';
    export default {
        components:{
            CardBlock,
        },
        mounted() {
            this.getTalentReffered(this.$route.params.id);
            this.getEmployersReffered(this.$route.params.id);
        },
        data(){
            return{
                refferTalent:true,
                refferEmployer:false,
                isActive1:true,
                isActive2:false,
                referedTalentCount : 0,
                referedEmployerCount : 0,
                referedTalents : [],
                referedEmployers : []
            }           
        },
        methods:{
            tab1(){
                this.refferTalent = true;
                this.refferEmployer = false;
                this.isActive1 = true;
                this.isActive2 = false;
            },
            tab2(){
                this.refferTalent = false;
                this.refferEmployer = true;
                this.isActive1 = false;
                this.isActive2 = true;
            },
            async getTalentReffered(id) {
                await userService
                .getTalentReffered(id).then((response) => {
                    if (response.data.status != true) {
                        this.$toast.error(response.data.message);
                    } else {
                        this.referedTalents = response.data.data.talent;
                        this.referedTalentCount = response.data.data.count;
                    }
                })
                .catch((error) => {
                    return this.$toast.error(error.response.data.message);
                });
            },
            async getEmployersReffered(id) {
                await userService
                .getEmployersReffered(id).then((response) => {
                    if (response.data.status != true) {
                        this.$toast.error(response.data.message);
                    } else {
                        this.referedEmployers = response.data.data.employer;
                        this.referedEmployerCount = response.data.data.count;
                    }
                })
                .catch((error) => {
                    return this.$toast.error(error.response.data.message);
                });
            },
        }       
    }
</script>

<style lang="css" scoped>
    .recruiters__tab{
        margin-top: 30px;
    }
    .recruiters__tab-btn{
        width: 50%;
        border: 0px;
        font-family: 'Roboto';
        font-style: normal;
        font-weight: 600;
        font-size: 16px;
        line-height: 22px;
        background-color: transparent;
        border-bottom: 2px solid rgba(0, 0, 0, 0.1);
        padding: 10px;
        margin: 10px 0;
        transition: 0.2s all linear;
        color: #8B8D98;
    }
    .recruiters__tab-btn.active,
    .recruiters__tab-btn:hover{
        
        color:#4294FF;
        border-color: #4294FF;
    }
</style>