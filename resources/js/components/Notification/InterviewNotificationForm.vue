<template>
  <div class="notification__popup visible" v-show="isShowNotification">
    <div class="notification__popup-box">
      <div class="notification__popup-box-head">
        <h4>
          Send Notificaiton
          <span
            >(This message would be automatically send to both employer and
            talent)</span
          >
        </h4>
      </div>
      <div class="notification__popup-box-body">
        <form @submit="onSubmit">
          <div class="popup__content">
            <img
            :src="
              authProfile.avatar
                ? this.$public + authProfile.avatar
                : this.$public + `avatar.png`
            "
            alt=""
          />
            <div class="popup__content-heading">
              <h4>{{ authProfile.first_name }} {{ authProfile.last_name }}</h4>
              <input
                type="text"
                v-model="description"
                placeholder="What do you want to talk about?"
              />
            </div>
            <div class="popup__content-body">
              <h4>Interview Date/Time</h4>
              <input
                type="datetime-local"
                v-model="datetime"
                placeholder="What do you want to talk about?"
              />
            </div>
          </div>
          <div class="popup__submit">
            <button class="popup__submit-btn primary__btn">
              Send Notification
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="notification__overlayer" @click="closePopup"></div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  props : {
    isShowNotification : Boolean,
    requestId : Number,
  },
  data() {
    return {
      description: '',
      datetime: null,
    };
  },
  mounted() {
    this.$emitter.on("resetNotifyForm", () => {
      this.resetForm();
    });
  },
  computed: {
    ...mapState("auth", {
      authProfile: (state) => state.user,
    }),
  },
  methods: {
    closePopup() {
      this.$emitter.emit("notificationStatus", false);
    },
    onSubmit(e) {
      e.preventDefault();

      if(!this.description){
        this.$toast.error("Details required.");
        return false;
      }

      if(!this.datetime){
        this.$toast.error("Please provide interview date & time.");
        return false;
      }

      var payload = {
        'id' : this.requestId,
        'description' : this.description,
        'datetime' : this.datetime,
      }

      this.$emitter.emit("InterviewScheduleDetails", payload);

    },
    resetForm(){
      this.description = '';
      this.datetime = null;
    }
  },
};
</script>

<style scoped  lang="css">
.notification__popup-box-body .popup__content {
    flex-wrap: wrap;
}
.popup__content-body {
    width: 100%;
    text-align: left;
}

.popup__content-body input {
    max-width: 219px;
}

.popup__content-body h4 {
    margin-bottom: 10px;
}
</style>
