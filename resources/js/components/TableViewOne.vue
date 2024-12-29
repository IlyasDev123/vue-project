<template>
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
        <tr v-for="employer in employers" :key="employer.id">
          <td>
            <div class="member__info d__flex">
              <router-link
                :to="{
                  name: 'DetailEmployerPage',
                  params: { id: employer.id },
                }"
              >
                <div class="member__area">
                  <div class="member__img">
                    <img :src="this.$public + employer?.avatar" alt="" />
                  </div>
                  <div class="member__name">
                    <h4>
                      {{ employer?.first_name + " " + employer?.last_name }}
                    </h4>
                  </div>
                </div>
              </router-link>
            </div>
          </td>
          <td>
            {{ employer?.children?.first_name }} {{ employer?.children?.last_name }}
          </td>
          <td>{{ employer?.company_meta?.company_name }}</td>
          <td>{{ employer?.email }}</td>
          <td>
            <div
              class="member__status"
              :class="bindStatus(employer?.company_meta?.premium_status)"
            >
              <span>{{
                statusRequired(employer?.company_meta?.premium_status)
              }}</span>
            </div>
          </td>
          <td>
            <div
              class="member__status"
              :class="bindBlockStatus(employer?.is_blocked)"
            >
              <select
                @change="onChange($event, employer)"
                v-if="authProfile.type === this.$constants.ADMIN" 
                :class="bindClass(employer?.is_blocked)"
              >
                <option value="0" :selected="employer.is_blocked === 0">
                  Active
                </option>
                <option value="1" :selected="employer.is_blocked === 1">
                  Blocked
                </option>
              </select>
              <span v-if="authProfile.type !== this.$constants.ADMIN">{{
                statusRequired(employer?.company_meta?.status)
              }}</span>
            </div>
          </td>
          <td>
            <button
              v-if="authProfile.type == this.$constants.ADMIN"
              @click="deleteUser(employer.id)"
              class="member__delete"
            >
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
</template>
<script>
import userService from "../Services/userService";
import { mapState } from "vuex";

export default {
  props: {
    tableHeading: Object,
    employers: Object,
  },
  computed: {
    ...mapState("auth", {
      authProfile: (state) => state.user,
    }),
  },
  methods: {
    bindStatus(premium_status) {
      switch (premium_status) {
        case 1:
          return "normal__member";
        case 2:
          return "premium__member";
        default:
          return "normal";
      }
    },
    bindBlockStatus(status) {
      switch (status) {
        case 0:
          return "active__member";
        case 1:
          return "pending__member";
      }
    },
    bindClass(status) {
      switch (status) {
        case 0:
          return "active-status";
        case 1:
          return "block-status";
      }
    },
    statusRequired(status) {
      switch (status) {
        case 1:
          return "Unpaid";
        case 2:
          return "Premium";
        case 3:
          return "Mark As Premium";
        case 4:
          return "Rejected";
      }
    },
    deleteUser(id) {
      if (id) {
        if (confirm("Do you really want to delete this record?")) {
          userService
            .deleteUser(id)
            .then((data) => {
              this.$toast.success(data.data.message);
              this.$emitter.emit("refreshEmployeer");
            })
            .catch((error) => {
              this.$toast.error(error.response.data.message);
            });
        }
      }
    },
    onChange(event, employer) {
      userService
        .updateUserBlockStatus({
          id: employer.id,
          status: event.target.value,
        })
        .then((data) => {
          this.$toast.success(data.data.message);
          this.$emitter.emit("refreshEmployeer");
        })
        .catch((error) => {
          this.$toast.error(error.response.data.message);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
