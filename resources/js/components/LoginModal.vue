<template>
    <div class="modal-surrounding">
        <div class="modal-container">
            <div class="modal-sidebar-container">
                <div class="modal-close-button" @click='closeModal()'>X</div>
                <form @submit.prevent="login" method="POST" class="modal-sidebar">
                    <div class="alert alert-danger" id="invalid-login">Invalid Login Credentials!</div>
                    <div v-if="validationErrors != 0" class="alert alert-danger">
                        <ul>
                          <li v-for="(error, key) in validationErrors" :key="key">{{error}}</li>
                        </ul>
                    </div>
                    <input v-model="email" type="text" class="modal-input" placeholder="email">
                    <input v-model="password" type="password" class="modal-input" placeholder="password">
                    <div>
                        <label for="remember">Remember Me</label>
                        <input v-model="remember" name="remember" type="checkbox" />
                    </div>
                    <button id="loginbutton" class="button">Login</button>
                </form>
            </div>
            <div class="modal-description">
                <p>Campus<br>Login</p>
            </div>
        </div>
    </div>
</template>

 <script>
import './../../sass/login-modal.scss'
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
  name: 'login-modal',
  data() {
        return {
        email: "",
        password: "",
        remember: "",
        errors: ""
        };
  },
  methods: {
        closeModal() {
            this.$emit("closeModal", true)
        },
        login() {
        this.errors = "";
        $("#invalid-login").hide();
        $("#page-loader").show();
        $("#loginbutton").attr("disabled", true);
        $(".modal-surrounding").css("z-index",0);
        $(".navbar-shell").css("z-index",0);
        axios
            .post("/signin", {
            email: this.email,
            password: this.password
            })
            .then(res => {
            window.sessionStorage.userId = res.data.split(' ')[1]
            if (res.data) {
                let checker = res.data.split(' ');
                if(checker[0] == 's'){
                    window.location.href = "/student-profile"
                }else{
                    window.location.href = "/instructor-profile"
                }
            } else {
                $("#loginbutton").attr("disabled", false);
                $("#invalid-login").show();
                $("#page-loader").hide();
                $(".modal-surrounding").css("z-index",900);
                $(".navbar-shell").css("z-index",100);
                
            }
            })
            .catch(err => {
            $("#loginbutton").attr("disabled", false);
            $("#page-loader").hide();
            $(".modal-surrounding").css("z-index",900);
             $(".navbar-shell").css("z-index",100);

            this.errors = err.response.data.errors;
            console.log(err);
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