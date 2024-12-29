<template>
  <div class="d__flex d__flex-h-between d__flex-v-center">
    <ComponentTitle pageTitle="All Talent" />

    <Filter
      :talent="talents"
      :status="talentStatus"
      @passStatus="getTalentList"
    />
  </div>
  <div class="all__members">
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
      <button class="primary__btn" @click="clear" v-show="isClear">
        Clear
      </button>
    </div>
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
          <tr v-for="talent in talents" :key="talent.id">
            <td>
              <div class="member__info d__flex">
                <router-link
                  :to="{
                    name: 'DetailTalentPage',
                    params: { id: talent.id },
                  }"
                >
                  <div class="member__area">
                    <div class="member__img">
                      <img :src="this.$public + talent?.avatar" alt="" />
                    </div>
                    <div class="member__name">
                      <h4>
                        {{ talent?.first_name + " " + talent?.last_name }}
                      </h4>
                    </div>
                  </div>
                </router-link>
              </div>
            </td>
            <td>{{ talent?.email }}</td>
            <td>
              {{
                talent?.children?.first_name + " " + talent?.children?.last_name
              }}
            </td>
            <!-- <td></td> -->

            <td :format="DatePickerFormat">
              {{ formatDate(talent?.updated_at) }}
            </td>
            <td>
              <div
                class="member__status"
                :class="bindStatus(talent?.is_blocked)"
              >
                <select
                  @change="onChange($event, talent)"
                  v-if="authProfile.type === this.$constants.ADMIN" 
                  :class="bindClass(talent?.is_blocked)"
                >
                  <option value="0" :selected="talent.is_blocked === 0">
                    Active
                  </option>
                  <option value="1" :selected="talent.is_blocked === 1">
                    Blocked
                  </option>
                </select>
                <span v-if="authProfile.type !== this.$constants.ADMIN">{{
                  statusRequired(talent?.talent_meta?.status)
                }}</span>
              </div>
            </td>
            <td>
              <button
                class="member__delete"
                v-if="authProfile.type == this.$constants.ADMIN"
                @click="deleteUser(talent.id)"
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
import moment from "moment";
import ComponentTitle from "@/components/ComponentTitle.vue";
import recruiterService from "../../../Services/recruiterService";
import Filter from "@/components/Filter.vue";
import Pagination from "@/components/Pagination.vue"
import userService from "../../../Services/userService";
import { mapState } from "vuex";

export default {
  components: {
    Filter,
    ComponentTitle,
    Pagination
  },
  computed: {
    ...mapState("auth", {
      authProfile: (state) => state.user,
    }),
  },
  mounted: {},
  data() {
    return {
      talentStatus: [
        {
          id: "all",
          value: "All",
        },
        {
          id: 0,
          value: "Active",
        },
        {
          id: 1,
          value: "Blocked",
        },
      ],
      selectStatus: null,
      talents: [],
      searchText: null,
      isClear: false,
      DatePickerFormat: "MM/dd/yyyy hh:mm",
      tableHeading: {
        col2: "Name",
        col3: "Email",
        col4: "Referred by",
        col5: "Last Login",
        col6: "Status",
      },
      nextPage: null,
      previousPage: null,
      fromPage: null,
      toPage: null,
      totalPage: null,
    };
  },
  mounted() {
    this.getTalentList();

    this.$emitter.on("globalSearch", (search) => {
      this.searchText = search;
      this.getTalentList();
    });
  },
  methods: {
    formatDate(date) {
      let formatDate = moment(date).format("MM/DD/YYYY hh:mm");
      return formatDate;
    },
    bindStatus(status) {
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
          return "Active";
        case 2:
          return "Pending";
      }
    },
    getPage(page) {
      this.getTalentList(this.selectStatus, page);
    },
    getTalentList(sendToStatus, page = null) {
      let resStatus = sendToStatus == undefined ? this.selectStatus : sendToStatus;
      this.selectStatus = resStatus;

      let pageParam = '';
      if(page !== undefined && page != null){
        pageParam = '?page='+page;
      }

      const payload = {
        search: this.searchText,
        status: this.selectStatus,
      };
      recruiterService
        .getTalentList(payload, pageParam)
        .then((data) => {
          this.talents = data.data.data.data;

          this.paginator(data.data.data);

          if (this.searchText) {
            this.searchText = null;
            this.isClear = true;
          }
        })
        .catch((error) => {
          this.$toast.error(error.response.data.message);
        });
    },
    deleteUser(id) {
      if (id) {
        if (confirm("Do you really want to delete this record?")) {
          userService
          .deleteUser(id)
          .then((data) => {
            this.getTalentList();
            this.$toast.success(data.data.message);
          })
          .catch((error) => {
            this.$toast.error(error.response.data.message);
          });
        }
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
      this.getTalentList();
    },

    onChange(event, talent) {
      userService
        .updateUserBlockStatus({
          id: talent.id,
          status: event.target.value,
        })
        .then((data) => {
          this.getTalentList();
          this.$toast.success(data.data.message);
        })
        .catch((error) => {
          this.$toast.error(error.response.data.message);
        });
    },
  },
};
</script>

<style scoped>

</style>
