<template>
    <!-- <div v-if="referedTalent" class="refer__post-box"></div> -->
    <div class="refer__post-box">
        <div
            class="refer__post-box-img"
            v-if="this.cvType == this.$constants.TALENT"
        >
            <TalentCvBlock :talent="this.referedTalent" />
        </div>
        <div
            class="refer__post-box-img"
            v-if="this.cvType == this.$constants.EMPLOYER"
        >
            <EmployerCvBlock :company="this.company" />
        </div>
        <div
            class="refer__post-box-info d__flex d__flex-h-between d__flex-v-center"
        >
            <div
                class="refer__post-box-info-inner d__flex d__flex-h-between d__flex-v-center"
                v-if="this.cvType == this.$constants.TALENT"
            >
                <img :src="$public + referedTalent?.avatar" alt="" />
                <div class="d__flex d__flex-d-col d__flex-h-center">
                    <h5>
                        {{
                            referedTalent?.first_name
                                ? referedTalent?.first_name
                                : company?.first_name
                        }}
                        {{ " " }}{{ referedTalent?.last_name }}
                    </h5>
                    <span>{{ referedTalent?.skills?.profession?.name }}</span>
                </div>
            </div>
            <div
                class="refer__post-box-info-inner d__flex d__flex-h-between d__flex-v-center"
                v-if="this.cvType == this.$constants.EMPLOYER"
            >
                <img :src="$public + company?.company?.avatar" alt="" />
                <div class="d__flex d__flex-d-col d__flex-h-center">
                    <h5>
                        {{ company?.company?.company_meta?.company_name }}
                    </h5>
                    <span>{{ company?.profession?.name }}</span>
                </div>
            </div>
            <router-link
                :to="{
                    name: routeName,
                    params: { id: this.routeId },
                }"
                class="refer__post-box-info-link"
                >{{ routeTitle }}</router-link
            >
        </div>
    </div>
</template>

<script>
import TalentCvBlock from "../Cvs/TalentCvBlock.vue";
import EmployerCvBlock from "../Cvs/EmployerCvBlock.vue";
export default {
    name: "Listing",
    components: {
        TalentCvBlock,
        EmployerCvBlock,
    },
    props: {
        CardInfo: Object,
        referedTalent: Object,
        company: Object,
        cvType: Number,
        routeName: String,
        routeTitle: String,
        routeId: Number,
    },
    data() {
        return { image: "@/assets/img/user-post-2.png" };
    },
};
</script>

<style lang="scss" scoped></style>
