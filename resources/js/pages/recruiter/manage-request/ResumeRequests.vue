<template>
  <div class="d__flex d__flex-h-between d__flex-v-center">
    <ComponentTitle pageTitle="Employers" />
    <Filter />
  </div>

  <div class="all__members">
    <RequestTable :Listing="employers" :tableHeading="tableHeading" />
  </div>
</template>

<script>
import ComponentTitle from "@/components/ComponentTitle.vue";
import Filter from "@/components/Filter.vue";
import RequestTable from "@/components/RequestTable.vue";

export default {
  data() {
    return {
      tableHeading: {
        col1: "Name",
        col2: "Email",
        col3: "Request For",
        col4: "Request Time",
        col5: "Request Status",
        col6: "",
      },
      employers: [
        {
          image: "user-1.png",
          name: "Eyem McLovin",
          email: "Albertmichael@mail.com",
          requestfor: "Claud ALEXANDER",
          requeststatus: "3 days ago",
          status: "accepted",
        },
      ],
    };
  },
  components: {
    ComponentTitle,
    Filter,
    RequestTable,
  },
};
</script>

<style lang="scss" scoped>
</style>
