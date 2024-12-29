<template>
  <div class="post__box">
    <div class="post__box-single" v-for="post in this.posts" :key="post.id">
        <ViewPost :post="post"/>
    </div>
    <!-- <div class="post-box">
    </div> -->
  </div>
</template>

<script>
import ViewPost from "@/components/ViewPost.vue";
import PostService from "@/Services/postService";
export default {
  name: "GoodRead",
  components: {
    ViewPost,
  },

  data() {
    return {
      posts: {},
      postId: null,
      likeCount: null,
      isDisable: false,
      isLiked: true,
    };
  },
  created() {
    this.getPublicPosts();
  },
  mounted() {
    this.$emitter.on("postCountAdd", () => {
      this.getPublicPosts();
    });
  },
  methods: {
    async getPublicPosts() {
      let response = await PostService.getPublicPosts().catch((error) => {
        this.$toast.error(error.response.data.message);
      });
      if (response.data.status == true) {
        this.posts = response.data.data.data;
      }
    },
  },
};
</script>

<style  scoped>
.post-mb{
 width:100%;
}
</style>
