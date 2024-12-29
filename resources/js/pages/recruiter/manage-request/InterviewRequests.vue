<template>
  <div class="d__flex d__flex-h-between d__flex-v-center">
    <ComponentTitle pageTitle="Employers" />
    <!-- <Filter /> -->
  </div>

  <div class="all__members">
    <div>
      <button class="primary__btn" @click="clear" v-show="isClear">
        Clear
      </button>
    </div>

    <InterviewRequestTable
      :Listing="employers"
      :tableHeading="tableHeading"
      :isInterviewRequest="true"
    />
  </div>
</template>

<script>
import ComponentTitle from "@/components/ComponentTitle.vue";
import Filter from "@/components/Filter.vue";
import InterviewRequestTable from "@/components/Request/InterviewRequestTable.vue";
import ManageRequestService from "@/Services/manageRequestService";

export default {
  data() {
    return {
      tableHeading: {
        col1: "Employer Name",
        col2: "Employer Email",
        col3: "Talent Name",
        col4: "Request Time",
        col5: "Request Status",
        col6: "",
      },
      employers: [],
      searchText: null,
      isClear: false,
    };
  },
  components: {
    ComponentTitle,
    Filter,
    InterviewRequestTable,
  },
  mounted() {
    this.getInterviewRequests();

    this.$emitter.on("InterviewScheduleDetails", (payload) => {
      this.ScheduleInterviewRequests(payload);
    });

    this.$emitter.on("globalSearch", (search) => {
      this.searchText = search;
      this.getFullAccessRequest();
      this.isClear = true;
    });
  },
  methods: {
    async getInterviewRequests(data) {
      let response = await ManageRequestService.getInterviewRequests(
        data
      ).catch((error) => {
        return this.$toast.error(error.response.data.message);
      });
      this.employers = response.data.data;
    },

    async ScheduleInterviewRequests(data) {
      await ManageRequestService.ScheduleInterviewRequests(data)
        .then((data) => {
          this.$toast.success(data.data.message);
          this.getInterviewRequests();
          this.$emitter.emit("notificationStatus", false);
        })
        .catch((error) => {
          return this.$toast.error(error.response.data.message);
        });
    },

    clear() {
      this.searchText = null;
      this.getFullAccessRequest();
      this.isClear = false;
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
