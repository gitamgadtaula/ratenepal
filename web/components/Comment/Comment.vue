<template>
  <div>
    <a-textarea v-model="comment" />
    <a-row type="flex" justify="end">
      <a-button @click="postComment" type="primary">Submit !</a-button>
    </a-row>

    <div class="comment" v-for="(item, index) in shopComments" :key="index">
      <user-pop-info :userId="item.user_id" style="width:30%;" />
      <span v-if="isShopOwnerComment(item.user_id)">
        <a-icon type="crown" />Owner
      </span>
      <user-rating-in-comment v-else :shopId="shopId" :userId="item.user_id" />
      <a-row type="flex" justify="space-between">
        <a-col :flex="3">  
          <p>
            <i>" {{ item.comment }} "</i>
          </p>
        </a-col>
        <a-col :flex="1">
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
    return { comment: "", shopComments: "", commentDidLoad: false };
  },
  methods: {
    fetchComments() {
      this.$axios.get(`/comment/get/${this.shopId}`).then((response) => {
        console.log(response.data);
        this.shopComments = response.data.comments;
        this.commentDidLoad = true;
      });
    },
    postComment() {
      this.$axios
        .post(`/comment/post/${this.shopId}`, {
          comment: this.comment,
        })
        .then((response) => {
          console.log(response);
          this.$message.success("Your comment has been submitted");
          this.fetchComments();
          this.comment = "";
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
  padding-bottom: 0px;
  background-color: #c3073f;
  border-radius: 6px;
  color: white;
  border-bottom: 1px solid #eeeeee;
  margin-top: 4px;
  box-shadow: 3px 4px 4px rgba(213, 211, 211, 0.25);
}
.date {
  font-size: 12px;
  font-weight: 100;
  color: white;
  font-style: italic;
}
</style>