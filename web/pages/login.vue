<template>
  <div>
    <div class="container" id="parent">
      <div class="login-container">
        <img src="~/assets/ratenepal4.png" alt="">
        <div>
          <a-form>
            <a-form-item>
              <p class="input-text">Username</p>
              <a-input id="email" size="large" v-model="form.email" placeholder="please enter email" />
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
                <span><a href="#">Cancel</a></span>
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
import axios from "axios";

export default {
  data() {
    return {
      token: "",
      form: {
        email: "admin@gmail.com",
        password: "admin123"
      }
    };
  },
  methods: {
    login() {
      axios
        .post("http://127.0.0.1:8000/api/auth/login", this.form)
        .then(response => {
          console.log(response);
          this.token = response.data.token;
          localStorage.setItem("userToken", this.token);
          this.$router.push("/");
        })
        .catch(err => {
          console.log(err);
        });
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
.login-section {
  margin: auto;
  vertical-align: center;
  text-align: center;
  background-color: white;
  transition: visibility 0s 2s, opacity 2s linear;
}
img {
  width: 100px;
}
.login-head {
  font-size: 18px;
  /*border-bottom: 1px solid #e6e6e6;*/
  padding-bottom: 10px;
}
.survey-image {
  width: 100%;
  margin: auto;
  opacity: 0.5;
}
.login-content {
  overflow: hidden;
  border: 1px solid #f7f8fb;
  background-color: white;
  box-shadow: 38px 15px 30px #d6d6d6;
  position: relative;
  width: 400px;
  max-width: 100%;
  padding: 30px 35px 20px;
  margin: 130px auto;
  overflow: hidden;
  -webkit-box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3),
    0 15px 12px rgba(0, 0, 0, 0.22);
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
}

.test {
  background-size: cover;
  height: 100vh;
  opacity: 0.6;
  background-image: linear-gradient(-90deg, #ffffff, #e8f6ff);
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
