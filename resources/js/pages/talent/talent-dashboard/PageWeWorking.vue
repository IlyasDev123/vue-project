<template>
  <div v-show="isResetSearch">
    <button class="red__btnOutline under__buttons" @click="resetSearch">
      Reset search
    </button>
  </div>
  <div v-show="jobData" class="we__working__on_it d__flex d__flex-v-center">
    <NewJobMatch />
  </div>
  <div v-show="!jobData" class="CVSLider drag__slider">
    <swiper
      :effect="'cards'"
      :grabCursor="false"
      :modules="modules"
      class="mySwiper"
      @swiper="onSwiper"
      @slideChange="onSlideChange"
    >
      <template v-for="job in jobs" :key="job.id">
        <swiper-slide>
          <UnpaidEmployerCv :jobDetail="job" />
        </swiper-slide>
      </template>
    </swiper>
    <!-- <CVBlock /> -->
    <div class="two__btns_wrapper">
      <button @click="passPortfolio" class="red__btnOutline under__buttons">
        PASS
      </button>
      <button @click="matchPortfolio" class="blue__bg-btn under__buttons">
        MATCH
      </button>
    </div>
  </div>
</template>
<script>
import NewJobMatch from "@/components/NewJobMatch.vue";
import CVBlock from "@/components/CVBlock.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/effect-cards";
import { EffectCards } from "swiper";
import talentService from "../../../Services/talentService";
import companyService from "../../../Services/companyService";
import UnpaidEmployerCv from "../../../components/Cvs/UnpaidEmployerCv.vue";
export default {
  name: "PgeWeWorking",
  components: {
    CVBlock,
    NewJobMatch,
    Swiper,
    SwiperSlide,
    UnpaidEmployerCv,
  },
  setup() {
    return {
      modules: [EffectCards],
    };
  },
  data() {
    return {
      jobData: true,
      jobs: [],
      activeSlideIndex: 0,
      currentJob: {},
      status: "",
      isResetSearch: false,
      data: {
        matchId: null,
      },
    };
  },
  beforeRouteUpdate(to, from, next) {
    if (Object.keys(to.query).length !== 0) {
      this.getAllJobList(to.query.search);
      this.isResetSearch = true;
      next();
    } else {
      this.isResetSearch = false;
      next();
    }
  },
  created() {
    this.getAllJobList();
  },
  methods: {
    onSlideChange(swiper) {
      this.currentJob = this.jobs[swiper.activeIndex];
      this.data.matchId = this.currentJob.match_portfolio?.id;
    },
    getAllJobList(search) {
      talentService
        .getJobList({ searchItem: search })
        .then((response) => {
          if (response.data.data.length > 0) {
            this.jobs = response.data.data;
            this.jobData = false;
            this.currentJob = this.jobs[0];
            this.data.matchId = this.currentJob.match_portfolio?.id;
          } else {
            this.jobData = true;
            this.jobs = [];
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
          this.$toast.success("Profile Passed");
          this.getAllJobList();
        })
        .catch((error) => {
          this.$toast.error(error.response.data.message);
        });
    },
    matchPortfolio() {
      companyService
        .matchPortfolio(this.data)
        .then((data) => {
          this.$toast.success("Profile Matched");
          this.getAllJobList();
        })
        .catch((error) => {
          this.$toast.error(error.response.data.message);
        });
    },

    resetSearch() {
      this.$router.push({
        name: "NewJobMatch",
      });
      this.isResetSearch = false;
      this.getAllJobList();
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
