<template>
  <section
    class="
      select__role
      selct__industry
      select__SpecificIndustry
      selected__BigFont
      HobbiesSelect
    "
  >
    <div class="role__container">
      <!-- ======= main signup body ==== -->
      <h1 class="text__center">Select The Role</h1>
      <div class="regsiter_form_holder">
        <form action="#" class="" @submit.prevent="onSubmit">
          <div
            class="indutry__holder"
            v-for="hobby in this.$store.state.chirrrpMeta.chirrrpMeta.hobbies"
            :key="hobby.id"
          >
            <fieldset>
              <input
                type="radio"
                name="hobby__Cooking"
                v-model="id"
                :value="hobby.id"
                :checked="hobby.id == id"
                @change="onChange"
                :id="`hobby__${hobby.name}`"
              />
              <label :for="`hobby__${hobby.name}`">{{ hobby.name }}</label>
            </fieldset>
          </div>
          <Button
            class="big__blue__btn"
            type="submit"
            :disabled="isDisable == true"
          >
            Submit your Skill
          </Button>
        </form>
      </div>
      <!-- ============ next Prev Buttons ====== -->
      <div class="role__btn">
        <router-link
          :to="{ name: 'EditCoworker' }"
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
      </div>
    </div>
  </section>
</template>

<script>
import TalentService from "@/Services/talentService";
export default {
  name: "HobbiesSelect",

  data() {
    return {
      id: null,
      isDisable: false,
    };
  },
  created() {
    let formData = this.$functions.getLocalStorage("mutlistepfm") || [];
    this.id = formData ? formData.hobby_id : null;
  },
  methods: {
    onChange() {
      let payload = {
        hobby_id: this.id,
      };
      this.$functions.setLocalStorage("mutlistepfm", payload);
    },

    async onSubmit() {
      this.isDisable = true;
      let formData = this.$functions.getLocalStorage("mutlistepfm");
      let response = await TalentService.addSkill(formData).catch((error) => {
        this.$toast.error(error.data.message);
        this.isDisable = false;
      });

      if (response.data.status == true) {
        this.$toast.success(response.data.message);
        this.$router.push({ name: "WelcomeBack" }).then(() => {
          this.$router.go();
        });
        this.isDisable = false;
        this.$functions.removeItemLocalStorage("mutlistepfm");
      }
    },
  },
};
</script>
