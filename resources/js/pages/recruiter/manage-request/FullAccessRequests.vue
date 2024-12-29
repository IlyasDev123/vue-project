<template>
  <div class="d__flex d__flex-h-between d__flex-v-center">
    <ComponentTitle pageTitle="Employers" />
    <!-- <NotificationFilter :filters="filter" /> -->
  </div>
  <div class="all__members">
    <div>
      <button class="primary__btn" @click="clear" v-show="isClear">
        Clear
      </button>
    </div>
    <RequestTable
      :Listing="employers"
      :tableHeading="tableHeading"
      :isInterviewRequest="false"
    />
  </div>
</template>

<script>
import ComponentTitle from "@/components/ComponentTitle.vue";
import RequestTable from "@/components/RequestTable.vue";
import ManageRequestService from "@/Services/manageRequestService";
import NotificationFilter from "@/components/Notification/NotificationFilter.vue";

export default {
  data() {
    return {
      tableHeading: {
        col1: "Name",
        col2: "Email",
        // col3: "Request For",
        col4: "Request Time",
        col5: "Request Status",
        col6: "",
      },
      employers: [],
      searchText: null,
      isClear: false,
      filter: [
        {
          id: 1,
          name: "Ascending",
        },
        {
          id: 2,
          name: "Descending",
        },
      ],
    };
  },
  components: {
    ComponentTitle,
    NotificationFilter,
    RequestTable,
  },
  mounted() {
    this.getFullAccessRequest();

    this.$emitter.on("accessFullRequest", (data) => {
      this.updateFullStatus(data);
    });
    this.$emitter.on("fullAccessFilter", (data) => {
      this.getFullAccessRequest(data);
    });

    this.$emitter.on("globalSearch", (search) => {
      this.searchText = search;
      this.getFullAccessRequest();
      this.isClear = true;
    });
  },
  methods: {
    async getFullAccessRequest(data) {
      let response = await ManageRequestService.getFullAccessRequest({
        search: this.searchText,
      }).catch((error) => {
        return this.$toast.error(error.response.data.message);
      });
      this.employers = response.data.data;
    },

    async updateFullStatus(data) {
      let response = await ManageRequestService.updateFullAccessRequest(
        data
      ).catch((error) => {
        return this.$toast.error(error.response.data.message);
      });
      this.getFullAccessRequest();
    },

    clear() {
      this.searchText = null;
      this.getFullAccessRequest();
      this.isClear = false;
    },
  },
};
</script>


