<template>
  <div class="d__flex d__flex-h-between d__flex-v-center">
    <ComponentTitle pageTitle="All Talent" />

    <Filter />
  </div>
  <!-- ADD New -->
  <router-link
    :to="{ name: 'AddTalentPage' }"
    class="add__new d__flex d__flex-v-center"
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
    <span>Add New</span>
  </router-link>
  <div>
    <button class="primary__btn" @click="clear" v-show="isClear">Clear</button>
  </div>
  <div class="all__members">
    <div class="table__box">
      <table class="member__table">
        <thead>
          <tr>
            <th v-for="heading in tableHeading" :key="heading.id">
              {{ heading }}
            </th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="list in employers" :key="list.id">
            <td>
              <div class="member__info d__flex">
                <div class="member__img">
                  <img :src="require(`@/assets/img/${list.image}`)" alt="" />
                </div>
                <div class="member__name">
                  <h4>{{ list.name }}</h4>
                </div>
              </div>
            </td>
            <td>{{ list.email }}</td>
            <td>{{ list.refferBy }}</td>
            <td>{{ list.lastLogin }}</td>
            <td>
              <div class="member__status" :class="BindStatus(list.status)">
                <span>{{ list.status }}</span>
              </div>
            </td>
            <td>
              <button class="member__delete">
                <svg
                  width="14"
                  height="14"
                  viewBox="0 0 14 14"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10.3333 2.99992H13.6666V4.33325H12.3333V12.9999C12.3333 13.1767 12.263 13.3463 12.138 13.4713C12.013 13.5963 11.8434 13.6666 11.6666 13.6666H2.33325C2.15644 13.6666 1.98687 13.5963 1.86185 13.4713C1.73682 13.3463 1.66659 13.1767 1.66659 12.9999V4.33325H0.333252V2.99992H3.66659V0.999919C3.66659 0.823108 3.73682 0.653538 3.86185 0.528514C3.98687 0.40349 4.15644 0.333252 4.33325 0.333252H9.66659C9.8434 0.333252 10.013 0.40349 10.138 0.528514C10.263 0.653538 10.3333 0.823108 10.3333 0.999919V2.99992ZM10.9999 4.33325H2.99992V12.3333H10.9999V4.33325ZM4.99992 6.33325H6.33325V10.3333H4.99992V6.33325ZM7.66659 6.33325H8.99992V10.3333H7.66659V6.33325ZM4.99992 1.66659V2.99992H8.99992V1.66659H4.99992Z"
                    fill="#91A4B7"
                  />
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import ComponentTitle from "@/components/ComponentTitle.vue";
import Filter from "@/components/Filter.vue";
export default {
  components: {
    Filter,
    ComponentTitle,
  },
  data() {
    return {
      tableHeading: {
        col1: "name",
        col2: "email",
        col3: "Referred by",
        col4: "Last Login",
        col5: "Status",
        col6: "",
      },

      employers: [],
    };
  },
  methods: {
    BindStatus(status) {
      switch (status) {
        case "Premium":
          return "premium__member";
        case "Normal":
          return "normal__member";
        default:
          return "normal__member";
      }
    },

    clear() {
      this.isClear = false;
      this.getRecruiterList();
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
