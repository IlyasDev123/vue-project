<template>
  <div class="d__flex d__flex-h-between d__flex-v-center">
    <ComponentTitle pageTitle="All Employers" />
    <Filter
      :employees="employers"
      :status="employersStatus"
      @passStatus="getEmployeesList"
    />
  </div>

  <div class="all__members">
    <router-link
      :to="{ name: 'AddEmployerPage' }"
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
      <button class="primary__btn" @click="clear" v-show="isClear">
        Clear
      </button>
    </div>
    <TableViewOne
      :employers="employers"
      :tableHeading="tableHeading"
      @updateUsers="getEmployeesList"
    />
    <Pagination 
      :previousPage="previousPage"
      :nextPage="nextPage"
      :fromPage="fromPage"
      :toPage="toPage"
      :totalPage="totalPage"
      @getPage="getPage"
    />
  </div>
</template>

<script>
import ComponentTitle from "@/components/ComponentTitle.vue";
import Pagination from "@/components/Pagination.vue";
import TableViewOne from "@/components/TableViewOne.vue";
import Filter from "@/components/Filter.vue";
import recruiterService from "../../../Services/recruiterService";

export default {
  components: {
    ComponentTitle,
    TableViewOne,
    Filter,
    Pagination
  },
  data() {
    return {
      employersStatus: [
        {
          id: 1,
          value: "Unpaid",
        },
        {
          id: 2,
          value: "Premium",
        },
        {
          id: 3,
          value: "Mark as Premium",
        },
        {
          id: 4,
          value: "Rejected",
        },
      ],
      employers: [],
      searchText: null,
      isClear: false,
      tableHeading: {
        // col1: "",
        col1: "Name",
        col2: "Refer By",
        col3: "Company Name",
        col4: "Email",
        col5: "Status",
        col6: "",
        col7: "",
      },
      selectStatus: null,
      nextPage: null,
      previousPage: null,
      fromPage: null,
      toPage: null,
      totalPage: null,
    };
  },

  mounted() {
    this.getEmployeesList();

    this.$emitter.on("refreshEmployeer", () => {
      this.getEmployeesList();
    });

    this.$emitter.on("globalSearch", (search) => {
      this.searchText = search;
      this.getEmployeesList();
    });
  },
  methods: {
    getPage(page) {
      this.getEmployeesList(this.selectStatus, page);
    },
    async getEmployeesList(value, page = null) {

      let resStatus = value == undefined ? this.selectStatus : value;
      this.selectStatus = resStatus;

      let pageParam = '';
      if(page !== undefined && page != null){
        pageParam = '?page='+page;
      }

      const payload = {
        status: this.selectStatus,
        search: this.searchText,
      };
      let response = await recruiterService
        .getEmployeesList(payload, pageParam)
        .catch((error) => {
          this.$toast.error(error.response.data.message);
        });
      this.employers = response.data.data.data;

      this.paginator(response.data.data);

      if (this.searchText) {
        this.searchText = null;
        this.isClear = true;
      }
    },
    paginator(data){
      this.nextPage = data.next_page_url;
      this.previousPage = data.prev_page_url;
      this.fromPage = data.from;
      this.toPage = data.to;
      this.totalPage = data.total;
      
      if(data.prev_page_url){
        this.previousPage = data.current_page - 1;
      }
      if(data.next_page_url){
        this.nextPage = data.current_page + 1;
      }
    },
    clear() {
      this.isClear = false;
      this.getEmployeesList();
    },
  },
};
</script>

<style lang="scss" scoped></style>
