<template>
  <section class="select__role crafting__form">
    <div class="role__container">
      <h1 class="text__center fw__700">Select The Experience</h1>
      <div class="regsiter_form_holder">
        <form @submit.prevent="onSubmit">
          <fieldset
            class="
              role__fieldset
              fieldset__state
              filedStyle__BUttons
              active__fieldSets
            "
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              Years of Experience
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
                    v-model="data.experienceId"
                    :id="`state_${experience.start_range}`"
                  />
                  <label for="dollar50kPlus"
                    >{{ experience.start_range }} year+</label
                  >
                </div>
              </div>
            </div>
            <div
              v-show="data.errors && !data.experienceId"
              class="error_message"
            >
              Experience {{ data.errors }}
            </div>
          </fieldset>
          <!-- <fieldset class="role__fieldset fieldset__currentRole">
            <input
              type="text"
              name="current_role"
              v-model="currentRole"
              placeholder="current Role"
            />
            <div v-show="errors && !currentRole" class="error_message">
              Current Roles {{ errors }}
            </div>
          </fieldset> -->
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
                    v-model="data.salaryId"
                    :value="salary.id"
                    :id="`dollar50kPlus_${salary.start_range}`"
                  />
                  <label :for="`dollar50kPlus_${salary.start_range}`"
                    >${{ salary.start_range }}+</label
                  >
                </div>
              </div>
            </div>
            <div v-show="data.errors && !data.salaryId" class="error_message">
              Salary {{ data.errors }}
            </div>
          </fieldset>

          <Button
            class="big__blue__btn"
            type="submit"
            :disabled="isDisable == true"
          >
            Submit your Skill
          </Button>
        </form>
      </div>

      <div class="role__btn">
        <router-link :to="{ name: 'AllSet' }" class="arrow__anchor arrow__prev">
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
import { method } from "lodash";
import TalentService from "@/Services/talentService";
export default {
  name: "ProfileDetail",
  components: {},

  data() {
    return {
      data: {
        experienceId: null,
        // currentRole: null,
        salaryId: null,
        stateId: null,
        profession_id: null,
        // preferWorkLocationId: null,
        errors: null,
        disabled: true,
        userType: null,
        description: null,
      },
    };
  },
  created() {
    this.assignValueToState();
  },
  methods: {
    assignValueToState() {
      let formData = this.$functions.getLocalStorage("mutlistepfm") || [];
      this.data.profession_id = formData.profession_id;
    },

    async onSubmit() {
      let validation =
        this.userType == !this.data.experienceId ||
        // !this.currentRole ||
        // !this.data.stateId ||
        !this.data.salaryId;

      if (validation) {
        this.data.errors = "Field is required";
      } else {
        let payload = {
          experience_id: this.data.experienceId,
          current_role: this.data.currentRole,
          salary_id: this.data.salaryId,
          // state_id: this.data.stateId,
          profession_id: this.data.profession_id,
        };

        this.data.isDisable = true;
        let response = await TalentService.addSkill(payload).catch((error) => {
          this.$toast.error(error.response.data.message);
          this.data.isDisable = false;
        });

        if (response.data.status == true) {
          this.$toast.success(response.data.message);
          this.$router.push({ name: "WelcomeBack" }).then(() => {
            this.$router.go();
          });
          this.data.isDisable = false;
          this.$functions.removeItemLocalStorage("mutlistepfm");
        }
      }
    },
  },
};
</script>

<style scoped>
.max__466 {
  max-width: 466px !important;
}
.max__466 .hidden__fieldsWrapper {
  display: block;
}

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
@media (max-width:575px){
  .crafting__form form .filedStyle__BUttons .hidden_flex_holder{
    flex-direction:column;
  }
  .crafting__form form .filedStyle__BUttons label {
    width:100%;
    text-align:center;
  }
}
</style>
