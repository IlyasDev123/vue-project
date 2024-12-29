<template>
  <div class="post__box-single-head">
    <div class="post__head d__flex d__flex-h-between d__flex-v-center">
      <div class="post__head-left d__flex d__flex-h-between d__flex-v-center">
        <img
          :src="
            post.user.avatar
              ? this.$public + post.user.avatar
              : this.$public + `avatar.png`
          "
          alt=""
        />
        <div class="post__head-left-heading">
          <h4>{{ post?.user?.first_name }} {{ post?.user?.last_name }}</h4>
          <h5>{{ post?.created_at }}</h5>
        </div>
      </div>
      <div class="post__head-right"> <!-- v-click-outside="hide" -->
        <button type="button" @click="toggle" class="three-dots">
          <svg  width="4" height="14" viewBox="0 0 4 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 0.25C1.60218 0.25 1.22064 0.408035 0.93934 0.68934C0.658036 0.970644 0.5 1.35218 0.5 1.75C0.5 2.14782 0.658036 2.52936 0.93934 2.81066C1.22064 3.09196 1.60218 3.25 2 3.25C2.39782 3.25 2.77936 3.09196 3.06066 2.81066C3.34196 2.52936 3.5 2.14782 3.5 1.75C3.5 1.35218 3.34196 0.970644 3.06066 0.68934C2.77936 0.408035 2.39782 0.25 2 0.25ZM2 5.5C1.60218 5.5 1.22064 5.65804 0.93934 5.93934C0.658036 6.22064 0.5 6.60218 0.5 7C0.5 7.39782 0.658036 7.77936 0.93934 8.06066C1.22064 8.34196 1.60218 8.5 2 8.5C2.39782 8.5 2.77936 8.34196 3.06066 8.06066C3.34196 7.77936 3.5 7.39782 3.5 7C3.5 6.60218 3.34196 6.22064 3.06066 5.93934C2.77936 5.65804 2.39782 5.5 2 5.5ZM2 10.75C1.60218 10.75 1.22064 10.908 0.93934 11.1893C0.658036 11.4706 0.5 11.8522 0.5 12.25C0.5 12.6478 0.658036 13.0294 0.93934 13.3107C1.22064 13.592 1.60218 13.75 2 13.75C2.39782 13.75 2.77936 13.592 3.06066 13.3107C3.34196 13.0294 3.5 12.6478 3.5 12.25C3.5 11.8522 3.34196 11.4706 3.06066 11.1893C2.77936 10.908 2.39782 10.75 2 10.75Z" fill="#9CA1A8"/>
          </svg>
        </button>
        <div class="edit-dropdown" v-if="displayOptions">
          <a href="#" @click.prevent="showEditModal">Edit </a>
          <a href="#" @click.prevent="showDeleteModal">Delete </a>
        </div>
      </div>
    </div>
    <h3>
      {{ post?.title }}
    </h3>
    <p v-html="this.formatText(post.description)"></p>
    <div class="post__foot d__flex d__flex-h-between d__flex-v-center">
      <button
        class="post__like-btn"
        :disabled="isDisable == true"
      >
      <!-- :class="isLiked == true ? 'liked' : ''" -->
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
      <div
        class="post__options"
        v-if="
          this.$store.state.auth.user.type == this.$constants.RECURITER ||
          this.$store.state.auth.user.type == this.$constants.ADMIN
        "
      >
        <select
          class="select__post"
          @change="onChangePrivacy"
          v-model="this.permission_status"
        >
          <option value="1" :selected="post.permission_status === 1">
            Only me
          </option>
          <option value="2" :selected="post.permission_status === 2">
            Talent + Employers
          </option>
          <option value="3" :selected="post.permission_status === 3">
            Employers Only
          </option>
        </select>
      </div>
    </div>
  </div>

  <Modal :show="isDeleteModalVisible" v-slot:modal-content class="modal">
    <template v-if="showDeleteModalContent">
      <div class="popup__icon" style="text-align: center">
          <img
              src="@/assets/images/talent-images/delete-first.png"
              alt="delete-first"
          />
      </div>
      <h2 class="text__center fw__700" style="font-size: 22px">
          Are you Sure you want <br />to Delete post ?
      </h2>
      <div class="two__btnHolders">
          <a
              class="cursor delete__buttons red__border"
              @click="deletePost"
              >Yes, Delete</a
          >
          <a
              class="cursor delete__buttons submit__btn"
              @click.prevent="hideModal"
              >No, Keep</a
          >
      </div>
    </template>
    <template class="post__box" v-if="showEditModalContent">
        <div class="post__box-single post__add" style="width:100%">
          <form >
              <h3 class="post__add-title">Update Post</h3>
              <div class="post__add-head d__flex">
                <div class="post__add-head-title">
                  <input
                    type="text"
                    placeholder="Title.."
                    name="title"
                    v-model="this.form.title"
                    class="post__add-head-heading"
                  />
                </div>
              </div>
              <textarea
                class="post__add-paragraph"
                name="description"
                placeholder="What do you want to talk about?"
                v-model="this.form.description"
              ></textarea>
            </form>
        </div>
        <div class="two__btnHolders">
            <!-- submit__btn -->
            <a
                class="delete__buttons blue_submit_btn"
                @click.prevent="updatePost"
                >Submit</a
            >
            <!-- red__border -->
            <a
                class="delete__buttons red_cancel_btn"
                @click.prevent="hideModal"
                >Cancel</a
            >
        </div>
    </template>
