<template>
  <div class="table__box">
    <table class="member__table talent__member--table">
      <thead>
        <tr>
          <th v-for="heading in tableHeading" :key="heading.id">
            {{ heading }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="list in Listing" :key="list.id">
          <td>
            <!-- {{ list }} -->
            <div class="member__info d__flex">
              <div class="member__img">
                <img :src="$public + list?.avatar" alt="" />
              </div>
              <div class="member__name">
                <h4>{{ list?.first_name }} {{ list?.last_name }}</h4>
              </div>
            </div>
          </td>
          <td>{{ list.email }}</td>
          <td v-show="list?.requestfor">{{ list?.requestfor }}</td>
          <td>{{ list?.created_at }}</td>
          <td>
            <div class="member__status" :class="BindStatus(list.status)">
              <select @change="onChange($event, list)" class="select-box">
                <option
                  :value="this.$constants.PREMIUM_STATUS.Pending"
                  disabled
                  selected
                >
                  Pending
                </option>
                <option :value="this.$constants.PREMIUM_STATUS.Free">
                  Rejected
                </option>
                <option :value="this.$constants.PREMIUM_STATUS.Premium">
                  Accept
                </option>
              </select>
            </div>
          </td>
          <td>
            <button
              class="send__notification"
              @click="showNotification"
              v-show="this.isInterviewRequest == true"
            >
              <span>Send Notification</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Send Notification Popup -->
  <interview-notification-form></interview-notification-form>
</template>

<script>
import { boolean } from "yup/lib/locale";
import InterviewNotificationForm from "./Notification/InterviewNotificationForm.vue";
export default {
  components: { InterviewNotificationForm },
  name: "RequestTable",

  props: {
    tableHeading: Object,
    Listing: Object,
    isInterviewRequest: Boolean,
  },
  data() {
    return {
      isShowNotification: false,
    };
  },
  methods: {
    showNotification() {
      this.isShowNotification = true;
    },
    closePopup() {
      this.isShowNotification = false;
    },

    BindStatus(status) {
      switch (status) {
        case this.$constants.PREMIUM_STATUS.premium:
          return "active__member";
        case this.$constants.PREMIUM_STATUS.pending:
          return "pending__member";
        case this.$constants.PREMIUM_STATUS.free:
          return "deactived__member";
        default:
          return "normal__member";
      }
    },

    onChange(event, list) {
      let payload = {
        status: event.target.value,
        notification_id: list.id,
        company_meta_id: list.company_meta_id,
        email: list.email,
      };
      this.$emitter.emit("accessFullRequest", payload);
    },
  },
};
</script>

<style scoped>
.select-box {
  background: lightgrey;
  border: none;
}
</style>
