<template>
  <div class="post__box">
    <div class="post__box-single post__add">
      <form @submit="onSubmit">
        <h3 class="post__add-title">Create a Blog</h3>
        <div class="post__add-head d__flex">
          <img
            :src="
              authProfile.avatar
                ? this.$public + authProfile.avatar
                : this.$public + `avatar.png`
            "
            alt=""
          />
          <div class="post__add-head-title">
            <h4>{{ authProfile.first_name }} {{ authProfile.last_name }}</h4>
            <input
              type="text"
              placeholder="Title.."
              name="title"
              v-model="data.title"
              class="post__add-head-heading"
            />
          </div>
        </div>
        <textarea
          class="post__add-paragraph"
          name="description"
          v-model="data.description"
          placeholder="What do you want to talk about?"
        ></textarea>

        <!-- <input
          type="text"
          placeholder="# Add hashtag"
          name="tag"
          v-model="data.tag"
          class="add__hashtag"
        /> -->

        <div class="post__foot">
          <div class="file__upload">
            <div class="file__upload-select">
              <!-- <div class="file__select-button">
                <svg
                  width="14"
                  height="16"
                  viewBox="0 0 14 16"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    opacity="0.3"
                    d="M1.0416 14.0128C-0.347527 12.6236 -0.347527 10.3572 1.0416 8.89492L8.64526 1.29126C9.74194 0.19458 11.5697 0.19458 12.7395 1.29126C13.032 1.58371 13.032 2.0224 12.7395 2.31484C12.4471 2.60729 12.0084 2.60729 11.716 2.31484C11.1311 1.72995 10.2537 1.72995 9.66883 2.31484L2.06516 9.91849C1.18782 10.7958 1.18782 12.1118 2.06516 12.9892C2.94251 13.8665 4.25854 13.8665 5.13588 12.9892L11.2773 6.84778C11.5697 6.55533 12.0084 6.55533 12.3009 6.84778C12.5933 7.14023 12.5933 7.5789 12.3009 7.87135L6.15945 14.0128C4.77032 15.4019 2.50384 15.4019 1.0416 14.0128Z"
                    fill="#A1A5B7"
                  />
                  <path
                    d="M4.62456 10.4303C3.74722 9.55291 3.74722 8.23689 4.62456 7.35954L8.20706 3.77704C8.49951 3.48459 8.93818 3.48459 9.23063 3.77704C9.52308 4.06949 9.52308 4.50817 9.23063 4.80062L5.64814 8.38304C5.35569 8.67549 5.35569 9.11416 5.64814 9.40661C5.94059 9.69906 6.37926 9.69906 6.67171 9.40661L11.7896 4.28879C12.082 3.99634 12.2282 3.70394 12.2282 3.33838C12.2282 2.89971 12.082 2.53415 11.7896 2.2417C11.4971 1.94925 11.4971 1.51056 11.7896 1.21812C12.082 0.925667 12.5207 0.925667 12.8131 1.21812C13.398 1.80301 13.6905 2.53415 13.6905 3.33838C13.6905 4.0695 13.398 4.7275 12.8131 5.23928L7.69528 10.3571C6.81793 11.2345 5.50191 11.2345 4.62456 10.4303Z"
                    fill="#A1A5B7"
                  />
                </svg>
              </div> -->
              <div class="file__select-name"></div>
              <input
                type="file"
                name="attachment[]"
                @change="onchange"
                multiple
                id="file__upload-input"
              />
            </div>
          </div>
          <div class="post__btn">
            <select
              class="select__post"
              name="permission_status"
              v-model="data.permission_status"
            >
              <option value="1">Only me</option>
              <option value="2">Talent + Employers</option>
              <option value="3">Employers Only</option>
            </select>

            <button class="primary__btn">Post</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import postService from "../../Services/postService";
import { mapState } from "vuex";

export default {
  name: "CreatePost",
  data() {
    return {
      data: {
        title: "",
        tag: "",
        description: "",
        permission_status: 1,
        attachment: "",
      },
    };
  },
  computed: {
    ...mapState("auth", {
      authProfile: (state) => state.user,
    }),
  },
  methods: {
    resetForm() {
      (this.data.title = ""),
        (this.data.tag = ""),
        (this.data.description = ""),
        (this.data.attachment = ""),
        (this.data.permission_status = 1);
    },

    onchange(e) {
      this.data.attachment = e.target.files;
    },

    async onSubmit(e) {
      e.preventDefault();

      if (!this.data.title) {
        this.$toast.error("Post title is required.");
        return false;
      }

      if (!this.data.description) {
        this.$toast.error("Post description is required.");
        return false;
      }

      if (!this.data.permission_status) {
        this.$toast.error("Please select post privacy type.");
        return false;
      }

      let formData = new FormData();
      formData.append("title", this.data.title);
      formData.append("description", this.data.description);
      formData.append("permission_status", this.data.permission_status);
      formData.append("tags", this.data.tag);
      if (this.data.attachment.length) {
        for (var x = 0; x < this.data.attachment.length; x++) {
          formData.append("attachment[]", this.data.attachment[x]);
        }
      }

      let response = await postService.createPost(formData).catch((error) => {
        return this.$toast.error(error.response.data.message);
      });

      if (response.data.status == true) {
        this.resetForm();

        this.$emitter.emit("refreshPost", response.data.data);

        this.$toast.success(response.data.message);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
