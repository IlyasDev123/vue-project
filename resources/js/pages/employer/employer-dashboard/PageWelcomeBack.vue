<template>
  <div class="d__flex">
    <div class="all_position">
      <router-link
        :to="{ name: 'EmployerSelectIndustry' }"
        class="add__new d__flex d__flex-v-center"
        v-show="isEditPosition"
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
        <span>Add New Position</span>
      </router-link>
      <div class="card">
        <div v-for="position in this.positions" :key="position.id">
          <a
            href="#"
            @click="onClick(position.id)"
            :class="id == position.id ? `isActive` : null"
            >{{ position?.profession?.name }}</a
          >
        </div>
      </div>
    </div>
    <div class="we__working__on_it d__flex">
      <div class="working__mainWrapper" v-if="isEditPosition == false">
        <div class="img__wrapper text__center">
          <img
            src="@/assets/images/talent-images/shaking__hand.svg"
            alt="shaking__hand"
          />
        </div>
        <h1 class="text__center fw__700">Welcome Back!</h1>
        <p class="text__center">
          Are you experienced across multiple roles and industries? so, please
          add new you’re interested by answering few questions below!
        </p>
        <router-link
          :to="{ name: 'EmployerSelectIndustry' }"
          class="big__blue__btn"
        >
          Add New Position
        </router-link>
      </div>
      <div v-else>
        <UpdatePosition :positionId="id" />
      </div>
    </div>
  </div>
  <!-- <router-view ref="rv"></router-view> -->
</template>
<script>
import { mapState } from "vuex";
import UpdatePosition from "../positions/UpdatePosition.vue";
export default {
  components: { UpdatePosition },
  name: "PageWelcomeBack",

  data() {
    return {
      isEditPosition: false,
      data: {},
      id: null,
      isExactActive: true,
    };
  },
  updated() {
    this.isExactActive = typeof this.$refs.rv === "undefined";
    console.log(this.isExactActive);
  },

  mounted() {
    this.isExactActive = typeof this.$refs.rv === "undefined";
    console.log("*******************", typeof this.$refs.rv === "undefined");
  },
  computed: {
    ...mapState("auth", {
      positions: (state) => state.companyPositions,
    }),
  },
  methods: {
    onClick(id) {
      this.id = id;
      this.isEditPosition = true;
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
.working__mainWrapper {
  height: max-content;
}

@media (max-width: 992px) {
  .we__working__on_it {
    min-width: unset;
    width: calc(100% - 220px);
  }
  section.select__role.crafting__form.edit__skill {
    min-width: unset !important;
  }
}
@media (max-width: 767px) {
  .we__working__on_it {
    width: 100%;
  }
  .all_position {
    width: 100%;
    margin-bottom: 20px;
  }
  .card {
    width: 100%;
  }
}
</style>

