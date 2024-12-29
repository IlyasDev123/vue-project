<template>
  <div class="main__content-box matches__content-box match-h3">
    <div class="d__flex d__flex-h-between d__flex-v-center match__title">
      <ComponentTitle pageTitle="All Talents" />
    </div>

    <div class="search__box match__search">
      <button class="match_serach-btn" @click="onKeyPress">
        <svg
          width="18"
          height="18"
          viewBox="0 0 18 18"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M12.5 11H11.71L11.43 10.73C12.41 9.59 13 8.11 13 6.5C13 2.91 10.09 0 6.5 0C2.91 0 0 2.91 0 6.5C0 10.09 2.91 13 6.5 13C8.11 13 9.59 12.41 10.73 11.43L11 11.71V12.5L16 17.49L17.49 16L12.5 11ZM6.5 11C4.01 11 2 8.99 2 6.5C2 4.01 4.01 2 6.5 2C8.99 2 11 4.01 11 6.5C11 8.99 8.99 11 6.5 11Z"
            fill="#B1BBCD"
          />
        </svg>
      </button>

      <input
        type="text"
        placeholder="Search"
        v-model="searching"
        v-on:keypress.enter="onKeyPress"
      />
    </div>

    <div class="all__members">
      <div class="table__box">
        <table class="member__table">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Interested</th>
              <th>Recommmend By</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="talent in talents" :key="talent.id">
              <td>
                <label for="" class="matches__content-box-check">
                  <input
                    type="checkbox"
                    name=""
                    :value="talent.id"
                    v-model="talentIds"
                    :id="`check__${talent.id}`"
                    @change="onChange(talent.id)"
                  />
                  <span class="checkmark"></span>
                </label>
              </td>
              <td>
                <div class="member__info d__flex">
                  <div class="member__img">
                    <img :src="this.$public + talent?.avatar" alt="" />
                  </div>
                  <div class="member__name">
                    <h4>{{ talent?.name }}</h4>
                  </div>
                </div>
              </td>
              <td>{{ talent?.profession }}</td>
              <td>
                {{ talent?.recommend_by }}
              </td>
              <td>
                <!-- <div class="view__detail-btn reffer__btn" v-show="isRefer">
                  <a href="#">Reffer</a>
                </div> -->
                <div class="view__detail-btn">
                  <router-link
                    :to="{
                      name: 'TalentDetail',
                      params: { id: talent?.id },
                    }"
                    >View Detail
                  </router-link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import ComponentTitle from "../components/ComponentTitle.vue";
import ReferService from "../Services/referService";
export default {
  name: "TableViewThree",

  components: {
    ComponentTitle,
  },
  data() {
    return {
      talents: [],
      loader: false,
      prevPage: null,
      nextPage: null,
      isRefer: false,
      talentIds: [],
      companyId: null,
      positionId: null,
      searching: null,
    };
  },

  mounted() {
    this.$emitter.on("curJob", (curJob) => {
      this.companyId = curJob.company_id;
      this.positionId = curJob.id;
      this.getAlltalents();
      this.talentIds = [];
    });
    this.$emitter.on("updateTalent", () => {
      this.getAlltalents();
    });
  },

  methods: {
    async getAlltalents() {
      const payload = {
        company_id: this.companyId,
        position_id: this.positionId,
        search: this.searching,
      };
      let response = await ReferService.getTalentsList(payload).catch(
        (error) => {
          return this.$toast.error(error.response.data.message);
        }
      );
      if (response.data.status == true) {
        this.talents = response.data.data.data;
        this.nextPage = response.data.data.next_page_url;
        this.nextPage = response.data.data.prev_page_url;
      }
    },

    onChange(ids) {
      this.$emitter.emit("talentIds", JSON.stringify(this.talentIds));
    },

    async onKeyPress() {
      const payload = {
        company_id: this.companyId,
        position_id: this.positionId,
        name: this.searching,
      };
      let response = await ReferService.getTalentsList(payload).catch(
        (error) => {
          return this.$toast.error(error.response.data.message);
        }
      );
      if (response.data.status == true) {
        this.talents = response.data.data.data;
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
