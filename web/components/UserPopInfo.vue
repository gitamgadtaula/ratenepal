<template>
  <div>
    <a-row type="flex" :gutter="12">
          <a-col>
            <img src="@/assets/user.jpg" class="user-dp" />
          </a-col>
          <a-col>
            <p>@{{ user.username }}</p>
            <p style="text-transform:capitalize;">{{ user.full_name }}</p>
          </a-col>
        </a-row>
        
    <!-- <a-popover>
      <template slot="content">
        <div class="user-container">
        <a-row type="flex" :gutter="12">
          <a-col>
            <img src="@/assets/user.jpg" class="user-dp" />
          </a-col>
          <a-col>
            <p>@{{ user.username }}</p>
            <p style="text-transform:capitalize;">{{ user.full_name }}</p>
          </a-col>
        </a-row>
        <p><a-icon type="environment" /> {{ user.location }}</p>
        <p><a-icon type="mail" /> {{ user.email }}</p>
        <p><a-icon type="environment" /> {{ user.gender }}</p>
        <p><a-icon type="crown" /> {{ user.occupation }}</p>
        </div>
      </template>
      <a-icon type="crown" v-if="isShopOwnerComment(item.user_id)" />
      <a-row type="flex" :gutter="12">
        <a-col>
          <img src="@/assets/user.jpg" class="user-dp" />
        </a-col>
        <a-col>
          <p>@{{ user.username }}</p>
          <p style="text-transform:capitalize;">{{ user.full_name }}</p>
        </a-col>
      </a-row>
    </a-popover> -->
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
  props: ["userId"],
  data() {
    return {
      user: ""
    };
  },
  methods: {
    getUser() {
      this.$axios.get(`/auth/user/${this.userId}`).then(response => {
        console.log(response.data);
        this.user = response.data.user;
      });
    }
  },
  created() {
    this.getUser();
  }
};
</script>
