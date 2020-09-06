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
       if (fileList.size > 300) {
        this.$message.error("Limit size exceeded");
      }
      this.fileList = fileList;
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
