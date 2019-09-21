<template>
  <div>
    <div v-if="validationErrors != 0" class="alert alert-danger">
      <ul>
        <li v-for="(error, key) in validationErrors" :key="key">{{error}}</li>
      </ul>
    </div>
    <form @submit.prevent="login" method="POST">
      <div class="alert alert-danger" id="invalid-login">Invalid Login Credentials!</div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input
          v-model="email"
          type="text"
          class="form-control"
          name="email"
          id
          placeholder="Example:youremail@gmail.com"
        />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
          v-model="password"
          type="text"
          class="form-control"
          name="password"
          id
          placeholder="Password"
        />
      </div>
      <label for="remember">Remember Me</label>
      <input v-model="remember" name="remember" type="checkbox" />
      <br />
      <button id="loginbutton" class="btn btn-primary">Login</button>
    </form>
  </div>
</template>

<script>
import $ from "jquery";
window.axios = require("axios");
// For adding the token to axios header (add this only one time).
window.axios.defaults.headers.common = {
  _token: document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content"),
  "X-Requested-With": "XMLHttpRequest",
  "X-CSRF-TOKEN": document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content")
};
export default {
  data() {
    return {
      email: "",
      password: "",
      remember: "",
      errors: ""
    };
  },
  methods: {
    login() {
      this.errors = "";
      $("#invalid-login").hide();
      $("#page-loader").show();
      $("#loginbutton").attr("disabled", true);
      axios
        .post("/signin", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          $("#page-loader").show();
          if (res.data != false) {
            window.location.href = "/";
          } else {
            $("#loginbutton").attr("disabled", false);
            $("#invalid-login").show();
            $("#page-loader").hide();
          }
        })
        .catch(err => {
          $("#loginbutton").attr("disabled", false);
          $("#page-loader").hide();

          this.errors = err.response.data.errors;
          console.log(err);
        });
    }
  },
  created() {},
  mounted() {},

  computed: {
    validationErrors() {
      let errors = Object.values(this.errors);
      errors = errors.flat();
      return errors;
    }
  }
};
</script>

<style>
#invalid-login {
  display: none;
}
</style>