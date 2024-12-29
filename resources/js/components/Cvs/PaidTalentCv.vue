<template>
  <div class="cv__block">
    <div class="cv__block-container">
      <div class="cv__block-content">
        <div class="cv__block-header">
          <h2>
            {{ talent?.first_name }} <br />
            {{ talent?.last_name }}
          </h2>
          <template v-for="skill in this.talent?.skills" :key="skill">
            <p>{{ skill?.profession_name }}</p>
          </template>
        </div>
        <div class="cv__block-body">
          <div class="cv__block-item">
            <h3 class="cv__block-heading">Education</h3>
            <div class="cv__block-info">
              <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
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
            <h3 class="cv__block-heading">Work Experience</h3>
            <div class="cv__block-info">
              <template v-for="skill in this.talent?.skills" :key="skill">
                <h4 class="cv__block-sub-heading">
                  {{ skill?.profession_name }}
                </h4>
                <p>{{ skill?.experience }}</p>
              </template>

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
              <li>{{ talent.current_role }}</li>
              <li>Your City,Country</li>
              <li>{{ talent?.phone_no }}</li>
              <li>{{ talent?.email }}</li>
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
  name: "TalentCv",

  data() {
    return {
      talent: {},
    };
  },
  mounted() {
    this.getTalentById(this.$route.params.id);
  },

  methods: {
    async getTalentById(id) {
      const response = await TalentService.getTalentById(id).catch((error) => {
        return this.$toast.error(error.response.data.message);
      });
      this.talent = response.data.data;
    },
  },
};
</script>
<style lang="scss" scoped></style>