</Modal>
</template>

<script>
import Modal from "@/components/Modal.vue";
import PostService from "../../Services/postService";
export default {
  name: "ViewPost",
  components: {
    Modal,
  },
  props: {
    post: Object,
  },
  data() {
    return {
      postId: this.post.id,
      likeCount: 0,
      isDisable: false,
      isLiked: true,
      permission_status: this.post.permission_status,
      isDeleteModalVisible: false,
      showEditModalContent: false,
      showDeleteModalContent: false,
      displayOptions:false,
      form : {
        id : this.post.id,
        title : this.post.title,
        description : this.post.description,
        permission_status : this.post.permission_status,
      }
    };
  },
  created() {
    // this.closeModal();
  },
  computed: {
    // getProfile
  },
  methods: {
    formatText(text) {
      return text.replace(/\n/g, "<br />");
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
    async onChangePrivacy() {
      let response = await PostService.privacyChange({
        post_id: this.postId,
        permission_status: this.permission_status,
      }).catch((error) => {
        return this.$toast.error(error.response.data.message);
      });

      if (response.data.status == true) {
        this.$toast.success("Status updated.");
      }
    },
    toggle(){
      this.displayOptions = !this.displayOptions;
    },
    hide(){
      this.displayOptions = false;
    },
    closeModal() {
      window.addEventListener("click", (e) => {
          if (!this.$el.contains(e.target)) {
              this.displayOptions = false;
          }
      });
    },
    showDeleteModal() {
      this.isDeleteModalVisible = true;
      this.showDeleteModalContent = true;
    },
    showEditModal() {
      this.form.id = this.post.id;
      this.form.title = this.post.title;
      this.form.description = this.post.description;
      this.form.permission_status = this.post.permission_status;
      
      this.isDeleteModalVisible = true;
      this.showEditModalContent = true;
    },
    hideModal() {
        this.isDeleteModalVisible = false;
        this.showDeleteModalContent = false;
        this.showEditModalContent = false;
        this.displayOptions = false;
    },
    async deletePost(){
      let response = await PostService.deletePost(this.postId)
      .catch((error) => {
        this.$toast.error(error.response.data.message);
      });
      
      if (response.data.status == true) {
        this.$toast.success(response.data.message);
        this.hideModal();
        this.$emitter.emit("refreshPost");
      }
    },
    async updatePost(e){

      e.preventDefault();

      if (!this.form.title) {
        this.$toast.error("Post title is required.");
        return false;
      }

      if (!this.form.description) {
        this.$toast.error("Post description is required.");
        return false;
      }

      let response = await PostService.updatePost(this.form, this.postId)
      .catch((error) => {
        this.$toast.error(error.response.data.message);
      });
      
      if (response.data.status == true) {
        this.$toast.success(response.data.message);
        this.hideModal();
        this.$emitter.emit("refreshPost");
      }
    }

  },
};
</script>

<style scoped>
.post__like-btn{
  cursor: default;
}
.cursor {
    cursor: pointer;
}
.point {
    cursor: pointer;
    color: #e73d00 !important;
    border: none;
    background: none;
    font-weight: bold;
}
.deactivate-btn {
    text-align: center;
    /* color: #f34a35 !important; */
}
.modal {
    margin-left: 95px;
}
.red_cancel_btn {
    width: 45%;
    text-align: center;
    cursor: pointer;
    border: 1px solid #ff5757;
    color: #ff5757;
    background: none;
    /* text-transform: uppercase; */
    transition: all 0.4s ease;
}
.red_cancel_btn:hover {
    background: #ff5757;
    color: #ffffff;
}
.blue_submit_btn:hover {
    background: #4294ff;
    color: #ffffff;
}
.blue_submit_btn {
    width: 45%;
    cursor: pointer;
    text-align: center;
    border: 1px solid #4294ff;
    color: #4294ff;
    background: none;
    transition: all 0.4s ease;
    border-radius: 13px;
}
section.delete__popup .popup__MainWrapper .two__btnHolders .delete__buttons.submit__btn {
    text-transform:capitalize;
}
</style>
