<template>
  <div class="container">
    <img src="@/assets/shops/shop-icon.png" style="width:100px;" />

    <h2>Create a shop</h2>

    <a-form-model :model="form" :rules="rules" ref="shopForm">
      <a-row type="flex" justify="start" :gutter="12">
        <a-col :span="12">
          <a-form-model-item ref="name" label="Shop Name" prop="name">
            <a-input v-model="form.name" />
          </a-form-model-item>
        </a-col>
        <a-col :span="12">
          <a-form-model-item ref="name" label="Shop Motto" prop="motto">
            <a-input v-model="form.motto" />
          </a-form-model-item>
        </a-col>
      </a-row>

      <a-row type="flex" justify="start" :gutter="12">
        <a-col :span="12">
          <a-form-model-item ref="name" label="Shop Website" prop="website">
            <a-input v-model="form.website" />
          </a-form-model-item>
        </a-col>
        <a-col :span="12">
          <a-form-model-item ref="name" label="Activity name" prop="location">
            <a-input v-model="form.location" />
          </a-form-model-item>
        </a-col>
      </a-row>

      <a-row type="flex" justify="start" :gutter="12">
        <a-col :span="12">
          <a-form-model-item ref="name" label="Contact Number" prop="contact">
            <a-input v-model="form.contact" />
          </a-form-model-item>
        </a-col>
        <a-col :span="12">
          <a-form-model-item ref="name" label="Shop Description" prop="desc">
            <a-input v-model="form.desc" />
          </a-form-model-item>
        </a-col>
      </a-row>

      <a-upload
        name="file"
        :multiple="true"
        action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
        :headers="headers"
        @change="handleChange"
      >
        <a-button> <a-icon type="upload" /> Shop Logo </a-button>
      </a-upload>
    </a-form-model>
    <a-button type="primary" @click="onSubmit">
      Create a new shop
    </a-button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        motto: "",
        desc: "",
        name: "",
        contact: "",
        website: "",
        location: ""
      },
      headers: {
        authorization: "authorization-text"
      },
      rules: {
        name: [{ required: true }],
        location: [{ required: true }],
        motto: [{ required: true }],
        desc: [{ required: true }],
        contact: [{ required: true }],
        website: [{ required: true }]
      }
    };
  },
  methods: {
    handleChange(info) {
      // if (info.file.status !== "uploading") {
      //   console.log(info.file, info.fileList);
      // }
      // if (info.file.status === "done") {
      //   this.$message.success(`${info.file.name} file uploaded successfully`);
      // } else if (info.file.status === "error") {
      //   this.$message.error(`${info.file.name} file upload failed.`);
      // }
    },
    onSubmit() {
      this.$refs.shopForm.validate(valid => {
        if (valid) {
          this.createShop();
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
    createShop() {
      this.$axios.post("/shop/create",this.form).then(response => {
        console.log(response);
        this.$notification[success]({
        message: 'Success',
        description: 'created successfully'
           })
           this.$router.push('/')
      })
    }
  }
};
</script>

<style scoped>
.container {
  /* background-image: url("~@/assets/shops/shop-icon.png"); */
}
.ant-input {
  width: 90%;
  /* border-radius: 8px; */
}
</style>
