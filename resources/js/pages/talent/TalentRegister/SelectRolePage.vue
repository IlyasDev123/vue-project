<template>
  <section
    class="select__role"
    v-bind:class="{
      crafting__form: $route.path == '/profile-crafting',
      'crafting__form almost__Done': $route.path == '/done',
      'select__SpecificIndustry selected__BigFont selct__industry':
        $route.path == '/important-things' || $route.path == '/love-about-work',
      'crafting__form Hear__AboutUS':
        $route.path == '/hear-about-us' || $route.path == '/customize-profile',
      'THankYou crafting__form': $route.path == '/thanks',
      'selct__industry select__SpecificIndustry selected__BigFont':
        $route.path == '/profession',
      'selct__industry select__SpecificIndustry selected__BigFont HobbiesSelect':
        $route.path == '/co-workers' ||
        $route.path == '/hobbies' ||
        $route.path == '/management-style',
      'crafting__form last__question': $route.path == '/last-question',
    }"
  >
    <div class="role__container">
      <SignUpHeader />
      <!-- ======= main signup body ==== -->
      <SelectSignUpRole
        key="['SelectRolePage']"
        v-if="['SelectRolePage'].includes($route.name)"
        nextRouteName="UserRegisterPage"
        previousRouteName=""
      />
      <GetInn
        :title = "userType== this.$constants.TALENT ? `Finding a new job shouldn't be a full-time job!`: `Finding a new job shouldn't be a full-time job!`"  
        key="['GetIN']" 
        v-else-if="['GetIN'].includes($route.name)" 
      />
      <SelectIndustry
        key="['SelectIndustry']"
        v-else-if="['SelectIndustry'].includes($route.name)"
      />
      <Profession
        key="['Profession']"
        v-else-if="['Profession'].includes($route.name)"
        :industries="data.industries"
        :industryId="industryId"
        title="Profession"
      />
      <ProfileCrafting
        key="['ProfileCrafting']"
        v-else-if="['ProfileCrafting'].includes($route.name)"
      />
      <AlmostDone 
      :title = "userType== this.$constants.TALENT ? `Almost Done! Tell us a little more about you.`: `Almost Done - Tell us a little more about you & your team!`"  
      v-else-if="['AllmostDone'].includes($route.name)" 
      :previousRouteName = "userType== this.$constants.TALENT ? `ProfileCrafting` : `ProfileCrafting`"
      :nextRouteName = "userType== this.$constants.TALENT ? `ImportantThings` : `ManagementStyle`"
      />
      <ImportantThings
        v-else-if="['ImportantThings'].includes($route.name)"
        :employerSelectionPreference="data.employerSelectionPreference"
      />
      <ManagementStyle v-else-if="['ManagementStyle'].includes($route.name)" />
      <LoveAboutWork 
        :previousRouteName = "userType== this.$constants.TALENT ? `ManagementStyle` : `ManagementStyle`"
        :nextRouteName = "userType== this.$constants.TALENT ? `LastQuestion` : `LastQuestion`"
        v-else-if="['LoveAboutWork'].includes($route.name)" 
      />
      <LastQuestion 
        :previousRouteName = "userType== this.$constants.TALENT ? `Hobbies` : `LoveAboutWork`"
        :nextRouteName = "userType== this.$constants.TALENT ? `HearAboutUs` : `HearAboutUs`"
        v-else-if="['LastQuestion'].includes($route.name)"   
      />
      <CoWorkers v-else-if="['COWorkers'].includes($route.name)" />
      <Hobbies v-else-if="['Hobbies'].includes($route.name)" />
      <HearAboutUs v-else-if="['HearAboutUs'].includes($route.name)" />
      <CustomizeProfile
        v-else-if="['CustomizeProfile'].includes($route.name)"
      />
      <RegisterThanks v-else-if="['Thanks'].includes($route.name)" />
      <!-- =======  role footer ===== -->
      <SignUpFooter />
    </div>
  </section>
</template>
<script>
import SignUpFooter from "@/components/RegisterForm/SignUpFooter.vue";
import SignUpHeader from "@/components/RegisterForm/SignUpHeader.vue";
import SelectSignUpRole from "@/components/RegisterForm/SelectSignUpRole.vue";
import GetInn from "@/components/RegisterForm/GetInn.vue";
import SelectIndustry from "@/components/RegisterForm/SelectIndustry.vue";
import Profession from "@/components/RegisterForm/Profession.vue";
import ProfileCrafting from "@/components/RegisterForm/ProfileCrafting.vue";
import AlmostDone from "@/components/RegisterForm/AlmostDone.vue";
import ImportantThings from "@/components/RegisterForm/ImportantThings.vue";
import HearAboutUs from "@/components/RegisterForm/HearAboutUs.vue";
import CustomizeProfile from "@/components/RegisterForm/CustomizeProfile.vue";
import RegisterThanks from "@/components/RegisterForm/RegisterThanks.vue";
import CoWorkers from "@/components/RegisterForm/CoWorkers.vue";
import Hobbies from "@/components/RegisterForm/HobbiesSelect.vue";
import LastQuestion from "@/components/RegisterForm/LastQuestion.vue";
import ManagementStyle from "@/components/RegisterForm/ManagementStyle.vue";
import LoveAboutWork from "@/components/RegisterForm/LoveAboutWork.vue";
import { mapActions } from "vuex";

export default {
  components: {
    SignUpFooter,
    SignUpHeader,
    SelectSignUpRole,
    GetInn,
    SelectIndustry,
    Profession,
    ProfileCrafting,
    AlmostDone,
    ImportantThings,
    HearAboutUs,
    CustomizeProfile,
    RegisterThanks,
    CoWorkers,
    Hobbies,
    LastQuestion,
    ManagementStyle,
    LoveAboutWork,
  },
  created() {
    this.getMetaData();
    let formData = this.$functions.getLocalStorage("mutlistepfm") || [];
    this.userType = formData.type;
  },
  data() {
    return {
      data: {},
      industryId: null,
      userType:null
    };
  },
  methods: {
    ...mapActions("chirrrpMeta", {
      getMetaData: "getMetaData",
    }),
    // getMetaData() {
    //   let response = this.getMetaData();
    //   this.data = response.data.data;
    //   console.log(this.data);
    //   if (this.data) {
    //     let industryId = {
    //       industryId: response.data.data.industries[0].id,
    //     };
    //     const newDataUsers = JSON.parse(localStorage.getItem("mutlistepfm"));
    //     let users = { ...newDataUsers, ...industryId };
    //     let user = localStorage.setItem("mutlistepfm", JSON.stringify(users));
    //   }
    // },
  },
};
</script>
