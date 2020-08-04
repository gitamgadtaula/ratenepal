<template>
  <div>
    <div class="container" id="parent">
      <div class="login-container">
        <img src="~/assets/ratenepal4.png" alt="" />
        <div>
          {{ form.error }}
          <a-form>
            <a-form-item>
              <p class="input-text">Username</p>
              <a-input
                id="email"
                size="large"
                v-model="form.email"
                placeholder="please enter email"
              />
              <a-icon slot="prefix" type="user" />
            </a-form-item>
            <a-form-item>
              <p class="input-text">Password</p>
              <a-input
                id="password"
                type="password"
                placeholder="Please enter password"
                v-model="form.password"
                size="large"
              >
              </a-input>
            </a-form-item>
            <a-form-item>
              <a-button
                type="primary"
                size="large"
                class="filled-light-button"
                html-type="submit"
                @click="login"
                style="width:100%"
              >
                Login
              </a-button>
              <div class="other-links">
                <span><a href="#">Register</a></span>
                <span>|</span>
                <span><a href="/forgot-password">Forgot Password</a></span>
              </div>
            </a-form-item>
          </a-form>
        </div>
      </div>
    </div>
    <!-- <hr>{{token}}
    <label for="email" />
    <input type="email" v-model="form.email" /> <br />
    <label for="password" />
    <input type="password" v-model="form.password" />
    <br />
    <button @click="login">Login</button> -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      token: "",
      form: {
        email: "admin@gmail.com",
        password: "admin123",
        error: ""
      }
    };
  },
  methods: {
    async login() {
      try {
        await this.$auth.loginWith("local", {
          data: {
            email: this.form.email,
            password: this.form.password
          }
        });
        this.$message.success('Logged in successfully',1);
        this.$router.push("/");
      } catch (e) {
        console.log(`error: ${e}`);
        this.form.error = e;

        this.$message.error("Invalid credentials");
      }
    }
  }
};
</script>

<style scoped>
.container {
  background-image: linear-gradient(-90deg, #ffffff, #e8f6ff);
  max-height: 100vh;
  min-height: 100vh;
  background-position: right;
}
img {
  width: 100px;
}

.ant-btn-primary {
  box-shadow: none;
}
.other-links span {
  font-size: 12px;
}
.other-links {
  text-align: center;
}

#parent {
  display: flex;
  flex: 0 0 400px;
  align-items: center;
  justify-content: center;
  flex-direction: row;
}
.login-container {
  width: 375px;
  justify-content: center;
  text-align: center;
  border: 1px solid #e2e2e2;
  padding: 20px 40px;
  box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}
.input-text {
  text-align: left;
  margin-bottom: 0;
  font-size: 12px;
  line-height: 25px;
}
.ant-form-item {
  margin-bottom: 15px;
}
.scan i {
  color: #3598dc;
}
</style>
