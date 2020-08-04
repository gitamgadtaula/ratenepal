<template>
  <div class="container">
    <a-row type="flex" justify="space-between">
      <a-col>
        <img src="@/assets/shops/shop-icon.png" style="width:40px;" />
        <h1 class="title">
          {{ shop.name }}
        </h1>
      </a-col>
      <a-col>
        <h1>
          <a-icon
            type="star"
            theme="twoTone"
            two-tone-color="#f3b525"
            :style="{ fontSize: '28px' }"
          />
          <span v-if="responseDidLoad">
            {{ shop.ratings | getRating }} / 5
          </span>
        </h1>
      </a-col>
    </a-row>

    <a-row type="flex" justify="center">
      <div class="carousel" style="width:50%;">
        <a-carousel autoplay>
          <div>
            <h3>Img 1</h3>
          </div>
          <div>
            <h3>2 <br />dfgdf</h3>
          </div>
          <div><h3>3</h3></div>
          <div><h3>4</h3></div>
        </a-carousel>
      </div>
    </a-row>
    <span v-if="isShopOwner"> <a-icon type="alert" /> Shop Owner ! </span>
    <span v-else>
      <div v-if="didRateAlready">
        <p>Your Rating : {{ userRatingOnShop.rating }}/5</p>
        <a-rate v-model="userRatingOnShop.rating" disabled allow-half />
      </div>
      <div v-else>
        <p>Please Rate !</p>
        <a-popconfirm
          title="Are you sure you want to post your rating?"
          ok-text="Yes"
          cancel-text="No"
          @confirm="postRating"
        >
          <a-icon slot="icon" type="star" style="color: #f3b525" />

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
          <p><a-icon type="environment" /> Location: {{ shop.location }}</p>
          <p><a-icon type="phone" /> Contact: {{ shop.phone1 }}</p>
          <p><a-icon type="mail" /> Email: {{ shop.email }}</p>
          <p><a-icon type="global" /> Website: {{ shop.website }}</p>
        </div>
      </a-col>
    </a-row>
  </div>
</template>

<script>
export default {
  auth: true,
  data() {
    return {
      rating: {
        value: 0,
        desc: ["terrible", "bad", "normal", "good", "wonderful"]
      },
      shop: "",
      userRatingOnShop: "",
      responseDidLoad: false,
      didRateAlready: false,
      ratingInWords: ""
    };
  },
  methods: {
    fetchShop() {
      this.$axios.get(`/shop/${this.$route.params.shop}`).then(response => {
        this.shop = response.data;
        this.responseDidLoad = true;
      });
    },
    getUserRatingOnShop() {
      this.$axios
        .get(`/rating/getuserrating/${this.$route.params.shop}`)
        .then(response => {
          this.userRatingOnShop = response.data;
          if (response.data.status != false) {
            this.didRateAlready = true;
          }
        });
    },
    postRating() {
      this.$axios
        .post(`rating/post/${this.$route.params.shop}`, {
          rating: this.rating.value
        })
        .then(response => {
          console.log(response);
          this.$message.success("Your rating has been submitted");
          this.fetchShop();
          this.getUserRatingOnShop();
        });
    },
    ratingWords(value) {
      this.ratingInWords = value;
    }
  },
  computed: {
    isShopOwner() {
      //to check if the logged in user is the owner of the shop
      if (this.shop.user_id === this.$auth.user.id) {
        return true;
      }
      return false;
    }
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
    }
  },
  created() {
    this.fetchShop();
    this.getUserRatingOnShop();
  }
};
</script>

<style scoped>
.container {
  margin: 0 auto;
  display: block;
  min-height: 100vh;
  padding: 10px;
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
</style>
