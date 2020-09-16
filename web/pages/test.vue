<template>
  <div class="container">
    <a-upload
      accept="image/*"
      list-type="picture-card"
      :file-list="fileList"
      @preview="handlePreview"
      @change="handleChange"
    >
      <div v-if="fileList.length < 4">
        <a-icon type="plus" />
        <div class="ant-upload-text">Upload</div>
      </div>
    </a-upload>
    <a-modal :visible="previewVisible" :footer="null" @cancel="handleCancel">
      <img alt="example" style="width: 100%" :src="previewImage" />
    </a-modal>
    <button @click="sendImage">Submit</button>
  </div>
</template>

<script>
import Carousel from "@/components/Carousel.vue";
import ShowShopRating from "@/components/Rating/ShowShopRating.vue";
import SubmitRating from "@/components/Rating/SubmitRating.vue";
import Comments from "@/components/Comment/Comment.vue";
function getBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });
}
export default {
  components: { Carousel, ShowShopRating },
  data() {
    return {
      previewVisible: false,
      previewImage: "",
      name: "",
      fileList: [],
      image: [],
    };
  },
  methods: {
    handleCancel() {
      this.previewVisible = false;
    },
    async handlePreview(file) {
      if (!file.url && !file.preview) {
        file.preview = await getBase64(file.originFileObj);
      }
      this.previewImage = file.url || file.preview;
      this.previewVisible = true;
    },
    handleChange({ fileList }) {
      this.fileList = fileList;
    },
    sendImage() {
      const fd = new FormData();
      fd.append("shop_name", "My shop 123");
      fd.append("shop_id", 27);
      fd.append("img1", this.fileList[0].originFileObj);
      fd.append("img2", this.fileList[1].originFileObj);
      // fd.append("img3", this.fileList[2].originFileObj);
      // fd.append("img4", this.fileList[3].originFileObj);
      this.$axios.post("/shop/assets", fd).then((response) => {
        this.$message.success("success");
      });
    },
  },
  created() {},
};
</script>
<style scoped>
.shop-info {
  text-align: left;
  /* color: aqua; */
}
</style>
