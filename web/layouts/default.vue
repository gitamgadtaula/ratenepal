<template>
  <div>
    <div class="header">
      <a-row type="flex" justify="space-between">
        <a-col>
          <img src="@/assets/ratenepal2.png" style="height:50px;width:50px;" />
        </a-col>
        <a-col>
          Let's keep you Rated !
        </a-col>
      </a-row>
    </div>
    <nav>
      <a-row type="flex" justify="end" :gutter="12">
        <a-col>
          About
        </a-col>
        <a-col>
           <nuxt-link to="/home" style="color:white;">  Shops </nuxt-link>
        </a-col>

        <a-col>
          <nuxt-link to="/" style="color:white;">
            Home
          </nuxt-link>
        </a-col>
        <a-col v-if="$auth.loggedIn">
          <a-dropdown :trigger="['click']">
            <a class="ant-dropdown-link" style="color:white;">
              <a-icon type="user" /> {{ this.$auth.user.username }}
            </a>
            <a-menu slot="overlay">
              <a-menu-item key="0">
                <nuxt-link to="/profile">
                  <a-icon type="user" /> My Profile</nuxt-link
                >
              </a-menu-item>
              <a-menu-item key="1" @click="logout">
                <a-icon type="logout" /> Logout
              </a-menu-item>
            </a-menu>
          </a-dropdown>
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
.nuxt-link {
  color: white;
  text-decoration: none;
}
</style>
