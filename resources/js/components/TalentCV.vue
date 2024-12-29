<template>
  <div v-if="this.userType == this.$constants.TALENT" class="cv__block">
    <div class="cv__block-container">
      <div class="cv__block-content">
        <div class="cv__block-header">
          <h2>
            {{ talent?.first_name }} <br />
            {{ talent?.last_name }}
          </h2>
          <template v-for="skill in this.talent?.skills" :key="skill">
            <p>{{ skill?.profession?.name }}</p>
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
            <h3 class="cv__block-heading">Contact</h3>
            <ul class="cv__block-list">
              <li>Year, Month/Day</li>
              <li>Your City,Country</li>
              <li>{{ talent?.phone_no }}</li>
              <li>{{ talent?.email }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else-if="this.userType == this.$constants.EMPLOYER" class="cv__block">
    <div class="cv__block-container">
      <div class="cv__block-content">
        <div class="cv__block-header">
          <h2>{{ job?.company_meta?.company_name }} <br /></h2>

          <p>{{ job?.company_meta?.current_role }}</p>
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
            <h3 class="cv__block-heading">Contact</h3>
            <ul class="cv__block-list">
              <li>Year, Month/Day</li>
              <li>Your City,Country</li>
              <li>{{ job?.phone_no }}</li>
              <li>{{ job?.email }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { number } from 'yup/lib/locale';
import Auth from "../auth";
export default {
  name: "TalentCV",
  props: {
    talent: Object,
    userType: Number,
    job: Object,
  },
  data() {
    return {
      type: "",
    };
  },
  created() {
    this.type = Auth.user.type;
  },
};
</script>
<style lang="scss" scoped></style>
