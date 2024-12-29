<template>
  <section class="select__role crafting__form edit__skill" id="bg-color">
    <div class="role__container">
      <h1 class="text__center fw__700">Edit Your profile</h1>
      <div class="regsiter_form_holder">
        <form action="#" @submit.prevent="onSubmit">
         
          <fieldset class="role__fieldset fieldset__name">
            <input
              type="text" 
              name="company_name"
              placeholder="Company Name"
              v-model="formData.company_name"
            />
            <div
              v-show="errors && !formData.company_name"
              class="error_message"
            >
              Company Name {{ errors }}
            </div>
          </fieldset>

          <fieldset class="role__fieldset fieldset__currentRole">
            <input
              type="text"
              name="current_role"
              placeholder="Your current role"
              v-model="formData.current_role"
            />
            <div
              v-show="errors && !formData.current_role"
              class="error_message"
            >
              Current Roles {{ errors }}
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
                    v-model="formData.state_id"
                    :value="country.id"
                    :id="`state_${country.name}`"
                  />
                  <label :for="`state_${country.name}`">{{
                    country.name
                  }}</label>
                </div>
              </div>
            </div>
            <div v-show="errors && !profile.state_id" class="error_message">
              State {{ errors }}
            </div>
          </fieldset>

          <fieldset
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
                    v-model="formData.prefer_work_location_id"
                    :value="preferWorkLocation.id"
                    :id="`location__${preferWorkLocation.name}`"
                  />
                  <label :for="`location__${preferWorkLocation.name}`">{{
                    preferWorkLocation.name
                  }}</label>
                </div>
              </div>
            </div>
          </fieldset>

          <fieldset
            class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
            data-behaviour="toggle"
          >
            <div
              class="hieen__fieldsLabel"
              @click="(e) => e.target.classList.toggle('active')"
            >
              Team Love About Work
            </div>
            <div class="hidden__fieldsWrapper">
              <div class="hidden_flex_holder">
                <div
                  class="fild__checkbox_area"
                  v-for="teamLovable in this.$store.state.chirrrpMeta
                    .chirrrpMeta.teamLovableAspects"
                  :key="teamLovable.id"
                >
                  <input
                    type="radio"
                    name="teamLovable"
                    v-model="formData.team_loveable_aspect_id"
                    :value="teamLovable.id"
                    :id="`location__${teamLovable.name}`"
                  />
                  <label :for="`location__${teamLovable.name}`">{{
                    teamLovable.name
                  }}</label>
                </div>
              </div>
            </div>
          </fieldset>

          <fieldset
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
                  v-for="(ManagementStyle, index) in this.$store.state
                    .chirrrpMeta.chirrrpMeta.ManagementStyles"
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
          </fieldset>

          <div class="big__blutBtnHolder text__center max__100">
            <Button style="max-width:443px;width:100%"
              class="big__blutBtn"
              type="submit"
              v-show="!loader"
              :disabled="loader == true"
              >Save Changes</Button
            >
            <div class="big__blutBtn" v-show="loader">
              <img src="@/assets/img/loader.gif" width="30" height="30" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>
<script>
import ComppanyService from "@/Services/companyService";
import { mapState } from "vuex";
export default {
  name: "UpdateProfileMeta",
  props: {
    profileId: Number,
  },

  mounted() {
    this.setProfileData();
  },

  computed: {
    ...mapState("auth", {
      profileData: (state) => state.userMeta,
    }),
  },
  data() {
    return {
      loader: false,
      formData: {},
      managementStyleId: {},
    };
  },

  methods: {
    setProfileData() {
      this.formData = this.profileData;
      this.managementStyleId = this.profileData?.management_styles?.map(
        (data) => {
          return data.id;
        }
      );
    },

    onChangeValue(param) {
      this.formData.is_specfic_state = param;
    },

    onChecked(id) {
      if (this.managementStyleId.includes(id)) {
        this.managementStyleId.pop(id);
      } else {
        this.managementStyleId.push(id);
      }
    },

    async onSubmit() {
      this.loader = true;
      this.isDisable = true;
      let payload = {
        id: this.formData.id,
        company_name: this.formData.company_name,
        current_role: this.formData.current_role,
        state_id: this.formData.state_id,
        prefer_work_location_id: this.formData.prefer_work_location_id,
        team_loveable_aspect_id: this.formData.team_loveable_aspect_id,
        management_style_id: this.managementStyleId,
      };

      let response = await ComppanyService.updateProfileMeta(payload).catch(
        (error) => {
          this.loader = false;
          return this.$toast.error(error.response.data.message);
        }
      );
      if (response.data.status == true) {
        this.loader = false;
        this.$toast.success(response.data.message);
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
  profile: relative;
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
  profile: absolute;
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
</style>

