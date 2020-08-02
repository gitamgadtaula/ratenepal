<template>
  <div>
    <div class="header">
      <a-row type="flex" justify="space-between">
        <a-col>
          <img src="@/assets/ratenepal2.png" style="height:50px;width:50px;" />
        </a-col>
        <a-col>
          Let's keep you Rated !
          <p
            v-if="this.$auth.loggedIn"
            style="margin:0px;font-size:12px;text-align:right;"
          >
            <a-icon type="user" /> {{ this.$auth.user.name }}
          </p>
        </a-col>
      </a-row>
    </div>
    <nav>
      <a-row type="flex" justify="end" :gutter="12">
        <a-col>
          Shops
        </a-col>
        <a-col>
          My Profile
        </a-col>
        <a-col>
          <nuxt-link to="/" style="color:white;">
            Home
          </nuxt-link>
        </a-col>
        <a-col v-if="$auth.loggedIn" @click="logout">
          Logout
        </a-col>
        <a-col v-else>
          <nuxt-link to="/login" style="color:white;"> Login </nuxt-link>
        </a-col>
        <a-col v-if="!$auth.loggedIn">
          <nuxt-link to="/register" style="color:white;"> Register </nuxt-link>
        </a-col>
      </a-row>
    </nav>
    <div style="padding:12px;">
      <Nuxt />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: ""
    };
  },
  methods: {
    async logout() {
      await this.$auth.logout();
      this.$router.push("/login");
    }
  },
  created() {
    // this.$auth.user = this.user;
  }
};
</script>

<style>
/* Header/Logo Title */
.header {
  padding: 12px;
  /* text-align: center; */
  background: #1a1a1d;
  color: white;
  font-size: 24px;
}
nav {
  background-color: #c3073f;
  padding: 5px 12px 5px 12px;
  font-size: 15px;
  color: white;
}
</style>
