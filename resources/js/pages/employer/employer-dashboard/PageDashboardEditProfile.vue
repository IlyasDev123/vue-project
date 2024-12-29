<template>
  <section class="select__role crafting__form">
    <div class="role__container">
      <h1 class="text__center fw__700">Edit Your Profile</h1>
      <div class="regsiter_form_holder">
        <form @submit.prevent="onSubmit">
          <!-- <fieldset class="role__fieldset fieldset__name">
            <input
              type="text"
              name="company_name"
              :placeholder="this.$store.state.auth.userMeta.company_name"
              v-model="companyName"
              disabled
            />
          </fieldset> -->

          <!-- <fieldset class="role__fieldset fieldset__currentRole">
            <input
              type="text"
              name="current_role"
              :placeholder="this.$store.state.auth.userMeta.current_role"
              v-model="currentRole"
              disabled
            />
          </fieldset> -->

          <fieldset class="role__fieldset fieldset__name">
            <p class="hire__need-label">
              Does your hire need to be in a specific state?
            </p>
            <div class="d__flex">
              <div class="d__flex hire__need">
                <input
                  type="radio"
                  name="hire-need"
                  id="yes"
                  v-model="isSpecficState"
                  value="1"
                />
                <label for="yes">yes</label>
              </div>
              <div class="d__flex hire__need">
                <input
                  type="radio"
                  name="hire-need"
                  id="no"
                  v-model="isSpecficState"
                  value="0"
                />
                <label for="no">no</label>
              </div>
            </div>
          </fieldset>

          <fieldset
            class="
              role__fieldset
              fieldset__WorkLocation
              filedStyle__dropDown
              file_status
            "
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              select Your State
            </div>
            <div class="hidden__fieldsWrapper">
              <!-- <div class="search__state">
                <input type="search" placeholder="Search State">
              </div> -->
              <div class="hidden_flex_holder">
                <div
                  class="fild__checkbox_area"
                  v-for="country in this.$store.state.chirrrpMeta.chirrrpMeta
                    .states"
                  :key="country.id"
                >
                  <input
                    type="radio"
                    name="state"
                    v-model="stateId"
                    :value="country.id"
                    :id="`state_${country.name}`"
                  />
                  <label :for="`state_${country.name}`">{{
                    country.name
                  }}</label>
                </div>
              </div>
            </div>
            <div v-show="errors && !stateId" class="error_message">
              State {{ errors }}
            </div>
          </fieldset>
          <fieldset
            class="
              role__fieldset
              fieldset__Salary
              filedStyle__BUttons
              active__fieldSets
            "
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              Desired Salary
            </div>
            <div class="hidden__fieldsWrapper">
              <div class="hidden_flex_holder">
                <div
                  class="fild__checkbox_area"
                  v-for="salary in this.$store.state.chirrrpMeta.chirrrpMeta
                    .salaries"
                  :key="salary.id"
                >
                  <input
                    type="radio"
                    name="salary"
                    v-model="salaryId"
                    :value="salary.id"
                    :id="`dollar50kPlus_${salary.start_range}`"
                  />
                  <label :for="`dollar50kPlus_${salary.start_range}`"
                    >${{ salary.start_range }}+</label
                  >
                </div>
              </div>
            </div>
            <div v-show="errors && !salaryId" class="error_message">
              Salary {{ errors }}
            </div>
          </fieldset>
          <!-- <fieldset
            class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              Work Location Preference
            </div>
            <div class="hidden__fieldsWrapper">
              <div class="hidden_flex_holder">
                <div
                  class="fild__checkbox_area"
                  v-for="preferWorkLocation in this.$store.state.chirrrpMeta
                    .chirrrpMeta.preferWorkLocations"
                  :key="preferWorkLocation.id"
                >
                  <input
                    type="radio"
                    name="workLocation"
                    v-model="preferWorkLocationId"
                    :value="preferWorkLocation.id"
                    :id="`location__${preferWorkLocation.name}`"
                  />
                  <label :for="`location__${preferWorkLocation.name}`">{{
                    preferWorkLocation.name
                  }}</label>
                </div>
              </div>
            </div>
          </fieldset> -->
          <fieldset
            class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              Any Experience Level Preferences?
            </div>
            <div class="hidden__fieldsWrapper">
              <div class="hidden_flex_holder">
                <div
                  class="fild__checkbox_area"
                  v-for="experience in this.$store.state.chirrrpMeta.chirrrpMeta
                    .experiences"
                  :key="experience.id"
                >
                  <input
                    type="radio"
                    name="experience"
                    :value="experience.id"
                    v-model="experienceId"
                    :id="`experience__${experience.start_range}`"
                  />
                  <label :for="`experience__${experience.start_range}`"
                    >{{ experience.start_range }}
                    {{ experience.start_range > 1 ? `years` : `year` }}</label
                  >
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset class="role__fieldset fieldset__name">
            <input
              type="text"
              name="description"
              placeholder="Any thing you like to say"
              v-model="description"
            />
          </fieldset>
          <button class="big__blue__btn" type="submit" :isDisable="!isDisable">
            Save Changes
          </button>
        </form>
      </div>
      <!-- ============ next Prev Buttons ====== -->
      <div class="role__btn">
        <router-link
          :to="{ name: 'EmployerAllSet' }"
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
        <a @click="onSubmit" class="arrow__anchor arrow__next">
          <svg
            width="31"
            height="20"
            viewBox="0 0 31 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
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
        </a>
      </div>
    </div>
  </section>
