<template>
  <div class="container">
    <a-row type="flex" justify="space-between">
      <a-col>
        <div class="title-container">
          <!-- <img src="@/assets/shops/shop-icon.png" style="width:40px;" /> -->
          <h1 class="title">{{ shop.name }}</h1>
        </div>
      </a-col>
      <a-col>
        <div class="title-container">
          <h1>
            <a-icon
              type="star"
              theme="twoTone"
              two-tone-color="#f3b525"
              :style="{ fontSize: '28px' }"
            />
            <span v-if="responseDidLoad">{{ shop.ratings | getRating }} / 5</span>
          </h1>
        </div>
      </a-col>
    </a-row>

    <a-row type="flex" justify="center">
      <div class="carousel" style="width:50%;">
        <a-carousel autoplay>
          <div>
            <h3>Img 1</h3>
          </div>
          <div>
            <h3>
              2
              <br />dfgdf
            </h3>
          </div>
          <div>
            <h3>3</h3>
          </div>
          <div>
            <h3>4</h3>
          </div>
        </a-carousel>
      </div>
    </a-row>
    <span v-if="isShopOwner">
      <a-icon type="crown" />Shop Owner !
    </span>
    <span v-else>
      <div v-if="didRateAlready">
        <p>Your Rating : {{ userRatingOnShop.rating.rating }}/5</p>
        <a-rate v-model="userRatingOnShop.rating.rating" disabled allow-half />
      </div>
      <div v-else>
        <p>Please Rate !</p>
        <a-popconfirm
          title="Are you sure you want to post your rating?"
          ok-text="Yes"
          cancel-text="No"
          @confirm="postRating"
        >
          <a-icon slot="icon" type="star" theme="filled" style="color: #f3b525" />

          <a-rate v-model="rating.value" :tooltips="rating.desc" />
        </a-popconfirm>
      </div>
      <!-- <span class="ant-rate-text">{{ rating.desc[rating.value - 1] }}</span> -->
    </span>

    <a-row type="flex" justify="space-between">
      <a-col :span="12">
        <div class="shop-desc">
          <h3>{{ shop.description }}</h3>
        </div>
      </a-col>

      <a-col :span="12" style="border-left:1px solid #dedede;padding: 4px;">
        <div class="shop-info">
          <p>
            <a-icon type="environment" />
            Location: {{ shop.location }}
          </p>
          <p>
            <a-icon type="phone" />
            Contact: {{ shop.phone1 }}
          </p>
          <p>
            <a-icon type="mail" />
            Email: {{ shop.email }}
          </p>
          <p>
            <a-icon type="global" />
            Website: {{ shop.website }}
          </p>
        </div>
      </a-col>
    </a-row>

    <hr />
    <section class="comment-container" style="width:50%;">
      <a-textarea v-model="comment" />
      <a-row type="flex" justify="end">
        <a-button @click="postComment">Submit !</a-button>
      </a-row>
      <div class="title-container" v-if="shops.length >= 1">
        <div class="comment" v-for="(item, index) in shops" :key="index">
          <user-pop-info :userId="item.user_id" style="width:30%;" />
          <user-rating-in-comment :shopId="shopId" :userId="item.user_id" />
          <b>
            <i>" {{ item.comment }} "</i>
          </b>

          <p class="date">{{ item.created_at | moment("from", "now") }}</p>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import UserPopInfo from "@/components/UserPopInfo";
import UserRatingInComment from "@/components/Rating/UserRatingInComment";
export default {
  components: { UserRatingInComment },
  auth: true,
  data() {
    return {
      username: "",
      rating: {
        value: 0,
        desc: ["terrible", "bad", "normal", "good", "wonderful"],
      },
      comment: "",
      shop: "",
      shops: "",
      userRatingOnShop: "",
      responseDidLoad: false,
      didRateAlready: false,
      commentDidLoad: false,
      ratingInWords: "",
      shopId: "",
    };
  },
  methods: {
    fetchShop() {
      this.$axios.get(`/shop/${this.$route.params.shop}`).then((response) => {
        this.shop = response.data;
        this.responseDidLoad = true;
      });
    },
    getUserRatingOnShop() {
      this.$axios
        .get(`/rating/getuserrating/${this.$route.params.shop}`)
        .then((response) => {
          this.userRatingOnShop = response.data;
          if (response.data.status != false) {
            this.didRateAlready = true;
          }
        });
    },
    postRating() {
      this.$axios
        .post(`/rating/post/${this.$route.params.shop}`, {
          rating: this.rating.value,
        })
        .then((response) => {
          console.log(response);
          this.$message.success("Your rating has been submitted");
          this.fetchShop();
          this.getUserRatingOnShop();
        });
    },
    fetchComments() {
      this.$axios
        .get(`/comment/get/${this.$route.params.shop}`)
        .then((response) => {
          console.log(response.data);
          this.shops = response.data.comments;
          this.commentDidLoad = true;
        });
    },
    postComment() {
      this.$axios
        .post(`/comment/post/${this.$route.params.shop}`, {
          comment: this.comment,
        })
        .then((response) => {
          console.log(response);
          this.$message.success("Your comment has been submitted");
          this.fetchComments();
        });
    },
    isShopOwnerComment(value) {
      if (this.shop.user_id === value) {
        return true;
      }
      return false;
    },
  },
  computed: {
    isShopOwner() {
      //to check if the logged in user is the owner of the shop
      if (this.shop.user_id === this.$auth.user.id) {
        return true;
      }
      return false;
    },
  },
  filters: {
    getRating(value) {
      console.log(value);
      const length = value.length;
      // this.ratingWords("brilliant");
      if (length === 0) {
        return "Not rated yet";
      }
      const sum = value.reduce((acc, item) => acc + item.rating, 0);
      //  this.ratingInWords="excellent"
      return (sum / length).toFixed(1); //round upto 2 decimal
    },
  },
  created() {
    this.shopId = this.$route.params.shop;
    this.fetchComments();
    this.fetchShop();
    this.getUserRatingOnShop();
  },
};
</script>

<style scoped>
.container {
  margin: 0 auto;
  display: block;
  min-height: 100vh;
  padding: 10px;
}
.title-container {
  margin-top: 5px;
  background: #ffffff;
  border: 1px solid #add9f8;
  box-sizing: border-box;
  box-shadow: 3px 4px 4px rgba(213, 211, 211, 0.25);
  border-radius: 6px;
  padding: 5px 10px;
}
.title {
  text-transform: capitalize;
}
.carousel {
  background-color: teal;
  color: tomato;
}
.ant-carousel >>> .slick-slide {
  text-align: center;
  height: 200px;
  line-height: 160px;
  background: #364d79;
  overflow: hidden;
}

.ant-carousel >>> .slick-slide h3 {
  color: #fff;
}
.shop-desc {
  font-size: 16px;
  text-align: left;
  padding-left: 0px !important;
  padding: 10px;
}
.shop-info {
  padding: 10px;
  font-size: 16px;
  text-align: left;
}
.comment {
  border-bottom: 1px solid #eeeeee;
  margin-top: 4px;
  box-shadow: 3px 4px 4px rgba(213, 211, 211, 0.25);
}
.date {
  font-size: 9px;
  font-weight: 100;
  color: #c3073f;
  font-style: italic;
}
</style>
