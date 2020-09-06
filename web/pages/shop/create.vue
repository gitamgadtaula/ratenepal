<template>
  <div class="container">
    <img src="@/assets/shops/shop-icon.png" style="width:100px;" />

    <h2>Create a shop</h2>
    <a-steps :current="current">
      <a-step status title="Shop Information">
        <a-icon slot="icon" type="user" />
      </a-step>
      <a-step status title="Shop Assets">
        <a-icon slot="icon" type="solution" />
      </a-step>
    </a-steps>
    <a-spin :spinning="responseIsloading">
      <a-form-model :model="form" :rules="rules" ref="shopForm" v-if="current===0">
        <a-row type="flex" justify="start" :gutter="12">
          <a-col :span="12">
            <a-form-model-item label="Shop Name" prop="name">
              <a-input v-model="form.name" />
            </a-form-model-item>
          </a-col>
          <a-col :span="12">
            <a-form-model-item label="Shop Motto" prop="motto">
              <a-input v-model="form.motto" />
            </a-form-model-item>
          </a-col>
        </a-row>

        <a-row type="flex" justify="start" :gutter="12">
          <a-col :span="12">
            <a-form-model-item label="Shop Website" prop="website">
              <a-input v-model="form.website" />
            </a-form-model-item>
          </a-col>
          <a-col :span="12">
            <a-form-model-item label="Shop Location" prop="location">
              <a-input v-model="form.location" />
            </a-form-model-item>
          </a-col>
        </a-row>

        <a-row type="flex" justify="start" :gutter="12">
          <a-col :span="12">
            <a-form-model-item label="Primary Phone" prop="phone1">
              <a-input v-model="form.phone1" />
            </a-form-model-item>
          </a-col>
          <a-col :span="12">
            <a-form-model-item label="Secondary Phone">
              <a-input v-model="form.phone2" />
            </a-form-model-item>
          </a-col>
        </a-row>

        <a-row type="flex" justify="start" :gutter="12">
          <a-col :span="12">
            <a-form-model-item label="Shop Description" prop="description">
              <a-input v-model="form.description" />
            </a-form-model-item>
          </a-col>
          <a-col :span="12">
            <a-form-model-item label="Shop Logo" prop="image">
              <a-upload name="file" :multiple="false" @change="onImageChange">
                <a-button>
                  <a-icon type="upload" />Click to Upload
                </a-button>
              </a-upload>
            </a-form-model-item>
          </a-col>
        </a-row>
        <a-button type="primary" @click="onSubmit">
          Create a new shop
          <a-icon type="double-right"></a-icon>
        </a-button>
      </a-form-model>
    </a-spin>

    <div class="assets" v-if="current===1">
      <br />Choose your display picture:
      <br />
      <!-- <input type="file" class="form-control" @change="onImageChange" /> -->
      <!-- <a-upload name="file" :multiple="true" @change="onImageChange">
        <a-button>
          <a-icon type="upload" />Click to Upload
        </a-button>
      </a-upload>-->
      <br />
      <br />
      <a-button @click="imageSubmit">
        Upload
        <a-icon type="upload" />
      </a-button>
      <a-button type="primary" @click="onSubmit">
        Finish
        <a-icon type="check"></a-icon>
      </a-button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      responseIsloading: false,
      current: 0,
      image: "",
      imageName: "",
      form: {
        motto: "My motto",
        description: "My description",
        name: "My shop",
        phone1: "98989898",
        phone2: "98989898",
        website: "www.google.com",
        location: "Galaxy",
        email: "shop@email.com",
        image: "",
      },

      rules: {
        name: [{ required: true }],
        location: [{ required: true }],
        motto: [{ required: true }],
        description: [{ required: true }],
        phone1: [{ required: true }],
        website: [{ required: true }],
        image: [{ required: true }],
      },
    };
  },
  methods: {
    handleChange(info) {},
    onSubmit() {
      this.$refs.shopForm.validate((valid) => {
        if (valid) {
          this.createShop();
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
    createShop() {
      this.responseIsloading = true;
      const fd = new FormData();
      fd.append("name", this.form.name);
      fd.append("motto", this.form.motto);
      fd.append("website", this.form.website);
      fd.append("location", this.form.location);
      fd.append("description", this.form.description);
      fd.append("email", this.form.email);
      fd.append("phone1", this.form.phone1);
      fd.append("phone2", this.form.phone2);
      fd.append("logo", this.form.image);
      this.$axios
        .post("/shop/create", fd)
        .then((response) => {
          console.log(response.data);
          // this.current++;
          this.$message.success("Shop created Successfully", 4);
          this.responseIsloading = false;
        })
        .catch((error) => {
          this.$message.error("Failed creating shop", 4);
          this.responseIsloading = false;
        });
    },
    onImageChange(info) {
      if (info.file.status !== "uploading") {
        // this.imageName = info.fileList[0].name;
      }
      if (info.file.status === "done") {
        // this.image = info.fileList[0].originFileObj;
        this.form.image = info.fileList[0].originFileObj;
      } else if (info.file.status === "error") {
        this.$message.error(`${info.file.name} file upload failed.`);
      }
    },
    imageSubmit() {
      // const config = {
      //   headers: { "content-type": "multipart/form-data" },
      // };
      let formData = new FormData();
      formData.append("image", this.image);
      formData.append("shop_name", this.form.name);
      console.log(formData);

      this.$axios
        .post("/image", formData)
        .then((response) => {
          console.log(response.data);
          // currentObj.success = response.data.success;
          this.$message.success("uploaded successfully");
        })
        .catch(function (error) {
          console.log(error); // currentObj.output = error;
        });
    },
  },
};
</script>

<style scoped>
/* .container {
  background-image: url("~@/assets/shops/shop-icon.png");
} */
.ant-input {
  width: 90%;
  /* border-radius: 8px; */
}
</style>
