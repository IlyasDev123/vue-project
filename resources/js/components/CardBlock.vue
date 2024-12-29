<template>
  <div class="refer__post-box">
    <div class="refer__post-box-img" v-if="this.userType == this.$constants.TALENT">
      <TalentCV :talent="referedTalent?.talent" :userType="userType"/>
    </div>
    <div class="refer__post-box-img" v-if="this.userType == this.$constants.EMPLOYER">
      <TalentCV :job="referedTalent?.company" :userType="userType"/>
    </div>
    <div v-if="userType == this.$constants.EMPLOYER"
      class="refer__post-box-info d__flex d__flex-h-between d__flex-v-center"
    >
      <div
        class="
          refer__post-box-info-inner
          d__flex d__flex-h-between d__flex-v-center
        "
      >
        <img :src="$public + referedTalent?.company?.avatar" alt="" />
        <div class="d__flex d__flex-d-col d__flex-h-center">
          <h5>
            {{ referedTalent?.company?.first_name }}{{ " "
            }}{{ referedTalent?.company?.last_name }}
          </h5>
          <span>{{ referedTalent?.company?.skills?.profession?.name }}</span>
        </div>
      </div>

      <router-link
        :to="{
          name: 'DetailEmployerPage',
          params: { id: referedTalent?.company?.id },
        }"
        class="refer__post-box-info-link"
        >View Profile</router-link
      >
    </div>
    <div v-else-if="userType == this.$constants.TALENT"
      class="refer__post-box-info d__flex d__flex-h-between d__flex-v-center"
    >
      <div
        class="
          refer__post-box-info-inner
          d__flex d__flex-h-between d__flex-v-center
        "
      >
        <img :src=" $public + referedTalent?.talent?.avatar" alt="" />
        <div class="d__flex d__flex-d-col d__flex-h-center">
          <h5>
            {{ referedTalent?.talent?.first_name }}{{ " "
            }}{{ referedTalent?.talent?.last_name }}
          </h5>
          <span>{{ referedTalent?.talent?.skills?.profession?.name }}</span>
        </div>
      </div>

      <router-link
        :to="{
          name: 'TalentDetail',
          params: { id: referedTalent?.talent?.id },
        }"
        class="refer__post-box-info-link"
        >View Profile</router-link
      >
    </div>
  </div>
</template>

<script>
import TalentCV from "./TalentCV.vue";
export default {
  name: "CardBlock",
  components: {
    TalentCV,
  },
  props: {
    CardInfo: Object,
    referedTalent: Object,
    company: Object,
    userType: Number,
  },
  data() {
    return { image: "@/assets/img/user-post-2.png" };
  },
};
</script>

<style lang="scss" scoped></style>
