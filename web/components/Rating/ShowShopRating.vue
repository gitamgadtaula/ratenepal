<template>
  <div class="container">
    <h2 style="margin:0px;">
      <a-icon type="star" theme="filled" filled-color="#f3b525" :style="{ fontSize: '28px' }" />
      {{ data | getRating }} / 5
      <p style="margin-left:35px;margin-top:0px;font-size:12px;">  {{data|getLength}} Ratings</p> 
    </h2>

    <br />
    <!-- <a-rate :default-value="data|getRating" allow-half disabled /> -->
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {};
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
    getLength(value) {
      //total no of ratings
      return value.length;
    },
  },
};
</script>

<style>
</style>