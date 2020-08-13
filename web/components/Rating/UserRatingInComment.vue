<template>
  <div>
    <a-rate
      v-if="rating.status"
      v-model="rating.rating.rating"
      disabled
      allow-half
    />
    <span v-else> Not rated yet </span>
  </div>
</template>
<style scoped>
.user-container {
  background: #ffffff;
  border: 1px solid #add9f8;
  box-sizing: border-box;
  box-shadow: 3px 4px 4px rgba(213, 211, 211, 0.25);
  border-radius: 6px;
  padding: 5px 10px;
}
.user-dp {
  height: 50px;
  border-radius: 50%;
}
p {
  margin: 1px;
}
</style>
<script>
export default {
  components: {},
  props: ["userId", "shopId"],
  data() {
    return {
      rating: ""
    };
  },
  methods: {
    getUser() {
      this.$axios
        // .get(`/rating/getuserrating/4/1`)
        .get(`/rating/getuserrating/${this.shopId}/${this.userId}`)
        .then(response => {
          console.log(response.data);
          this.rating = response.data;
        });
    }
  },
  created() {
    this.getUser();
  }
};
</script>
