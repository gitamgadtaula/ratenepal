<template>
  <div>{{token}}

    <label for="email" />
    <input type="email" v-model="form.email" /> <br />
    <label for="password" />
    <input type="password" v-model="form.password" />
    <br />
    <button @click="login">Login</button>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      token:'',
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
          this.token=response.data.token
          localStorage.setItem('userToken', this.token)
         this.$router.push('/')

        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>

<style></style>
