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
              <span>Pending</span>
            </div>
          </td>
          <td>
            <button
              class="send__notification"
              @click="showNotification(list?.id)"
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
  <InterviewNotificationForm 
  :isShowNotification="this.isShowNotification" 
  :requestId="this.requestId"
   />
</template>

<script>
import { boolean } from "yup/lib/locale";
import InterviewNotificationForm from "../Notification/InterviewNotificationForm.vue";
export default {
  components: { 
    InterviewNotificationForm 
  },
  name: "InterviewRequestTable",

  props: {
    tableHeading: Object,
    Listing: Object,
    isInterviewRequest: Boolean,
  },
  data() {
    return {
      isShowNotification: false,
      description: '',
      datetime: '',
    };
  },
  mounted() {
    this.$emitter.on("notificationStatus", () => {
      this.closePopup();
    });
  },
  methods: {
    showNotification($reqId) {
      this.isShowNotification = true;
      this.requestId = $reqId;
      this.$emitter.emit("resetNotifyForm");
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

<style lang="scss" scoped></style>
