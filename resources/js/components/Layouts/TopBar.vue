<template>
  <header class="site__header">
    <div
      class="site__header-content d__flex d__flex-h-between d__flex-v-center"
    >
      <div
        class="site__header-search d__flex d__flex-h-between d__flex-v-center"
      >
        <div class="burger__menu">
          <div class="burger__menu-strip strip">
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
        <div>
          <HeaderSearch
            v-if="
              userType == this.$constants.TALENT ||
              userType == this.$constants.EMPLOYER
            "
          />
          <AdminSearch v-else />
        </div>
      </div>

      <div class="site__header-rightbar d__flex d__flex-v-center">
        <!-- Toggle Button -->
        <div class="toggle__button d__flex d__flex-v-center"
        v-if="
              userType == this.$constants.TALENT ||
              userType == this.$constants.EMPLOYER
            ">
          <h4 class="toggle__button-heading">
            No longer looking for this role
          </h4>
          <input
            class="toggle__button-check"
            id="cb2"
            type="checkbox"
            v-model="status"
            @change="onChnage"
            :checked="this.status"
          />
          <label class="toggle__button-label" for="cb2"></label>
        </div>

        <!-- Languager Translator -->
        <!-- <div class="site__header-language-changer">
                    <a href="#">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.87 13.07L9.33 10.56L9.36 10.53C11.1 8.59 12.34 6.36 13.07 4H16V2H9V0H7V2H0V3.99H11.17C10.5 5.92 9.44 7.75 8 9.35C7.07 8.32 6.3 7.19 5.69 6H3.69C4.42 7.63 5.42 9.17 6.67 10.56L1.58 15.58L3 17L8 12L11.11 15.11L11.87 13.07ZM17.5 8H15.5L11 20H13L14.12 17H18.87L20 20H22L17.5 8ZM14.88 15L16.5 10.67L18.12 15H14.88Z" fill="#3A3541" fill-opacity="0.87"/>
                        </svg>
                    </a>
                </div> -->

        <Notification />
        <Profile />
      </div>
    </div>
  </header>
</template>

<script>
import HeaderSearch from "../HeaderSearch.vue";
import Notification from "../Notification.vue";
import Profile from "../Profiles/Profile.vue";
import UserService from "../../Services/userService";
import AdminSearch from "../../components/Admin/SearchBar/Search.vue";
import Auth from "../../auth";

export default {
  components: {
    Notification,
    Profile,
    HeaderSearch,
    AdminSearch,
  },

  data() {
    return {
      status: true,
      userType: null,
    };
  },
  computed: {
    status() {
      this.status = this.$store.state.auth.user.is_longer_interested;
    },
  },
  created() {
    this.getLoginUserType();
  },
  methods: {
    getLoginUserType() {
      this.userType = Auth.getUser().type;
    },
    async onChnage() {
      let response = await UserService.updateProfileStatus({
        status: this.status == true ? 0 : 1,
      }).catch((error) => {
        this.$toast.error(error.response.data.message);
        this.status = this.isLongerInterested;
      });
      if (response.data.status == true) {
        this.status = response.data.data.is_longer_interested;
        this.$toast.success("updated successfully!");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
