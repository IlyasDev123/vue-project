<template>
  <!-- <div v-for="profile in profiles" :key="profile"> -->
  <div
    class="we__working__on_it d__flex d__flex-v-center"
    v-show="profiles.length == 0"
  >
    <div class="working__mainWrapper">
      <div class="img__wrapper text__center">
        <img
          src="../../../assets/images/talent-images/working__Man.png"
          alt="workingMan"
        />
      </div>
      <h1 class="text__center fw__700">We’re working on it!</h1>
      <p class="text__center">
        Our Chirrrp Matching System is analyzing companies that match your
        search. Don't worry, this typically only takes 24 hours to update with
        fresh new companies for you to review
      </p>
    </div>
  </div>
  <div class="refer__post">
    <div class="refer__post-box" v-for="profile in profiles" :key="profile">
      <div class="refer__post-box-img">
        <img src="@/assets/img/cv.png" alt="" />
      </div>
      <div
        class="refer__post-box-info d__flex d__flex-h-between d__flex-v-center"
      >
        <div
          class="
            refer__post-box-info-inner
            d__flex d__flex-h-between d__flex-v-center
          "
        >
          <!-- src="@/assets/images/talent-images/cp-reffer.png" -->
          <img :src="this.$public + profile.talent.avatar" alt=" " />
          <div class="d__flex d__flex-d-col d__flex-h-center">
            <h5>
              {{ profile.talent.first_name + " " + profile.talent.last_name }}
            </h5>
            <span>{{ profile.position.profession.name }}</span>
            <router-link
              :to="{
                name: 'MyTalentDetail',
                params: { id: profile.talent.id },
              }"
              class="refer__post-box-info-link"
            >
              View Role
            </router-link>
          </div>
        </div>
        <a
          @click="deletePosition(profile.id)"
          class="del-button refer__post-box-info-link"
        >
          <svg
            width="37"
            height="35"
            viewBox="0 0 37 35"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <rect
              opacity="0.18"
              x="0.157227"
              width="36.8421"
              height="35"
              rx="7.36842"
              fill="#E62727"
            ></rect>
            <path
              d="M18.5792 9.82422C17.3143 9.82422 16.2765 10.862 16.2765 12.1268H13.8765C13.8423 12.121 13.8077 12.1182 13.773 12.1186C13.7451 12.1193 13.7173 12.1221 13.6898 12.1268H12.2469C12.1707 12.1258 12.0949 12.1399 12.0241 12.1683C11.9534 12.1968 11.8889 12.239 11.8346 12.2925C11.7803 12.3461 11.7371 12.4099 11.7077 12.4803C11.6782 12.5507 11.6631 12.6262 11.6631 12.7025C11.6631 12.7788 11.6782 12.8543 11.7077 12.9247C11.7371 12.9951 11.7803 13.0589 11.8346 13.1125C11.8889 13.166 11.9534 13.2083 12.0241 13.2367C12.0949 13.2652 12.1707 13.2792 12.2469 13.2782H13.2064V23.0643C13.2064 24.2233 14.1582 25.1751 15.3171 25.1751H21.8412C23.0001 25.1751 23.952 24.2233 23.952 23.0643V13.2782H24.9114C24.9877 13.2792 25.0634 13.2652 25.1342 13.2367C25.205 13.2083 25.2694 13.166 25.3238 13.1125C25.3781 13.0589 25.4212 12.9951 25.4507 12.9247C25.4801 12.8543 25.4953 12.7788 25.4953 12.7025C25.4953 12.6262 25.4801 12.5507 25.4507 12.4803C25.4212 12.4099 25.3781 12.3461 25.3238 12.2925C25.2694 12.239 25.205 12.1968 25.1342 12.1683C25.0634 12.1399 24.9877 12.1258 24.9114 12.1268H23.4708C23.409 12.1167 23.3459 12.1167 23.2841 12.1268H20.8818C20.8818 10.862 19.844 9.82422 18.5792 9.82422ZM18.5792 10.9755C19.2217 10.9755 19.7305 11.4844 19.7305 12.1268H17.4279C17.4279 11.4844 17.9367 10.9755 18.5792 10.9755ZM14.3577 13.2782H22.8007V23.0643C22.8007 23.6009 22.3778 24.0238 21.8412 24.0238H15.3171C14.7805 24.0238 14.3577 23.6009 14.3577 23.0643V13.2782ZM17.227 15.1888C17.0744 15.1912 16.9291 15.254 16.8228 15.3635C16.7166 15.473 16.6581 15.6201 16.6603 15.7727V21.5293C16.6592 21.6055 16.6733 21.6813 16.7018 21.7521C16.7302 21.8229 16.7725 21.8873 16.826 21.9416C16.8796 21.9959 16.9434 22.0391 17.0138 22.0685C17.0842 22.098 17.1597 22.1131 17.236 22.1131C17.3123 22.1131 17.3878 22.098 17.4582 22.0685C17.5286 22.0391 17.5924 21.9959 17.6459 21.9416C17.6995 21.8873 17.7417 21.8229 17.7702 21.7521C17.7986 21.6813 17.8127 21.6055 17.8116 21.5293V15.7727C17.8127 15.6956 17.7984 15.6191 17.7694 15.5478C17.7404 15.4764 17.6973 15.4115 17.6428 15.3571C17.5883 15.3026 17.5234 15.2597 17.452 15.2308C17.3805 15.2018 17.304 15.1876 17.227 15.1888ZM19.9134 15.1888C19.7608 15.1912 19.6155 15.254 19.5092 15.3635C19.403 15.473 19.3445 15.6201 19.3467 15.7727V21.5293C19.3456 21.6055 19.3597 21.6813 19.3882 21.7521C19.4166 21.8229 19.4589 21.8873 19.5124 21.9416C19.566 21.9959 19.6298 22.0391 19.7002 22.0685C19.7706 22.098 19.8461 22.1131 19.9224 22.1131C19.9987 22.1131 20.0742 22.098 20.1446 22.0685C20.215 22.0391 20.2788 21.9959 20.3323 21.9416C20.3859 21.8873 20.4281 21.8229 20.4566 21.7521C20.485 21.6813 20.4991 21.6055 20.498 21.5293V15.7727C20.4991 15.6956 20.4848 15.6191 20.4558 15.5478C20.4268 15.4764 20.3837 15.4115 20.3292 15.3571C20.2747 15.3026 20.2098 15.2597 20.1384 15.2308C20.0669 15.2018 19.9904 15.1876 19.9134 15.1888Z"
              fill="#EF4E4E"
            ></path>
          </svg>
        </a>
      </div>
    </div>

    <!-- ======== end reffer main ======== -->
  </div>
</template>
<script>
import userService from "../../../Services/userService";
import companyService from "../../../Services/companyService";
export default {
  name: "MyTalent",
  data() {
    return {
      profiles: {},
    };
  },
  mounted() {
    this.getMyTalents();
  },
  methods: {
    async getMyTalents(search) {
      let response = await companyService
        .getMyTalentList({ searchItem: search })
        .catch((error) => {
          return this.$toast.error(error.response.data.message);
        });
      this.profiles = response.data.data.data;
    },

    async deletePosition(id) {
      // let id = this.company.id;
      let response = await userService.deletePortfolio(id).catch((error) => {
        return this.$toast.error(error.response.data.message);
      });
      this.$toast.success(response.data.message);
      this.getMyTalents();
    },
  },
};
</script>
<style scoped>
.del-button {
  cursor: pointer;
}
</style>
