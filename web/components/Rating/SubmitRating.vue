<template>
  <div class="container">
    <span v-if="isShopOwner">
      <a-icon type="crown" />Shop Owner !
    </span>
    <span v-else>
      <div v-if="didRateAlready">
        <p>Your Rating : {{ userRatingOnShop.rating.rating }} <a-icon type="star" /> </p>
        <!-- <a-rate v-model="userRatingOnShop.rating.rating" disabled allow-half /> -->
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
  </div>
</template>

<script>
export default {
  props: ["shopId","shopOwner"],
  data() {
    return {
      rating: {
        value: 0,
        desc: ["terrible", "bad", "normal", "good", "wonderful"],
      },
      didRateAlready: false,
      userRatingOnShop: "",
    };
  },
  methods: {
    postRating() {
      this.$axios
        .post(`/rating/post/${this.shopId}`, {
          rating: this.rating.value,
        })
        .then((response) => {
          console.log(response);
          this.$message.success("Your rating has been submitted");
          //   this.fetchShop();
          this.getUserRatingOnShop();
        });
    },
    getUserRatingOnShop() {
      this.$axios
        .get(`/rating/getuserrating/${this.shopId}`)
        .then((response) => {
          this.userRatingOnShop = response.data;
          if (response.data.status != false) {
            this.didRateAlready = true;
          }
        });
    },
  },

  computed: {
    isShopOwner() {
      //to check if the logged in user is the owner of the shop
      if (this.shopOwner === this.$auth.user.id) {
        return true;
      }
      return false;
    }
  },
  created(){
      this.getUserRatingOnShop();
  }
}
</script>

<style>
</style>