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
          Contact
        </a-col>
        <a-col>
          About
        </a-col>
        <a-col>
          Shops
        </a-col>
        <a-col>
          My Profile
        </a-col>
        <a-col>
          Home
        </a-col>
      </a-row>
    </nav>
    <div style="padding:12px;">
      <Nuxt />
    </div>
  </div>
</template>

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
