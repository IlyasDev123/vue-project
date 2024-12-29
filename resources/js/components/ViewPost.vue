<template>
  <div class="post__box-single-head">
    <div class="post__head d__flex d__flex-h-between d__flex-v-center">
      <div class="post__head-left d__flex d__flex-h-between d__flex-v-center">
        <img
          :src="
            post.user.avatar ? this.$public + post.user.avatar : this.$public + `avatar.png`
          "
          alt=""
        />
        <div class="post__head-left-heading">
          <h4>{{ post?.user?.first_name }} {{ post?.user?.last_name }}</h4>
          <h5>{{ post?.created_at }}</h5>
        </div>
      </div>
      <div class="post__head-right">
        <svg
          width="12"
          height="12"
          viewBox="0 0 12 12"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M3.25 0H0.8125C0.363769 0 0 0.363769 0 0.8125V3.25C0 3.69873 0.363769 4.0625 0.8125 4.0625H3.25C3.69873 4.0625 4.0625 3.69873 4.0625 3.25V0.8125C4.0625 0.363769 3.69873 0 3.25 0Z"
            fill="#009EF7"
          />
          <path
            opacity="0.3"
            d="M10.5625 0H8.125C7.67627 0 7.3125 0.363769 7.3125 0.8125V3.25C7.3125 3.69873 7.67627 4.0625 8.125 4.0625H10.5625C11.0112 4.0625 11.375 3.69873 11.375 3.25V0.8125C11.375 0.363769 11.0112 0 10.5625 0Z"
            fill="#009EF7"
          />
          <path
            opacity="0.3"
            d="M3.25 7.3125H0.8125C0.363769 7.3125 0 7.67627 0 8.125V10.5625C0 11.0112 0.363769 11.375 0.8125 11.375H3.25C3.69873 11.375 4.0625 11.0112 4.0625 10.5625V8.125C4.0625 7.67627 3.69873 7.3125 3.25 7.3125Z"
            fill="#009EF7"
          />
          <path
            opacity="0.3"
            d="M10.5625 7.3125H8.125C7.67627 7.3125 7.3125 7.67627 7.3125 8.125V10.5625C7.3125 11.0112 7.67627 11.375 8.125 11.375H10.5625C11.0112 11.375 11.375 11.0112 11.375 10.5625V8.125C11.375 7.67627 11.0112 7.3125 10.5625 7.3125Z"
            fill="#009EF7"
          />
        </svg>
      </div>
    </div>
    <h3>
      {{ post?.title }}
    </h3>
    <p>
      {{ post?.description }}
    </p>
    <div class="post__foot d__flex d__flex-h-between d__flex-v-center">
      <button
        class="post__like-btn"
        @click="likePost(post.id)"
        :disabled="isDisable == true"
        :class="post.is_liked == true ? 'liked' : ''"
        
      >
        <svg
          width="16"
          height="14"
          viewBox="0 0 16 14"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M12.9273 1.28169C12.3337 0.943497 11.6542 0.75 10.9303 0.75C9.65483 0.75 8.50879 1.35063 7.75244 2.29077C6.99088 1.35054 5.84875 0.75 4.57009 0.75C3.84684 0.75 3.16579 0.942936 2.57278 1.28169C1.29995 2.005 0.4375 3.3992 0.4375 5.00939C0.4375 5.47063 0.510146 5.90864 0.641868 6.32318C1.34876 9.60731 5.87546 13.75 7.75276 13.75C9.57829 13.75 14.1484 9.60731 14.8584 6.32318C14.9901 5.90864 15.0625 5.47063 15.0625 5.00939C15.0631 3.3992 14.1999 2.005 12.9273 1.28169Z"
            fill="#A1A5B7"
          />
        </svg>
        <span>{{
          post.userlikes_posts_count > 0
            ? post.userlikes_posts_count
            : this.likeCount
        }}</span>
      </button>
    </div>
  </div>
</template>

<script>
import PostService from "../Services/postService";
export default {
  name: "ViewPost",
  props: {
    post: Object,
  },
  data() {
    return {
      // post: this.post,
      postId: this.post.id,
      likeCount: 0,
      isDisable: false,
      isLiked: true,
    };
  },

  methods: {
    async likePost(postID) {
      this.isDisable = true;
      let response = await PostService.likePost({
        post_id: postID,
      }).catch((error) => {
        this.$toast.error(error.response.data.message);
        this.isDisable = false;
      });
      if (response.data.status == true) {
        this.isDisable = false;
        if (response.data.data.attached.length > 0) {
          this.post.userlikes_posts_count = this.post.userlikes_posts_count + 1;
        } else {
          this.post.userlikes_posts_count = this.post.userlikes_posts_count - 1;
        }

        this.$emitter.emit("postCountAdd", true);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
