<script>
import Auth from "../../auth";
import { mapMutations, mapState, mapActions } from "vuex";
export default {
  props: {
    recruiterMenuItems: Array,
    employerMenuItems: Array,
    talentMenuItems: Array,
    superAdminMenuItems: Array,
  },
  created() {
    let user = JSON.parse(localStorage.getItem("user")) || [];
    this.userType = user.type;
    this.getCurrentUser();
    user.type == this.$constants.TALENT ? this.getSkill() : this.getPositions();
  },
  data() {
    return {
      userType: null,
      isShowSubmneu: true,
      active: false,
    };
  },
  methods: {
    ...mapActions("auth", {
      getCurrentUser: "getCurrentUser",
      getSkill: "getSkill",
      getPositions: "getPositions",
    }),
    logout() {
      Auth.logout();
      this.$router.push({ name: "Login" }).then(() => {
        this.$router.go();
      });
    },
    IsActive(path) {
      return this.$route.path.split("/")[1] === path.split("/")[1];
    },
    showSubMenu() {
      this.isShowSubmneu = this.isShowSubmneu == true ? false : true;
    },
  },
};
</script>

<template>
  <div>
    <aside class="side__bar">
      <div class="side__bar-content">
        <div class="side__bar-cross">
          <svg
            width="10"
            height="10"
            viewBox="0 0 10 10"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M1.64962 1L1 1.64962L4.35038 5L1 8.35038L1.64962 9L5 5.64962L8.35038 9L9 8.35038L5.64962 5L9 1.64962L8.35038 1L5 4.35038L1.64962 1Z"
              fill="#000"
              stroke="#000"
            />
          </svg>
        </div>
        <div class="side__bar-logo">
          <img src="../../assets/img/logo.svg" alt="" />
        </div>
        <nav class="side__bar-menu">
          <ul class="side__bar-items">
            <!--------------------------------------------------------------TALENT MENU ITEMS ----------------------------------------------------------------------->
            <div v-if="userType == this.$constants.TALENT">
              <li
                v-for="sideMenuItem in talentMenuItems"
                :key="sideMenuItem"
                class="side__bar-item"
              >
                <div>
                  <router-link
                    :to="{ name: sideMenuItem.routeName }"
                    v-bind:class="{
                      'active router-link-exact-active': IsActive(
                        sideMenuItem.path
                      ),
                    }"
                  >
                    <img :src="this.$public + sideMenuItem.src" alt="" />
                    <span>{{ sideMenuItem.title }}</span>
                  </router-link>
                </div>
                <div
                  v-if="sideMenuItem.children == true"
                  v-show="isShowSubmneu == true"
                  class="submenu__items"
                >
                  <router-link
                    v-for="child in this.$store.state.auth.userSkill"
                    :key="child.id"
                    :to="'/edit-profile/' + child.id + ''"
                  >
                    <img :src="this.$public + sideMenuItem.src + ''" alt="" />
                    <span>{{ child.profession_name }}</span>
                  </router-link>
                </div>
              </li>
            </div>
            <!-------------------------------------------------------------- TALENT END MENU ITEMS- ----------------------------------------------------------------------->

            <!-------------------------------------------------------------- EMPLOY MENU ITEMS- ----------------------------------------------------------------------->
            <div v-if="userType == this.$constants.EMPLOYER">
              <li
                v-for="sideMenuItem in employerMenuItems"
                :key="sideMenuItem"
                class="side__bar-item"
              >
                <router-link
                  :to="{ name: sideMenuItem.routeName }"
                  v-bind:class="{
                    'active router-link-exact-active': IsActive(
                      sideMenuItem.path
                    ),
                  }"
                >
                  <img :src="this.$public + sideMenuItem.src" alt="" />
                  <span>{{ sideMenuItem.title }}</span>
                </router-link>
              </li>
            </div>
            <!--------------------------------------------------------------EMPLOYER END MENU ITEMS ----------------------------------------------------------------------->

            <!-------------------------------------------------------------- RECURITER MENU ITEMS- ----------------------------------------------------------------------->
            <div v-if="userType == this.$constants.RECURITER">
              <li
                v-for="sideMenuItem in recruiterMenuItems"
                :key="sideMenuItem"
                class="side__bar-item"
              >
                <router-link
                  :to="{ name: sideMenuItem.routeName }"
                  v-bind:class="{
                    'active router-link-exact-active': IsActive(
                      sideMenuItem.path
                    ),
                  }"
                >
                  <img :src="this.$public + sideMenuItem.src + ''" alt="" />
                  <span>{{ sideMenuItem.title }}</span>
                </router-link>
              </li>
            </div>
            <!-------------------------------------------------------------- RECURITER MENU ITEMS END- ----------------------------------------------------------------------->

            <!-------------------------------------------------------------- SUPER ADMIN MENU ITEMS- ----------------------------------------------------------------------->
            <div v-if="userType == this.$constants.ADMIN">
              <li
                v-for="sideMenuItem in superAdminMenuItems"
                :key="sideMenuItem"
                class="side__bar-item"
              >
                <router-link
                  :to="{ name: sideMenuItem.routeName }"
                  v-bind:class="{
                    'active router-link-exact-active': IsActive(
                      sideMenuItem.path
                    ),
                  }"
                >
                  <img :src="this.$public + sideMenuItem.src + ''" alt="" />
                  <span>{{ sideMenuItem.title }}</span>
                </router-link>
              </li>
            </div>

            <!-------------------------------------------------------------- SUPERADMIN END MENU ITEMS- ----------------------------------------------------------------------->
          </ul>
        </nav>
      </div>
      <div class="side__bar-logout">
        <button class="logout__btn">
          <svg
            width="15"
            height="9"
            viewBox="0 0 15 9"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M11.6592 2L11.1569 2.48678L12.778 4.0607H6.85449V4.753H12.778L11.1569 6.32422L11.6592 6.81641L14.1452 4.40685L11.6592 2Z"
              fill="black"
            />
            <path
              d="M9.06871 0C9.65744 0 10.1401 0.467848 10.1401 1.03846V2.76923H9.42585V1.03846C9.42585 0.84375 9.2696 0.692308 9.06871 0.692308H1.92585C1.72496 0.692308 1.56871 0.84375 1.56871 1.03846V7.96154C1.56871 8.15625 1.72496 8.30769 1.92585 8.30769H9.06871C9.2696 8.30769 9.42585 8.15625 9.42585 7.96154V6.23077H10.1401V7.96154C10.1401 8.53215 9.65744 9 9.06871 9H1.92585C1.33712 9 0.854423 8.53215 0.854423 7.96154V1.03846C0.854423 0.467848 1.33712 0 1.92585 0H9.06871Z"
              fill="black"
            />
          </svg>
          <a @click="logout"><span>log out</span></a>
        </button>
      </div>
    </aside>
  </div>
</template>

<style lang="css" scoped>
.icons {
  width: 20px;
  height: 20px;
}
</style>
