<template>

    <CreatePost />

    <div class="post__title">
        <h3>Previous Blogs</h3>
    </div>
    <div class="post__box">
        <div class="post__box-single" v-for="post in this.posts" :key="post.id">
            <ViewPost :post="post"/>
        </div>
    </div>

</template>

<script>

import CreatePost from "@/components/Posts/CreatePost.vue";
import ViewPost from "@/components/Posts/ViewPost.vue";
import PostService from "@/Services/postService";
    export default {
        components:{
            CreatePost,
            ViewPost
        },

  data() {
    return {
      customId: null,
      posts: {},
      postId: null,
      likeCount: null,
      isDisable: false,
      isLiked:true,
      permission_status : ''
    };
  },
  created() {
    this.getPosts();
  },
  computed: {

  },
  mounted() {
    this.$emitter.on('refreshPost', () => {
      this.getPosts();
    })
  },
  methods: {
    formatText(text){
      return text.replace(/\n/g, '<br />');
    },
    async getPosts() {
      let response = await PostService.getAllPost().catch((error) => {
        this.$toast.error(error.response.data.message);
      });
      if (response.data.status == true) {
        this.posts = response.data.data.data;
      }
      console.log("this is a respose", response);
    },

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
        this.likeCount = this.likeCount + 1;
      }
    },

    onChangePrivacy(post_id){
      alert('asd')
      console.log(post_id);
      // console.log(this.permission_status);


    }
  },
};
</script>

<style lang="scss" scoped>

</style>
