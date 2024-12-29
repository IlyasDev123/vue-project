<template>
  <div class="reffer__members-box">
    <div class="avatar__upload m__auto">
      <div class="avatar__preview">
        <div
          id="imagePreview"
          style="background-image: url('@/assets/img/cp-logo.png')"
        ></div>
      </div>
    </div>
    <h3>
      {{ companies?.positionDetail?.first_name }}{{ " "
      }}{{ companies?.positionDetail?.last_name }}
    </h3>
    <span>{{ companies?.positionDetail?.company_name }}</span>

    <div class="search__box">
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
      <input type="text" />
    </div>
  </div>

  <div class="refer__post">
    <template v-for="company in companies" :key="company">
      <CardList
        :company="company"
        :cvType="this.$constants.EMPLOYER"
        routeName="positionDetail"
        routeTitle="Position"
        :routeId="company.positionDetail.position_id"
      />
    </template>

    <div class="refer__post-btn">
      <router-link
        :to="{
          name: 'DetailTalentPage',
          params: { id: this.$route.params.id },
        }"
        class="refer__post-btn-back"
      >
        <svg
          width="10"
          height="10"
          viewBox="0 0 10 10"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M2.56635 5.58328L5.69535 8.71228L4.87052 9.53711L0.333355 4.99994L4.87052 0.462776L5.69536 1.28761L2.56635 4.41661L9.66669 4.41661L9.66669 5.58328L2.56635 5.58328Z"
            fill="#304254"
          />
        </svg>
        <span>Go Back</span>
      </router-link>
    </div>
  </div>
</template>

<script>
import CardList from "../../../components/Cards/Listing.vue";
import userService from "../../../Services/userService";

export default {
  components: {
    CardList,
  },
  data() {
    return {
      companies: [],
    };
  },

  mounted() {
    this.referToCompany();
  },
  methods: {
    async referToCompany() {
      let response = await userService
        .referToCompany(this.$route.params.id)
        .catch((error) => {
          return this.$toast.error(error.response.data.message);
        });
      this.companies = response.data.data;
    },
  },
};
</script>

<style lang="scss" scoped></style>
