<template>
  <div class="d__flex">
    <div class="skils-box-mbl">
      <router-link
        :to="{ name: 'RoleIndustry' }"
        class="add__new d__flex d__flex-v-center"
        v-if="isEditSkill == true"
      >
        <svg
          width="36"
          height="36"
          viewBox="0 0 36 36"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <rect
            x="0.5"
            y="0.5"
            width="35"
            height="35"
            rx="17.5"
            stroke="#E24108"
            stroke-opacity="0.96"
            stroke-dasharray="5 5"
          />
          <path
            d="M17 17V12H18.6667V17H23.6667V18.6667H18.6667V23.6667H17V18.6667H12V17H17Z"
            fill="#E94910"
            fill-opacity="0.86"
          />
        </svg>
        <span>Add New Skill</span>
      </router-link>
      <div class="card">
        <div v-for="skill in this.skills" :key="skill.id">
          <a
            href="#"
            @click="onClick(skill.id)"
            :class="id == skill.id ? `isActive` : null"
            >{{ skill?.profession_name }}</a
          >
        </div>
      </div>
    </div>
    <div class="we__working__on_it" v-if="isEditSkill == false">
      <WelcomeBack />
    </div>
    <div class="we__working__on_it" v-else>
      <UpdateSkill :skillId="id"></UpdateSkill>
    </div>
  </div>
</template>
<script>
import WelcomeBack from "@/components/RegisterForm/WelcomeBack.vue";
import UpdateSkill from "../skill/update/UpdateSkill.vue";
import { mapState } from "vuex";
export default {
  name: "PageWelcomeBack",
  components: {
    WelcomeBack,
    UpdateSkill,
  },
  data() {
    return {
      isEditSkill: false,
      data: {},
      id: null,
    };
  },
  computed: {
    ...mapState("auth", {
      skills: (state) => state.userSkill,
    }),
  },
  methods: {
    onClick(id) {
      this.id = id;
      this.isEditSkill = true;
    },
  },
};
</script>

<style scoped>
.card {
  width: 200px;
  height: 300px;
  overflow-y: auto;
  border: 1px;
  border-radius: 10px;
  background: #ffff;
  margin: 0px;
  padding: 10px 0;
  margin-right: 20px;
}
.card a {
  margin: 10px 15px;
  display: inline-block;
  font-size: 14px;
  font-family: "Roboto";
  font-weight: 400;
  color: #263246;
}
.isActive {
  color: #2655a7 !important;
}
@media (max-width:1366px){
  .we__working__on_it .working__mainWrapper{
  max-width: 513px;
  padding:30px;
  }
  
}
  
@media (max-width:1199px){
  .we__working__on_it .working__mainWrapper{
    max-width: 413px;
  }
}
@media (max-width:991px){
  .we__working__on_it .working__mainWrapper{
    max-width: 450px;
    
  }
}

@media (max-width:767px){
.card ,.skils-box-mbl{
  max-width: 513px;
  width:100%;
  /* margin :0 auto; */
   margin-bottom:20px;

}
.we__working__on_it .working__mainWrapper{
  max-width: 513px;
    margin:0 auto;
  }
  
}
</style>