</template>

<script>
import companyService from "@/Services/companyService";
export default {
  name: "PageDashboardEditProfile",
  components: {},

  data() {
    return {
      experienceId: null,
      //   currentRole: null,
      salaryId: null,
      stateId: null,
      //   preferWorkLocationId: null,
      errors: null,
      disabled: true,
      userType: null,
      companyName: null,
      description: null,
      isSpecficState: 0,
      professionId: null,
    };
  },
  created() {
    this.assignValueToState();
  },
  methods: {
    assignValueToState() {
      let formData = this.$functions.getLocalStorage("mutlistepfm") || [];

      this.experienceId = formData ? formData.experience_id : null;
      this.professionId = formData ? formData.profession_id : null;
      //   this.currentRole = formData
      //     ? formData.current_role
      //     : this.$store.state.auth.userMeta.current_role;
      this.salaryId = formData ? formData.salary_id : null;
      this.stateId = formData ? formData.state_id : null;
      this.userType = formData.type;
      //   this.companyName = formData
      //     ? formData.company_name
      //     : this.$store.state.auth.userMeta.company_name;
      this.description = formData ? formData.description : null;
      this.isSpecficState = formData ? formData.is_specfic_state : this.isSpecficState;
    },

    async onSubmit() {
      let validation =
        this.userType == this.$constants.TALENT
          ? !this.experienceId || !this.stateId || !this.salaryId
          : !this.stateId || !this.salaryId;
      if (validation) {
        this.errors = "Field is required";
      } else {
        let payload = {
          experience_id: this.experienceId,
          //   current_role: this.currentRole,
          salary_id: this.salaryId,
          state_id: this.stateId,
          //   prefer_work_location_id: this.preferWorkLocationId,
          is_specfic_state: this.isSpecficState,
          //   company_name: this.companyName,
          description: this.description,
          profession_id: this.professionId,
        };
        let response = await companyService
          .addPosition(payload)
          .catch((error) => {
            return this.$toast.error(error.response.data.message);
          });
        localStorage.removeItem("mutlistepfm");
        this.$toast.success("Add Position Successfull");
        this.$router.push({ name: "EmployerBack" }).then(() => {
          this.$router.go();
        });
      }
    },
  },
};
</script>

<style>
.file_status .hidden__fieldsWrapper {
  height: 150px;
  overflow: auto;
  overflow-x: hidden;
}

.hire__need {
  margin: 15px;
}
.hire__need label {
  padding-left: 25px;
  text-transform: capitalize;
  position: relative;
  color: #374151;
}
.hire__need:first-child {
  margin-left: 0px;
}
.hire__need input[type="radio"] {
  width: auto;
  display: none;
}
.hire__need label:before {
  content: "";
  position: absolute;
  width: 20px;
  height: 20px;
  border: 1px solid #6b6b6b;
  border-radius: 6px;
  left: 0;
  top: 0;
  bottom: 0;
  margin: auto;
}
.hire__need input[type="radio"] + label:before {
  content: "╳";
  font-size: 6px;
  font-weight: 700;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
  background-color: #f15555;
  border: 2px solid #fff;
  outline: 1px solid #f15555;
}
.hire__need input[type="radio"]:checked + label:before {
  content: "✓";
  font-size: 10px;
  font-weight: 700;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
  background-color: #6b6b6b;
  border: 2px solid #fff;
  outline: 1px solid #115906;
}
.hire__need-label {
  color: #374151;
  font-size: 16px;
  line-height: 19px;
  margin-bottom: 10px;
  text-transform: capitalize;
}
.hieen__fieldsLabel::after {
  transform: rotate(45deg) !important;
}
.hieen__fieldsLabel.active::after {
  transform: rotate(225deg) !important;
}
.hieen__fieldsLabel.active + .hidden__fieldsWrapper {
  display: block;
}
.search__box input {
  border: 1px solid rgba(0, 0, 0, 0.3) !important;
}
.crafting__form form .search__state input {
  border: 1px solid rgba(0, 0, 0, 0.2) !important;
  border-radius: 5px;
  max-width: 200px;
  padding: 5px 10px !important;
}
.search__state {
  text-align: right;
}
.no__border-bottom {
  border-bottom: 0px !important;
}
</style>
