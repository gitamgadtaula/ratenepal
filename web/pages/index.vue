<template>
  <div>
    <a-row type="flex" justify="end">
      <nuxt-link to="/shop/create">
        <a-button size="large" type="primary">
          <a-icon type="form" />Create a shop
        </a-button>
      </nuxt-link>
    </a-row>

    <div class="shop-container" v-for="(item, index) in shopData" :key="index">
      <nuxt-link :to="shopLink">
        <div class="shop-card" @click="generateLink(item.id)">
          <div class="shop-title">
            <p style="text-align:center;">{{ item.name.toUpperCase() }}</p>
          </div>
          <div class="shop-image">
            <img :src="`${baseURL}/assets/${item.logo}`" style="width:200px;height:140px;" />
          </div>
          <div class="shop-footer">
            <a-icon type="environment" theme="twoTone" two-tone-color="#eb2f96" />
            {{ item.location.toUpperCase() }}
            <br />
            <a-icon
              type="star"
              theme="twoTone"
              two-tone-color="#eb2f96"
              :style="{ fontSize: '18px' }"
            />
            {{ item.ratings | getRating }}
          </div>
        </div>
      </nuxt-link>
    </div>
  </div>
</template>

<script>
// import baseURL from "@/components/baseURL";
export default {
  auth: true,
  data() {
    return {
      baseURL: "http://localhost:8000",
      shopData: "",
      shopRating: "",
      shopLink: "",
    };
  },
  methods: {
    getAllShop() {
      this.$axios.get("/shop/getall").then((response) => {
        this.shopData = response.data;
      });
    },
    generateLink(param) {
      this.shopLink = `/shop/${param}`;
    },
  },

  filters: {
    getRating(value) {
      console.log(value);
      const length = value.length;
      if (length === 0) {
        return "not rated yet";
      }
      const sum = value.reduce((acc, item) => acc + item.rating, 0);
      return (sum / length).toFixed(1); //round upto 2 decimal
    },
  },
  created() {
    this.getAllShop();
  },
};
</script>

<style scoped>
.shop-container {
  margin-top: 5px;
  display: inline-block;
  width: 260px;
}
.shop-card {
  padding: 10px;
  margin: 12px 6px 6px 12px;
  color: #000000;
  /* background: #f4fbff; */
  background: #ffffff;
  border: 1px solid #add9f8;
  box-sizing: border-box;
  box-shadow: 3px 4px 4px rgba(213, 211, 211, 0.25);
  border-radius: 6px;
}
</style>
