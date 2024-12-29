<template>
  <div class="cv__block">
    <div class="cv__block-container">
      <div class="cv__block-content">
        <div class="cv__block-header">
          <h2>{{ jobDetail?.company_name }} <br /></h2>

          <p>{{ jobDetail?.position_name }}</p>
        </div>
        <div class="cv__block-body">
          <div class="cv__block-item">
            <h3 class="cv__block-heading">Position Detail</h3>
            <div class="cv__block-info">
              <h4 class="cv__block-sub-heading"></h4>
              <p>
                <b>School Name.</b> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Placeat vero qui cupiditate perspiciatis
                exercitationem? Molestias minus expedita
              </p>
            </div>
            <div class="cv__block-info">
              <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
              <p>
                <b>School Name.</b> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Placeat vero qui cupiditate perspiciatis
                exercitationem? Molestias minus expedita
              </p>
            </div>
          </div>
          <div class="cv__block-item">
            <h3 class="cv__block-heading">Experience</h3>
            <div class="cv__block-info">
              <h4 class="cv__block-sub-heading">
                we need min {{ job?.experience }} years
              </h4>
              <p>
                <b>School Name.</b> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Placeat vero qui cupiditate perspiciatis
                exercitationem? Molestias minus expedita
              </p>
            </div>
            <div class="cv__block-info">
              <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
              <p>
                <b>School Name.</b> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Placeat vero qui cupiditate perspiciatis
                exercitationem? Molestias minus expedita
              </p>
            </div>
          </div>
          <div class="cv__block-item">
            <h3 class="cv__block-heading">Contact</h3>
            <ul class="cv__block-list">
              <li>{{ jobDetail?.job_posted_date }}</li>
              <li>{{ jobDetail.countery_name }}</li>
              <li>{{ jobDetail?.phone_no }}</li>
              <li>{{ jobDetail?.email }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import TalentService from "@/Services/talentService";
export default {
  name: "EmployerCv",
  props: {
    positionId: Number,
    jobDetail: Object,
  },
  mounted() {
    if (this.$route.params.id !== undefined) {
      this.getJobDetail(this.$route.params.id);
    }
  },
  data() {
    return {
      jobDetail: this.$route.params.id == undefined ? this.jobDetail : {},
    };
  },

  methods: {
    async getJobDetail(id) {
      let response = await TalentService.getAppliedJobDetail(id).catch(
        (error) => {
          return this.$toast.error(error.response.data.message);
        }
      );

      this.jobDetail = response.data.data;
    },
  },
};
</script>
<style lang="scss" scoped></style>
