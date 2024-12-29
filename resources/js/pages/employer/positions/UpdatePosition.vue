<template>
  <DashboardEditProfile>
    <form action="#" @submit.prevent="onSubmit">
      <!-- <fieldset class="role__fieldset fieldset__name">
        <input
          type="text"
          name="company_name"
          placeholder="Company Name"
          v-model="company_name"
        />
        <div v-show="errors && !company_name" class="error_message">
          Company Name {{ errors }}
        </div>
      </fieldset> -->

      <!-- <fieldset class="role__fieldset fieldset__currentRole">
        <input
          type="text"
          name="current_role"
          placeholder="Your current role"
          v-model="current_role"
        />
        <div v-show="errors && !current_role" class="error_message">
          Current Roles {{ errors }}
        </div>
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
              :checked="position.is_specfic_state == 1"
              @change="onChangeValue(1)"
            />
            <label for="yes">yes</label>
          </div>
          <div class="d__flex hire__need">
            <input
              type="radio"
              name="hire-need"
              id="no"
              :checked="position.is_specfic_state == 0"
              @change="onChangeValue(0)"
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
                v-model="position.state_id"
                :value="country.id"
                :id="`state_${country.name}`"
              />
              <label :for="`state_${country.name}`">{{ country.name }}</label>
            </div>
          </div>
        </div>
        <div v-show="errors && !position.state_id" class="error_message">
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
                v-model="position.salary_id"
                :value="salary.id"
                :id="`dollar50kPlus_${salary.start_range}`"
              />
              <label :for="`dollar50kPlus_${salary.start_range}`"
                >${{ salary.start_range }}+</label
              >
            </div>
          </div>
        </div>
        <!-- <div v-show="errors && !position.salaryId" class="error_message">
          Salary {{ errors }}
        </div> -->
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
                v-model="position.prefer_work_location_id"
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
                v-model="position.experience_id"
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

      <!-- <fieldset
        class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
        data-behaviour="toggle"
      >
        <div
          class="hieen__fieldsLabel"
          @click="(e) => e.target.classList.toggle('active')"
        >
          What best describes your Management style?
        </div>
        <div class="hidden__fieldsWrapper">
          <div class="hidden_flex_holder">
            <div
              class="fild__checkbox_area"
              v-for="(ManagementStyle, index) in this.$store.state.chirrrpMeta
                .chirrrpMeta.ManagementStyles"
              :key="ManagementStyle.id"
            >
              <input
                type="checkbox"
                :name="`management__${ManagementStyle.name}`"
                :value="ManagementStyle.id"
                :id="`management__${ManagementStyle.name}`"
                :checked="ManagementStyle.id == managementStyleId[index]"
                @change="onChecked(ManagementStyle.id)"
              />
              <label :for="`management__${ManagementStyle.name}`">
                <svg
                  width="27"
                  height="27"
                  viewBox="0 0 27 27"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M24.75 13.5C24.75 19.7128 19.7128 24.75 13.5 24.75C7.28719 24.75 2.25 19.7128 2.25 13.5C2.25 7.28719 7.28719 2.25 13.5 2.25C19.7128 2.25 24.75 7.28719 24.75 13.5Z"
                    fill="#E9DBDC"
                  />
                  <path
                    d="M19.4636 8.21362L11.8125 15.8619L8.66133 12.7131L7.08801 14.2864L11.8125 19.0131L21.0363 9.78694L19.4636 8.21362Z"
                    fill="#F6E8E7"
                  />
                </svg>
                {{ ManagementStyle.name }}
              </label>
            </div>
          </div>
        </div>
      </fieldset> -->

      <div class="big__blutBtnHolder text__center max__100">
        <Button
          class="big__blutBtn"
          type="submit"
          v-show="!loader"
          :disabled="isDisable == true"
          >Save Changes</Button
        >
        <div class="big__blutBtn" v-show="isLoader">
          <img src="@/assets/img/loader.gif" width="30" height="30" />
        </div>
      </div>
    </form>
  </DashboardEditProfile>
</template>

<script>
import DashboardEditProfile from "@/components/DashboardEditProfile.vue";
import UpdatePositionForm from "@/components/Profiles/UpdatePosition.vue";
import ComppanyService from "@/Services/companyService";
import { mapState } from "vuex";
export default {
  name: "UpdatePosition",
  props: {
    positionId: Number,
  },
  components: {
    DashboardEditProfile,
  },

  mounted() {
    this.getPosition(this.positionId);
  },

  computed: {
    ...mapState("auth", {
      companyName: (state) => state.userMeta?.company_name,
      currentRole: (state) => state.userMeta?.current_role,
    }),
  },
  data() {
    return {
      isDisable: false,
      loader: false,
      //   company_name: this.$store.state.auth.userMeta.company_name,
      //   current_role: this.$store.state.auth.userMeta.current_role,
      position: {},
      managementStyleId: {},
      //   is_specfic_state_yes: false,
      //   is_specfic_state_no: false,
    };
  },

  methods: {
    onChangeValue(param) {
      this.position.is_specfic_state = param;
    },

    onChecked(id) {
      if (this.managementStyleId.includes(id)) {
        this.managementStyleId.pop(id);
      } else {
        this.managementStyleId.push(id);
      }
    },
    async getPosition(id) {
      let response = await ComppanyService.getPosition(id).catch((error) => {
        this.$toast.error(error.data.message);
      });
      if (response.data.status == true) {
        let data = response.data.data;
        this.position = data;
        // this.position.prefer_work_location_id =
        //   data.company?.company_meta?.prefer_work_location_id;
        this.is_specfic_state_yes = data.is_specfic_state == 1 ? true : false;
        this.is_specfic_state_no = data.is_specfic_state == 0 ? true : false;

        this.managementStyleId =
          data.company?.company_meta?.management_styles.map((data) => {
            return data.id;
          });
      }
    },

    async onSubmit() {
      this.loader = true;
      this.isDisable = true;
      let payload = {
        position_id: this.position.id,
        // company_name: this.company_name,
        // current_role: this.current_role,
        state_id: this.position.state_id,
        experience_id: this.position.experience_id,
        profession_id: this.position.profession_id,
        // prefer_work_location_id: this.position.prefer_work_location_id,
        is_specfic_state: this.position.is_specfic_state,
        salary_id: this.position.salary_id,
        // management_style_id: this.managementStyleId,
      };

      let response = await ComppanyService.updatePosition(payload).catch(
        (error) => {
          this.loader = false;
          this.isDisable = false;
          this.$toast.error(error.response.data.message);
        }
      );
      if (response.data.status == true) {
        // this.position = response.data.data;
        this.loader = false;
        this.isDisable = false;
        this.$toast.success(response.data.message);
      }
    },
  },
};
</script>


<style scoped>
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

.has__svg input:checked + label svg > path:nth-child(1) {
  fill: #3d70e0 !important;
}
.has__svg label svg {
  margin-right: 10px;
}
section.select__role.crafting__form.edit__skill {
  max-width: 680px;
  min-width: 680px;
}
</style>

