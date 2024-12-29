<template>
  <section class="select__role selct__industry select__SpecificIndustry">
    <div class="role__container">
      <h1 class="text__center">Select The Role</h1>
      <div class="regsiter_form_holder">
        <form action="#" class="">
          <div class="indutry__holder">
            <fieldset v-for="profession in professions" :key="profession.id">
              <input
                type="radio"
                name="id"
                :value="profession.id"
                v-model="id"
                :id="`indutsry__${profession.name}`"
                :checked="profession.id == id"
                @change="onChange"
              />
              <label :for="`indutsry__${profession.name}`">
                {{ profession.name }}</label
              >
            </fieldset>
          </div>
        </form>
      </div>
      <!-- ============ next Prev Buttons ====== -->
      <div class="role__btn">
        <router-link
          :to="{ name: 'EmployerSelectIndustry' }"
          class="arrow__anchor arrow__prev"
        >
          <svg
            width="31"
            height="20"
            viewBox="0 0 31 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M9.66902 0.000182867C9.42555 0.00727869 9.19439 0.108847 9.02449 0.283386L0.274491 9.03339C0.0987421 9.20921 1.33514e-05 9.44763 1.33514e-05 9.69623C1.33514e-05 9.94483 0.0987421 10.1832 0.274491 10.3591L9.02449 19.1091C9.11088 19.199 9.21435 19.2709 9.32884 19.3204C9.44334 19.3698 9.56656 19.396 9.69128 19.3973C9.816 19.3985 9.93973 19.3749 10.0552 19.3277C10.1707 19.2806 10.2756 19.2109 10.3638 19.1227C10.452 19.0345 10.5217 18.9296 10.5688 18.8141C10.616 18.6986 10.6396 18.5749 10.6384 18.4502C10.6371 18.3255 10.6109 18.2022 10.5615 18.0877C10.512 17.9732 10.4401 17.8698 10.3502 17.7834L3.20052 10.6337H21.5623C21.6866 10.6355 21.8099 10.6125 21.9252 10.5662C22.0405 10.5199 22.1454 10.4511 22.2339 10.3639C22.3223 10.2766 22.3926 10.1727 22.4405 10.0581C22.4885 9.94347 22.5132 9.82047 22.5132 9.69623C22.5132 9.57199 22.4885 9.44898 22.4405 9.33436C22.3926 9.21975 22.3223 9.11581 22.2339 9.02858C22.1454 8.94135 22.0405 8.87257 21.9252 8.82625C21.8099 8.77992 21.6866 8.75697 21.5623 8.75873H3.20052L10.3502 1.60907C10.4854 1.47735 10.5778 1.30786 10.6151 1.1228C10.6524 0.937731 10.633 0.745705 10.5594 0.57185C10.4858 0.397995 10.3614 0.25041 10.2026 0.148411C10.0437 0.0464109 9.85774 -0.00525228 9.66902 0.000182867Z"
              fill="#3D70E0"
            ></path>
            <path
              d="M25.5137 9.74902H29.5137"
              stroke="#7FCEFA"
              stroke-width="1.9"
              stroke-linecap="round"
              stroke-linejoin="round"
            ></path>
          </svg>
        </router-link>

        <router-link
          :to="{ name: 'EmployerAdditionalSalary' }"
          class="arrow__anchor arrow__next"
        >
          <svg
            width="31"
            height="20"
            viewBox="0 0 31 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            v-show="professions.length > 0"
          >
            <path
              d="M20.8442 0.000182867C21.0876 0.00727869 21.3188 0.108847 21.4887 0.283386L30.2387 9.03339C30.4144 9.20921 30.5132 9.44763 30.5132 9.69623C30.5132 9.94483 30.4144 10.1832 30.2387 10.3591L21.4887 19.1091C21.4023 19.199 21.2988 19.2709 21.1843 19.3204C21.0698 19.3698 20.9466 19.396 20.8219 19.3973C20.6972 19.3985 20.5735 19.3749 20.458 19.3277C20.3425 19.2806 20.2376 19.2109 20.1494 19.1227C20.0612 19.0345 19.9915 18.9296 19.9443 18.8141C19.8972 18.6986 19.8736 18.5749 19.8748 18.4502C19.8761 18.3255 19.9022 18.2022 19.9517 18.0877C20.0012 17.9732 20.073 17.8698 20.163 17.7834L27.3127 10.6337H8.95085C8.82662 10.6355 8.70328 10.6125 8.588 10.5662C8.47272 10.5199 8.36779 10.4511 8.27932 10.3639C8.19085 10.2766 8.12059 10.1727 8.07264 10.0581C8.02469 9.94347 8 9.82047 8 9.69623C8 9.57199 8.02469 9.44898 8.07264 9.33436C8.12059 9.21975 8.19085 9.11581 8.27932 9.02858C8.36779 8.94135 8.47272 8.87257 8.588 8.82625C8.70328 8.77992 8.82662 8.75697 8.95085 8.75873H27.3127L20.163 1.60907C20.0278 1.47735 19.9354 1.30786 19.8981 1.1228C19.8608 0.937731 19.8802 0.745705 19.9538 0.57185C20.0274 0.397995 20.1517 0.25041 20.3106 0.148411C20.4695 0.0464109 20.6554 -0.00525228 20.8442 0.000182867Z"
              fill="#3D70E0"
            ></path>
            <path
              d="M5 9.74902H1"
              stroke="#7FCEFA"
              stroke-width="1.9"
              stroke-linecap="round"
              stroke-linejoin="round"
            ></path>
          </svg>
        </router-link>
      </div>
    </div>
  </section>
</template>

<script>
import NextPreviousButton from "../../../components/Buttons/NextPreviousButton.vue";
import { mapActions, mapState } from "vuex";
export default {
  name: "PageSelectNewRole",
  props: {
    title: String,
  },
  components: {
    NextPreviousButton,
  },
  computed: {
    ...mapState("chirrrpMeta", {
      professionID: (state) => state.chirrrpMeta.professionID,
      industries: (state) => state.chirrrpMeta.industries,
    }),
  },
  created() {
    let formData = this.$functions.getLocalStorage("mutlistepfm") || [];
    let industryId = formData ? formData.industryId : null;
    this.id = formData ? formData.profession_id : null;
    this.getProfession(industryId);
  },
  data() {
    return {
      isChecked: false,
      professions: {},
      id: this.$store.state.chirrrpMeta.profession_id,
    };
  },
  methods: {
    ...mapActions("chirrrpMeta", {
      getProfessions: "getProfessions",
    }),

    async getProfession(industryId) {
      let response = await this.getProfessions(industryId);
      this.professions = response;
      if (response) {
        this.isChecked == true;
      }
    },

    onChange() {
      let payload = {
        profession_id: this.id,
      };
      this.$functions.setLocalStorage("mutlistepfm", payload);
    },
  },
};
</script>
