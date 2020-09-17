<template>
  <div class="container">
    <Shop :shopId="shopId" />
  </div>
</template>

<script>
import Shop from "@/components/Shop/Index";

export default {
  auth: true,
  components: { Shop },
  data() {
    return {
      shopId: null,
    };
  },
  created() {
    this.shopId = this.$route.params.shop;
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
