<template>
  <div>
    <div class="shop-container" v-for="(item, index) in shopData" :key="index">
      <div class="shop-card">
        <div class="shop-title">
          <p style="text-align:center;">{{ item.name.toUpperCase() }}</p>
        </div>
        <div class="shop-image">
          <img
            src="@/assets/shops/logo.png"
            style="width:200px;height:140px;"
          />
        </div>
        <div class="shop-footer">
          <a-icon type="environment"  theme="twoTone" two-tone-color="#eb2f96" /> {{ item.location.toUpperCase() }}
          <br />
          <a-icon type="star" theme="twoTone" two-tone-color="#eb2f96" :style="{ fontSize: '18px'}" /> {{ item.ratings | getRating }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      shopData: "",
      shopRating: ""
    };
  },
  methods: {
    getAllShop() {
      axios.get("http://127.0.0.1:8000/api/shop/getall").then(response => {
        console.log(response.data);
        this.shopData = response.data;
      });
    }
  },
  computed: {},
  filters: {
    getRating(value) {
      console.log(value);
      const length = value.length;
      if (length === 0) {
        return "not rated yet";
      }
      const sum = value.reduce((acc, item) => acc + item.rating, 0);
      return (sum / length).toFixed(2);//round upto 2 decimal
    }
  },
  created() {
    this.getAllShop();
  }
};
</script>

<style>
.shop-container {
  display: inline-block;
  background-color: black;
}
.shop-card {
  background-color: #f3d250;
  padding: 10px;
  border: 1px solid #252525;
  max-width: 300px;
  border-radius: 5px;
  margin: 12px 4px 6px 12px;
  color: #000000;
}
</style>
