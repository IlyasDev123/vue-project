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
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TalentCvBlock",
  props: {
    talent: Object,
  },
};
</script>
<style lang="scss" scoped></style>
