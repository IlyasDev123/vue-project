<template>
  <div class="post__tabs">
    <ul class="post__tabs-items">
      <!-- <li>
                <router-link :to="{name:'ResumeRequests'}">
                    Resume Requests
                </router-link>
            </li> -->
      <li>
        <router-link :to="{ name: 'InterviewRequests' }">
          Interview Requests
        </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'FullAccessRequests' }">
          Full Access Requests
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "RequestTab",
};
</script>

<style lang="scss" scoped>
</style>
