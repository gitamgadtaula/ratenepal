<template>
  <div class="container">
    <h1>My Shop</h1>
    <hr />
    <a-carousel arrows>
      <div
        slot="prevArrow"
        slot-scope="props"
        class="custom-slick-arrow"
        style="left: 10px;zIndex: 1"
      >
        <a-icon type="left-circle" />
      </div>
      <div
        slot="nextArrow"
        slot-scope="props"
        class="custom-slick-arrow"
        style="right: 10px"
      >
        <a-icon type="right-circle" />
      </div>
      <div><h3>1</h3></div>
      <div><h3>2</h3></div>
      <div><h3>3</h3></div>
      <div><h3>4</h3></div>
    </a-carousel>
    <span>
      <a-rate v-model="rating.value" :tooltips="rating.desc" />
      <span class="ant-rate-text">{{ rating.desc[rating.value - 1] }}</span>
    </span>
    <a-row type="flex" justify="space-between">
      <a-col :span="16">
        My Desc
      </a-col>
      <a-col :span="8" style="border-left:1px solid #dedede;">
        <p class="shop_info">Location :</p>
        <p class="shop_info">Contact :</p>
        <p class="shop_info">Email :</p>
        <p class="shop_info">Website :</p>
      </a-col>
    </a-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      rating: {
        value: 3,
        desc: ["terrible", "bad", "normal", "good", "wonderful"]
      }
    };
  }
};
</script>

<style>
.container {
  margin: 0 auto;
  display: block;
  min-height: 100vh;
}
.ant-carousel >>> .slick-slide {
  text-align: center;
  height: 160px;
  line-height: 160px;
  background: #364d79;
  overflow: hidden;
}

.ant-carousel >>> .custom-slick-arrow {
  width: 25px;
  height: 25px;
  font-size: 25px;
  color: #fff;
  background-color: rgba(31, 45, 61, 0.11);
  opacity: 0.3;
}
.ant-carousel >>> .custom-slick-arrow:before {
  display: none;
}
.ant-carousel >>> .custom-slick-arrow:hover {
  opacity: 0.5;
}

.ant-carousel >>> .slick-slide h3 {
  color: #fff;
}
</style>
