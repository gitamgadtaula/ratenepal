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
        <a-col :span="18">
          <p>
            <i>" {{ item.comment }} "</i>
          </p>
          <a-button type="down" :icon="showReply.icon" @click="toggleReply(index)" ghost>Show reply</a-button>
          <transition name="fade">
            <section class="reply" v-if="replyStatus[index]">
              {{reply[item.id]}}, {{index}}
              <a-input
                placeholder="Reply to this comment"
                v-model="reply[item.id]"
                class="reply-input"
                @keyup.enter="postReply(item.id)"
              />
              <div v-for="(reply,index2) in item.replies" :key="index2">
                <user-pop-info :userId="reply.user_id" style="width:30%;" class="reply-user" />
                <a-row type="flex" justify="space-between">
                  <a-col>
                    <i style="margin-left:60px;">"{{reply.reply}}"</i>
                  </a-col>
                  <a-col>{{ reply.created_at | moment("from", "now") }}</a-col>
                </a-row>
              </div>
            </section>
          </transition>
        </a-col>
        <a-col :span="4" style="text-align:right;">
          <p class="date">{{ item.created_at | moment("from", "now") }}</p>
        </a-col>
      </a-row>
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
      // index == this.showReply.status
      //   ? (this.showReply.stauts = null)
      //   : (this.showReply.status = index);

      this.$set(this.replyStatus, index, !this.replyStatus[index]);
      console.log(this.replyStatus);
      // if (!this.replyStatus[index]) {
      //   this.showreply[item.id].icon = "down";
      //   this.showreply[item.id].msg = "Show Reply";
      // } else {
      //   this.showreply[item.id].icon = "up";
      //   this.showreply[item.id].msg = "Hide Reply";
      // }
      // if (this.showReply.status === index) {
      //   this.showReply.icon = "up";
      //   this.showReply.msg = "Hide Replies";
      // } else {
      //   this.showReply.icon = "down";
      //   this.showReply.msg = "Show Replies";
      // }
      console.log(this.showReply);
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
  background-color: #c3073f;
  border-radius: 6px;
  color: white;
  border-bottom: 1px solid #eeeeee;
  margin-top: 4px;
  box-shadow: 3px 4px 4px rgba(213, 211, 211, 0.25);
}
.reply {
  margin-left: 20px;
  margin-right: 20px;
  transition: all 0.4s ease-in-out;
}
.reply-input {
  border-radius: 0px;
  border: 0px;
  outline: 0px;
  border-bottom: 2px solid #eeeeee;
  padding: 12px 4px;
  background-color: #c3073f;
  margin-bottom: 4px;
}
.reply-user img {
  width: 30px !important;
  height: 30px !important;
}
.reply-input > ant-input:focus {
  border: 0;
  outline: 0;
}
.date {
  font-size: 12px;
  font-weight: 100;
  color: white;
  font-style: italic;
}
</style>