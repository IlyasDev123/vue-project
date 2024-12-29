<template>
  <section
    class="select__role"
    v-bind:class="{
      crafting__form: $route.path == '/profile-crafting',
      'crafting__form almost__Done': $route.path == '/done',
      'select__SpecificIndustry selected__BigFont selct__industry':
        $route.path == '/important-things',
      'crafting__form Hear__AboutUS':
        $route.path == '/hear-about-us' || $route.path == '/customize-profile',
      'THankYou crafting__form': $route.path == '/thanks',
      'selct__industry select__SpecificIndustry selected__BigFont':
        $route.path == '/professions',
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
        key="['EmployerSelectRolePage']"
        v-if="['EmployerSelectRolePage'].includes($route.name)"
        nextRouteName="UserRegisterPage"
        previousRouteName=""
      />
      <EmployerGetIn  key="['EmployerGetIN']"
        v-else-if="['EmployerGetIN'].includes($route.name)" />
      <SelectIndustry
        key="['EmployerSelectIndustry']"
        v-else-if="['EmployerSelectIndustry'].includes($route.name)"
      />
      <SpecificIndustrt
        v-else-if="['EmployerProfessions'].includes($route.name)"
      />
      <ProfileCrafting
        key="['EmployerProfileCrafting']"
        v-else-if="['EmployerProfileCrafting'].includes($route.name)"
      />
      <AlmostDone v-else-if="['EmployerAllmostDone'].includes($route.name)" />
      <ImportantThings
        v-else-if="['EmployerImportantThings'].includes($route.name)"
      />
      <CoWorkers v-else-if="['EmployerCOWorkers'].includes($route.name)" />
      <Hobbies v-else-if="['EmployerHobbies'].includes($route.name)" />
      <LastQuestion
        v-else-if="['EmployerLastQuestion'].includes($route.name)"
      />
      <ManagementStyle
        v-else-if="['EmployerManagementStyle'].includes($route.name)"
      />
      <HearAboutUs v-else-if="['EmployerHearAboutUs'].includes($route.name)" />
      <CustomizeProfile
        v-else-if="['EmployerCustomizeProfile'].includes($route.name)"
      />
      <RegisterThanks v-else-if="['Thanks'].includes($route.name)" />
      <!-- =======  role footer ===== -->
      <SignUpFooter />
    </div>
  </section>
</template>
<script>
import SignUpFooter from "@/components/EmployerRegister/SignUpFooter.vue";
import SignUpHeader from "@/components/EmployerRegister/SignUpHeader.vue";
 import SelectSignUpRole from "@/components/EmployerRegister/SelectSignUpRole.vue";
import EmployerGetIn from "@/components/EmployerRegister/EmployerGetIn.vue";
import SelectIndustry from "@/components/EmployerRegister/SelectIndustry.vue";
// import ProfileCrafting from "@/components/EmployerRegister/ProfileCrafting.vue";
// import AlmostDone from "@/components/EmployerRegister/AlmostDone.vue";
// import ImportantThings from "@/components/EmployerRegister/ImportantThings.vue";
// import HearAboutUs from "@/components/EmployerRegister/HearAboutUs.vue";
// import CustomizeProfile from "@/components/EmployerRegister/CustomizeProfile.vue";
// import RegisterThanks from "@/components/EmployerRegister/RegisterThanks.vue";
// import SpecificIndustrt from "@/components/EmployerRegister/SpecificIndustry.vue";
// import CoWorkers from "@/components/EmployerRegister/CoWorkers.vue";
// import Hobbies from "@/components/EmployerRegister/HobbiesSelect.vue";
// import LastQuestion from "@/components/EmployerRegister/LastQuestion.vue";
// import ManagementStyle from "@/components/EmployerRegister/ManagementStyle.vue";

export default {
  components: {
    // SignUpFooter,
    // SignUpHeader,
    // SelectSignUpRole,
    EmployerGetIn,
    // SelectIndustry,
    // ProfileCrafting,
    // AlmostDone,
    // ImportantThings,
    // HearAboutUs,
    // CustomizeProfile,
    // RegisterThanks,
    // SpecificIndustrt,
    // CoWorkers,
    // Hobbies,
    // LastQuestion,
    // ManagementStyle,
  },
};
</script>
