<template>
  <div class="container">
    <img src="@/assets/shops/shop-icon.png" style="width:100px;" />
    <h2>Create a shop</h2>
    <a-form-model :model="form" :rules="rules" ref="shopForm">
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
      </a-row>
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
        motto: "My motto",
        description: "My description",
        name: "My shop",
        phone1: "98989898",
        phone2: "98989898",
        website: "www.google.com",
        location: "Galaxy",
        email:'shop@email.com'
      },

      rules: {
        name: [{ required: true }],
        location: [{ required: true }],
        motto: [{ required: true }],
        description: [{ required: true }],
        phone1: [{ required: true},
        ],
        website: [{ required: true }]
      }
    };
  },
  methods: {
    handleChange(info) {},
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
      this.$axios
        .post("/shop/create", this.form)
        .then(response => {
          console.log(response);
          this.$message.success("Shop created Successfully", 4);
          this.$router.push("/");
        })
        .catch(error => {
          this.$message.error("Failed creating shop", 4);
        });
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
