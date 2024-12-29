<template>
    <div v-show="isResetSearch">
        <button class="red__btnOutline under__buttons" @click="resetSearch">
            Reset search
        </button>
    </div>
    <div
        v-show="talents?.length == 0"
        class="we__working__on_it d__flex d__flex-v-center"
    >
        <NewJobMatch />
    </div>
    <div v-show="talents?.length > 0" class="CVSLider drag__slider">
        <swiper
            :effect="'cards'"
            :grabCursor="false"
            :modules="modules"
            class="mySwiper"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
        >
            <template v-if="authUserStatus == 2">
                <template v-for="talent in talents" :key="talent.id">
                    <swiper-slide>
                        <CVBlock :talent="talent" />
                    </swiper-slide>
                </template>
            </template>
            <template v-else-if="authUserStatus == 1 || authUserStatus == 3">
                <template v-for="talent in talents" :key="talent.id">
                    <swiper-slide>
                        <UnpaidTalentCv :talent="talent" />
                    </swiper-slide>
                </template>
            </template>
        </swiper>
        <div class="two__btns_wrapper">
            <button
                @click="passPortfolio"
                class="red__btnOutline under__buttons"
            >
                PASS
            </button>
            <button @click="matchPortfolio" class="blue__bg-btn under__buttons">
                MATCH
            </button>
        </div>
    </div>
</template>
<script>
import userService from "../../../Services/userService";
import NewJobMatch from "@/components/NewJobMatch.vue";
import CVBlock from "@/components/CVBlock.vue";
import UnpaidTalentCv from "@/components/Cvs/UnpaidTalentCv.vue";
import companyService from "../../../Services/companyService";
import { Swiper, SwiperSlide, useSwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/effect-cards";
import { EffectCards } from "swiper";
export default {
    name: "PgeWeWorking",
    components: {
        CVBlock,
        NewJobMatch,
        Swiper,
        SwiperSlide,
        EffectCards,
        UnpaidTalentCv,
    },
    setup() {
        return {
            modules: [EffectCards],
        };
    },
    data() {
        return {
            authUserStatus: "",
            jobData: true,
            talents: [],
            activeSlideIndex: 0,
            currentTalent: {},
            isResetSearch: false,
            data: {
                matchId: null,
            },
        };
    },
    created() {
        this.getAllTalentList();
        this.getProfile();
    },
    mounted() {
        if (this.$route.query.search != undefined) {
            this.getAllTalentList(this.$route.query.search);
            this.isResetSearch = true;
        } else {
            this.$emitter.on("newMatchTalent", (search) => {
                this.getAllTalentList(search);
                this.isResetSearch = true;
            });
        }
    },
    methods: {
        // onSwiper(swiper) {
        //   console.log("this is test *******************************", swiper);
        // },
        getProfile() {
            userService
                .getProfile()
                .then((data) => {
                    if (data.data.status == true) {
                        this.authUserStatus =
                            data.data.data.company_meta.premium_status;
                    }
                })
                .catch((error) => {
                    this.$toast.error(error);
                });
        },
        onSlideChange(swiper) {
            this.currentTalent = this.talents[swiper.activeIndex];
            this.data.matchId = this.currentTalent.matches?.id;
        },

        getAllTalentList(search) {
            companyService
                .getAllTalentList({ searchItem: search })
                .then((response) => {
                    if (response.data.data.length > 0) {
                        this.jobData = false;
                        this.talents = response.data.data;
                        console.log("talents::::::", this.talents);
                        this.currentTalent = this.talents[0];
                        this.data.matchId = this.currentTalent.matches.id;
                    } else {
                        this.talents = [];
                    }
                })
                .catch((error) => {
                    this.jobData = true;
                    this.$toast.error(error.response.data.message);
                });
        },

        passPortfolio() {
            companyService
                .passPortfolio(this.data)
                .then((data) => {
                    if (data.data.status == true) {
                        this.$toast.success("Profile Passed");
                        this.getAllTalentList();
                    }
                })
                .catch((error) => {
                    this.$toast.error(error.response.data.message);
                });
        },

        matchPortfolio() {
            companyService
                .matchPortfolio(this.data)
                .then((data) => {
                    if (data.data.status == true) {
                        this.$toast.success("Profile Matched");
                        this.getAllTalentList();
                    }
                })
                .catch((error) => {
                    this.$toast.error(error.response.data.message);
                });
        },

        resetSearch() {
            this.$router.push({
                name: "NewTalentMatch",
            });
            this.getAllTalentList();
            this.isResetSearch = false;
        },
    },
};
</script>
<style>
.under__buttons {
    padding: 12px 42px;
    border-radius: 5px;
    font-family: roboto;
    font-size: 16px;
    line-height: 20px;
    text-align: center;
    display: inline-block;
    background: none;
    border: none;
    transition: all 0.4s ease;
}
.red__btnOutline {
    border: 1px solid #e75c2a;
    color: #e75c2a;
}
.red__btnOutline:hover {
    background: #e75c2a;
    color: #fff;
}
.blue__bg-btn {
    color: #fff;
    border: 1px solid #4294ff;
    background: #4294ff;
}
.blue__bg-btn:hover {
    background-color: transparent;
    color: #4294ff;
}
.two__btns_wrapper {
    text-align: center;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}
</style>
