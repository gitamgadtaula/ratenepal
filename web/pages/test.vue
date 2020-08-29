<template>
  <div class="container">
    <a-upload name="file" :multiple="true" @change="handleChange">
      <a-button>
        <a-icon type="upload" />Click to Upload
      </a-button>
    </a-upload>
    <!-- <input type="file" class="form-control" v-on:change="onImageChange" /> -->
    <button @click="formSubmit">kjaghk</button>
    <!-- <a-row type="flex" justify="start" :gutter="12">
      <a-col :span="10">
        <div class="carousel">
          <Carousel />
        </div>
      </a-col>

      <a-col :span="8">
        <h1>{{shop.name}}</h1>
        <p class="motto">{{shop.motto}}</p>
        <div class="show-rating">
          <show-shop-rating :data="shop.ratings" v-if="responseDidLoad" />
          <SubmitRating :shopId="shopId" :shopOwner="shop.user_id" />
        </div>
        <div class="shop-info">
          <a-row type="flex" justify="space-between" :gutter="12">
            <a-col :span="12">
              <p>
                <a-icon type="ie" :style="{ fontSize: '24px', color: '#000' }" />
                <a :href="shop.website">{{ shop.website }}</a>
              </p>
            </a-col>
            <a-col :span="12">
              <p>
                <a-icon type="phone" :style="{ fontSize: '24px', color: '#000' }" />
                {{ shop.phone1 }}
              </p>
            </a-col>
          </a-row>
          <a-row type="flex" justify="space-between" :gutter="12">
            <a-col :span="12">
              <p>
                <a-icon type="mail" :style="{ fontSize: '24px', color: '#000' }" />
                {{ shop.email }}
              </p>
            </a-col>
            <a-col :span="12">
              <p>
                <a-icon type="environment" :style="{ fontSize: '24px', color: '#000' }" />
                {{ shop.location }}
              </p>
            </a-col>
          </a-row>
        </div>
      </a-col>
    </a-row>

    <a-row style="margin-top:50px;">
      <div class="shop-desc">
        <h3>{{ shop.description }}</h3>
      </div>
    </a-row>
    <a-row type="flex" style="margin-top:50px;">
      <a-col :span="24">
        <Comment :shopId="shopId" :shopOwnerId="shop.user_id"/>
      </a-col>
    </a-row>-->
  </div>
</template>

<script>
import Carousel from "@/components/Carousel.vue";
import ShowShopRating from "@/components/Rating/ShowShopRating.vue";
import SubmitRating from "@/components/Rating/SubmitRating.vue";
import Comments from "@/components/Comment/Comment.vue";

export default {
  components: { Carousel, ShowShopRating },
  data() {
    return {
      shopId: 1,
      shop: "",
      responseDidLoad: false,
      name: "",
      image: "",
      info: "",
    };
  },
  methods: {
    handleChange(info) {
      // this.info = info;
      // this.image = info.target.files[0];
      if (info.file.status !== "uploading") {
        console.log("file: " + info.file, "fileList: " + info.fileList);
        // this.image = info.fileList[0].originFileObj;
      }
      if (info.file.status === "done") {
        this.image = info.fileList[0].originFileObj;
      } else if (info.file.status === "error") {
        this.$message.error(`${info.file.name} file upload failed.`);
      }
    },

    onImageChange(e) {
      console.log(e.target.files[0]);
      this.image = e.target.files[0];
    },

    formSubmit(e) {
      e.preventDefault();

      let currentObj = this;

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };
      let formData = new FormData();
      formData.append("image", this.image);
      formData.append('name','myshop')
      console.log(formData);
      // const req = { image: this.image };
      this.$axios
        .post("/image", formData, config)
        .then(function (response) {
          // currentObj.success = response.data.success;
          this.$message.success(`${info.file.name} file uploaded successfully`);
        })
        .catch(function (error) {
          console.log(error); // currentObj.output = error;
        });
    },
  },
  created() {
    // this.getshop();
  },
};
</script>
<style scoped>
.shop-info {
  text-align: left;
  /* color: aqua; */
}
</style>
