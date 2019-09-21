<template>
  <div>
    <div v-if="validationErrors != 0" class="alert alert-danger">
      <ul>
        <li v-for="(error, key) in validationErrors" :key="key">{{error}}</li>
      </ul>
    </div>
    <form @submit.prevent="register" action method="post">
      <div class="form-group">
        <label for="firstname">First Name</label>
        <input
          type="text"
          class="form-control"
          name
          id
          placeholder="Enter First Name"
          v-model="firstname"
        />
      </div>
      <div class="form-group">
        <label for="lastname">Last Name</label>
        <input
          type="text"
          class="form-control"
          name
          id
          placeholder="Enter Last Name"
          v-model="lastname"
        />
      </div>
      <div class="form-group">
        <label for="email">E-mail Address</label>
        <input
          type="text"
          class="form-control"
          name
          id
          placeholder="Enter E-mail Address"
          v-model="email"
        />
      </div>
      <div class="form-group">
        <label for="pnum">Phone Number</label>
        <input
          type="text"
          class="form-control"
          name
          id
          placeholder="Enter Phone Number"
          v-model="pnum"
        />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
          type="text"
          class="form-control"
          name
          id
          placeholder="Enter Password"
          v-model="password"
        />
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input
          type="text"
          class="form-control"
          name
          id
          placeholder="Confirm Password"
          v-model="confirm"
        />
      </div>
      <button id="loginbutton" class="btn btn-primary">Register</button>
    </form>
  </div>
</template>

<script>
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
      firstname: "",
      lastname: "",
      email: "",
      password: "",
      confirm: "",
      pnum: "",
      errors: ""
    };
  },
  methods: {
    register() {
      $("#page-loader").show();
      $("#loginbutton").attr("disabled", true);
      axios
        .post("/register", {
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          phonenumber: this.pnum,
          password: this.password,
          password_confirmation: this.confirm
        })
        .then(res => {
          window.location.href = "/";
        })
        .catch(err => {
          $("#page-loader").hide();
          this.errors = err.response.data.errors;
          $("#loginbutton").attr("disabled", false);
        });
    }
  },

  computed: {
    validationErrors() {
      let errors = Object.values(this.errors);
      errors = errors.flat();
      return errors;
    }
  }
};
</script>