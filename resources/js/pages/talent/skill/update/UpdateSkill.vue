<template>
  <section class="select__role crafting__form edit__skill">
    <div class="role__container">
      <h1 class="text__center fw__700">Edit Skill</h1>
      <div class="regsiter_form_holder">
        <form action="#" @submit.prevent="onSubmit">
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
                    v-model="data.experience_id"
                    :checked="data.experience_id == experience.id"
                    :id="`state_${experience.start_range}`"
                  />
                  <label for="dollar50kPlus"
                    >{{ experience.start_range }} year+</label
                  >
                </div>
              </div>
            </div>
            <div v-show="errors && !data.experience_id" class="error_message">
              Experience {{ errors }}
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
                    v-model="data.salary_id"
                    :value="salary.id"
                    :id="`dollar50kPlus_${salary.start_range}`"
                    :checked="data.salary_id == salary.id"
                  />
                  <label :for="`dollar50kPlus_${salary.start_range}`"
                    >${{ salary.start_range }}+</label
                  >
                </div>
              </div>
            </div>
            <div v-show="data.errors && !data.salary_id" class="error_message">
              Salary {{ data.errors }}
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
                    v-model="data.prefer_work_location_id"
                    :value="preferWorkLocation.id"
                    :id="`location__${preferWorkLocation.name}`"
                    :checked="
                      getTalentMeta.prefer_work_location_id ==
                      preferWorkLocation.id
                    "
                  />
                  <label :for="`location__${preferWorkLocation.name}`">{{
                    preferWorkLocation.name
                  }}</label>
                </div>
              </div>
            </div>
          </fieldset> -->

          <!-- <fieldset
            class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              What's the most important thing to you when selecting <br />a new
              employer?
            </div>
            <div class="hidden__fieldsWrapper">
              <div class="hidden_flex_holder">
                <div
                  class="fild__checkbox_area"
                  v-for="employerSelection in this.$store.state.chirrrpMeta
                    .chirrrpMeta.employerSelectionPreference"
                  :key="employerSelection.id"
                >
                  <input
                    type="radio"
                    name="id"
                    :value="employerSelection.id"
                    v-model="data.employer_selection_preference_id"
                    :id="`employeer__${employerSelection.name}`"
                    :checked="
                      getTalentMeta.employer_selection_preference_id ==
                      employerSelection.id
                    "
                  />
                  <label :for="`employeer__${employerSelection.name}`">
                    {{ employerSelection.name }}</label
                  >
                </div>
              </div>
            </div>
          </fieldset> -->
          <!-- <fieldset
            class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              How would your coworkers describe you?
            </div>
            <div class="hidden__fieldsWrapper">
              <div class="hidden_flex_holder">
                <div
                  class="fild__checkbox_area"
                  v-for="coworker in this.$store.state.chirrrpMeta.chirrrpMeta
                    .coworkerReviews"
                  :key="coworker.id"
                >
                  <input
                    type="radio"
                    name="coworker_review"
                    :value="coworker.id"
                    v-model="data.coworker_review_id"
                    :id="`coworker__${coworker.name}`"
                    :checked="getTalentMeta.coworker_review_id == coworker.id"
                  />
                  <label :for="`coworker__${coworker.name}`">{{
                    coworker.name
                  }}</label>
                </div>
              </div>
            </div>
          </fieldset> -->
          <!-- <fieldset
            class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              What do you enjoy doing in your free time?
            </div>
            <div class="hidden__fieldsWrapper">
              <div
                class="fild__checkbox_area"
                v-for="hobby in this.$store.state.chirrrpMeta.chirrrpMeta
                  .hobbies"
                :key="hobby.id"
              >
                <input
                  type="radio"
                  name="hobby__Cooking"
                  v-model="data.hobby_id"
                  :value="hobby.id"
                  :checked="getTalentMeta.hobby_id == hobby.id"
                  :id="`hobby__${hobby.name}`"
                />
                <label :for="`hobby__${hobby.name}`">{{ hobby.name }}</label>
              </div>
            </div>
          </fieldset> -->
          <div class="big__blutBtnHolder text__center max__100">
            <Button
              class="big__blutBtn"
              type="submit"
              :disabled="isDisable == true"
              >Save Changes</Button
            >
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import TalentService from "@/Services/talentService";
import { mapState } from "vuex";
export default {
  name: "UpdateSkill",
  props: {
    skillId: Number,
  },
  watch: {
    skillId: function () {
      this.getSkillById(this.skillId); // here cause error undefined and no error information on my inspect element dunno why
    },
  },
  computed: {
    ...mapState("auth", {
      getTalentMeta: (state) => state.userMeta,
    }),
  },
  mounted() {
    this.getSkillById(this.skillId);
  },

  data() {
    return {
      errors: null,
      isDisable: false,
      //   first_name: this.$store.state.auth.user.first_name,
      //   current_role: null,
      routerId: this.$route.params.id,
      id: this.skillId,
      data: {},
    };
  },

  methods: {
    async getSkillById(id) {
      let response = await TalentService.getSkillById(id).catch((error) => {
        this.$toast.error(error.response.data.message);
      });
      if (response.data.status == true) {
        this.data = response.data.data;
      }
    },

    async onSubmit() {
      this.isDisable = true;
      let response = await TalentService.updateSkill(this.data).catch(
        (error) => {
          this.isDisable = false;
          this.$toast.error(error.data);
        }
      );

      if (response.data.status == true) {
        this.$toast.success(response.data.message);
        this.isDisable = false;
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
