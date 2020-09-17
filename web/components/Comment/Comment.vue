<template>
  <div>
    <!-- <a-col span="1">
        <img src="@/assets/user.jpg" style="width:50px;border-radius:50%;" />
    </a-col>-->
    <p>Add a comment:</p>
    <a-textarea v-model="comment" style="height:140px;" />
    <a-row type="flex" justify="end">
      <a-button style="margin-top:4px;" @click="postComment" type="primary">Submit !</a-button>
    </a-row>

    <div class="comment" v-for="(item, index) in shopComments" :key="index">
      <a-row type="flex" justify="space-between">
        <a-col :span="22">
          <user-pop-info :userId="item.user_id" style="width:30%;" />
        </a-col>
        <a-col>
          <a-popconfirm
            v-if="$auth.user.id===item.user_id"
            title="Are you sure delete this comment?"
            ok-text="Yes"
            cancel-text="No"
            @confirm="deleteComment(item.id)"
          >
            <a-icon type="delete" />
          </a-popconfirm>
        </a-col>
      </a-row>
      <span v-if="isShopOwnerComment(item.user_id)">
        <a-icon type="crown" />&nbsp;Owner
      </span>
      <user-rating-in-comment v-else :shopId="shopId" :userId="item.user_id" />
      <a-row type="flex" justify="space-between">
        <a-col>
          <p>
            <i>" {{ item.comment }} "</i>
          </p>
        </a-col>
        <a-col style="text-align:right;">
          <p class="date">{{ item.created_at | moment("from", "now") }}</p>
        </a-col>
      </a-row>
      <a-button
        type="link"
        :icon="replyStatus[index]?'up':'down'"
        @click="toggleReply(index)"
        ghost
      >
        <span v-if="replyStatus[index]">Hide Replies</span>
        <span v-else>Show Replies</span>
      </a-button>
      <transition name="fade">
        <section class="reply" v-if="replyStatus[index]">
          <div v-for="(reply,index2) in item.replies" :key="index2">
            <user-pop-info :userId="reply.user_id" style="width:30%;" class="reply-user" />
            <span v-if="isShopOwnerComment(reply.user_id)">
              <a-icon type="crown" />&nbsp;Owner
            </span>
            <user-rating-in-comment v-else :shopId="shopId" :userId="reply.user_id" />
            <a-row type="flex" justify="space-between">
              <a-col>
                <i>"{{reply.reply}}"</i>
              </a-col>
              <a-col>
                <p class="date">{{ reply.created_at | moment("from", "now") }}</p>
              </a-col>
            </a-row>
          </div>
          <input
            type="text"
            placeholder="Reply to this comment"
            v-model="reply[item.id]"
            class="reply-input"
            @keyup.enter="postReply(item.id)"
          />
        </section>
      </transition>
      <!-- </a-col>
        <a-col :span="4" style="text-align:right;">
          <p class="date">{{ item.created_at | moment("from", "now") }}</p>
        </a-col>
      </a-row>-->
    </div>
  </div>
</template>

<script>
import UserRatingInComment from "@/components/Rating/UserRatingInComment";
export default {
  props: ["shopId", "shopOwnerId"],
  component: { UserRatingInComment },
  data() {
    return {
      comment: "",
      reply: [],
      shopComments: "",
      commentDidLoad: false,
      replyDidLoad: null,
      showReply: { icon: "down" },
      replyStatus: [],
    };
  },
  methods: {
    toggleReply(index) {
      this.$set(this.replyStatus, index, !this.replyStatus[index]);
      // console.log(this.replyStatus);
      // console.log(this.showReply);
    },
    fetchComments() {
      this.$axios.get(`/comment/get/${this.shopId}`).then((response) => {
        // console.log(response.data);
        this.shopComments = response.data.comments;
        this.commentDidLoad = true;
      });
    },
    postReply(id) {
      this.$axios
        .post(`/reply/post/${id}`, { reply: this.reply[id] })
        .then((response) => {
          this.reply[id] = null;
          // console.log(response);
          this.$message.success("Reply posted", 1);
          this.fetchComments();
        });
    },
    postComment() {
      this.$axios
        .post(`/comment/post/${this.shopId}`, {
          comment: this.comment,
        })
        .then((response) => {
          // console.log(response);
          this.$message.success("Your comment has been submitted");
          this.fetchComments();
          this.comment = "";
        });
    },
    deleteComment(id) {
      this.$axios.delete(`/comment/delete/${id}`).then((response) => {
        this.$message.success("Comment deleted");
        this.fetchComments();
      });
    },
    isShopOwnerComment(value) {
      if (this.shopOwnerId === value) {
        return true;
      }
      return false;
    },
  },
  created() {
    this.fetchComments();
  },
};
</script>

<style>
.comment {
  padding: 10px;
  padding-bottom: 10px;
  /* background-color: #c3073f; */
  background-color: #dc243e;
  background-image: linear-gradient(62deg, #dc243e 0%, #8821e9 100%);

  border-radius: 6px;
  color: white;
  border-bottom: 1px solid #eeeeee;
  margin-top: 4px;
  /* box-shadow: 3px 4px 4px rgba(213, 211, 211, 0.25); */
  box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
}
.reply {
  margin-left: 20px;
  /* margin-right: 20px; */
  transition: all 0.4s ease-in-out;
}
.reply-input {
  border-radius: 0px;
  border: 0px;
  outline: 0px;
  border-bottom: 1px solid #eeeeee;
  padding: 12px 4px;
  background-color: inherit;
  margin-bottom: 4px;
}
.reply-user img {
  width: 30px !important;
  height: 30px !important;
}
.reply-input:focus {
  border: 0;
  outline: 0;
}
.date {
  font-size: 12px;
  font-weight: 100;
  color: white;
  font-style: italic;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity cubic-bezier(0.075, 0.82, 0.165, 1);
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>