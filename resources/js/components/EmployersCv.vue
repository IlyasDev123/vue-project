<template>
  <div class="main__content-box matches__content-box">
    <div class="d__flex d__flex-h-between d__flex-v-center match__title">
      <ComponentTitle pageTitle="All Employers" />
    </div>

    <div class="search__box match__search">
      <button class="match_serach-btn" @click="onKeyPress">
        <svg
          width="18"
          height="18"
          viewBox="0 0 18 18"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M12.5 11H11.71L11.43 10.73C12.41 9.59 13 8.11 13 6.5C13 2.91 10.09 0 6.5 0C2.91 0 0 2.91 0 6.5C0 10.09 2.91 13 6.5 13C8.11 13 9.59 12.41 10.73 11.43L11 11.71V12.5L16 17.49L17.49 16L12.5 11ZM6.5 11C4.01 11 2 8.99 2 6.5C2 4.01 4.01 2 6.5 2C8.99 2 11 4.01 11 6.5C11 8.99 8.99 11 6.5 11Z"
            fill="#B1BBCD"
          />
        </svg>
      </button>

      <input
        type="text"
        placeholder="Search"
        v-model="searching"
        v-on:keypress.enter="onKeyPress"
      />
    </div>

    <div class="all__members drag__slider">
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
            <PaidEmployerCv :jobDetail="job" />
          </swiper-slide>
        </template>
      </swiper>
    </div>

    <div
      class="matches__btn d__flex d__flex-h-between"
      v-show="jobs.length > 0"
    >
      <button
        class="primary__btn btn user__popup-btn"
        @click="onSubmit"
        :disabled="talentIds == null"
      >
        Refer to Talent
      </button>
      <div class="primary__btn btn user__popup-btn" v-show="isLoader">
        <img src="@/assets/img/loader.gif" width="30" height="30" />
      </div>
      <button class="secondary__btn btn" @click="viewDetail">
        View Company Detail
      </button>
    </div>

    <!-- User Detail Popup -->
    <div class="user__popup visible" v-show="showViewDetail">
      <div class="user__popup-content">
        <h3 style="margin-top: 20px">Employer Detail</h3>
        <div class="avatar__upload m__auto">
          <div class="avatar__preview">
            <div
              id="imagePreview"
              :style="{
                backgroundImage:
                  'url(' + this.$public + '' + currentJob?.avatar + ')',
              }"
            ></div>
          </div>
        </div>

        <div class="employee__form d__flex d__flex-h-between m__auto">
          <div class="form__group">
            <input
              type="text"
              class="form__field"
              :value="currentJob?.first_name"
              placeholder="First Name"
              alt="First Name"
              readonly
            />
          </div>
          <div class="form__group">
            <input
              type="text"
              class="form__field"
              :value="currentJob?.last_name"
              placeholder="Last Name"
              alt="Last Name"
              readonly
            />
          </div>
          <div class="form__group">
            <input
              type="email"
              class="form__field"
              :value="currentJob?.email"
              placeholder="Email Address"
              alt="Email"
              readonly
            />
          </div>
          <div class="form__group">
            <input
              type="tel"
              class="form__field"
              :value="currentJob?.phone_number"
              placeholder="Phone Number"
              alt="Phone Number"
              readonly
            />
          </div>
          <div class="form__group full__group">
            <input
              type="text"
              class="form__field"
              :value="currentJob?.current_role"
              placeholder="Fontend Developer"
              alt="Fontend Developer"
              readonly
            />
          </div>

          <div class="form__btn--back">
            <button class="back__btn" @click="hideViewDetail">
              <svg
                width="10"
                height="10"
                viewBox="0 0 10 10"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M2.56642 5.58328L5.69542 8.71228L4.87058 9.53711L0.333416 4.99994L4.87058 0.462776L5.69542 1.28761L2.56642 4.41661L9.66675 4.41661L9.66675 5.58328L2.56642 5.58328Z"
                  fill="#304254"
                />
              </svg>
              <span>Go Back</span>
            </button>
          </div>
          <!-- <div class="form__btn--create">
            <router-link :to="{ name: 'MatchRefferPage' }" class="create__btn">
              <button>
                <span>Reffer/ View Talent</span>
              </button>
            </router-link>
          </div>
          <div class="form__btn--block">
            <button class="delete__btn">
              <span>Block User</span>
            </button>
          </div> -->
        </div>
      </div>
      <div class="user__popup-overlay" @click="hideViewDetail"></div>
    </div>
  </div>
</template>

<script>
import ComponentTitle from "../components/ComponentTitle.vue";
import PaidEmployerCv from "../components/Cvs/PaidEmployerCv.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/effect-cards";
import { EffectCards } from "swiper";
import SearchBox from "./SearchBox.vue";
import ReferService from "@/Services/referService";

export default {
  name: "EmployersCv",
  components: {
    PaidEmployerCv,
    ComponentTitle,
    Swiper,
    SwiperSlide,
    SearchBox,
  },
  setup() {
    return {
      modules: [EffectCards],
    };
  },

  data() {
    return {
      showViewDetail: false,
      jobs: [],
      activeSlideIndex: 0,
      currentJob: [],
      talentIds: null,
      isDisable: false,
      searching: null,
      isLoader: false,
    };
  },
  created() {
    this.getEmployersList();
  },
  mounted() {
    this.$emitter.on("talentIds", (payload) => {
      console.log(payload);
      this.talentIds = payload;
    });
  },

  methods: {
    viewDetail() {
      this.showViewDetail = true;
    },
    hideViewDetail() {
      this.showViewDetail = false;
    },
    onSlideChange(swiper) {
      this.currentJob = this.jobs[swiper.activeIndex];
      this.talentIds = null;
      this.$emitter.emit("curJob", this.currentJob);
    },
    async getEmployersList() {
      let response = await ReferService.getEmployersList().catch((error) => {
        return this.$toast.error(error.response.data.message);
      });
      if (response.data.status == true) {
        this.jobs = response.data.data.data;
        this.currentJob = this.jobs[0];
        this.$emitter.emit("curJob", this.currentJob);
      }
    },

    async onSubmit() {
      const payload = {
        talentIds: this.talentIds,
        positionId: this.currentJob.id,
        companyId: this.currentJob.company_id,
      };

      this.isLoader = true;
      let response = await ReferService.referTalents(payload).catch((error) => {
        this.isLoader = false;
        return this.$toast.error(error.response.data.message);
      });
      if (response.data.status == true) {
        this.isLoader = false;
        this.$emitter.emit("updateTalent", null);
      }
    },

    async onKeyPress() {
      const payload = {
        name: this.searching,
      };
      let response = await ReferService.getEmployersList(payload).catch(
        (error) => {
          return this.$toast.error(error.response.data.message);
        }
      );
      if (response.data.status == true) {
        this.jobs = response.data.data.data;
        this.currentJob = this.jobs[0];
        this.$emitter.emit("curJob", this.currentJob);
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
