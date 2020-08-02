<template>
  <div class="container">
    <a-row type="flex" justify="space-between">
      <a-col>
        <h1 class="title" v-if="shopResponse">
          {{ shop.name.toUpperCase() }}
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
          <span v-if="shopResponse"> {{ shop.ratings | getRating }} / 5 </span>
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
    <span>
      <a-rate v-model="rating.value" :tooltips="rating.desc" />
      <span class="ant-rate-text">{{ rating.desc[rating.value - 1] }}</span>
    </span>
    <a-row type="flex" justify="space-between">
      <a-col :span="12">
        <h2>{{ shop.desc }}</h2>
      </a-col>
      <a-col :span="12" style="border-left:1px solid #dedede;padding: 4px;">
        <p class="shop_info">
          <a-icon type="environment" /> Location : {{ shop.location }}
        </p>
        <p class="shop_info">
          <a-icon type="phone" /> Contact :{{ shop.contact }}
        </p>
        <p class="shop_info"><a-icon type="mail" /> Email :{{ shop.email }}</p>
        <p class="shop_info">
          <a-icon type="global" /> Website :{{ shop.website }}
        </p>
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
        value: 3,
        desc: ["terrible", "bad", "normal", "good", "wonderful"]
      },
      shop: "",
      shopResponse: false
    };
  },
  methods: {
    fetchShop(shop_id) {
      this.$axios.get(`/shop/${this.$route.params.shop}`).then(response => {
        this.shop = response.data;
        this.shopResponse = true;
      });
    }
  },

  filters: {
    getRating(value) {
      console.log(value);
      const length = value.length;
      console.log(length);
      if (length === 0) {
        return "Not rated yet";
      }
      const sum = value.reduce((acc, item) => acc + item.rating, 0);
      return (sum / length).toFixed(2); //round upto 2 decimal
    }
  },
  created() {
    // console.log(this.$route.params.shop);
    this.fetchShop();
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
</style>
