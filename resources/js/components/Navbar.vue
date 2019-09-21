<template>
  <div>
    <loginmodal v-if="loginModalOpen" @closeModal="loginModalOpen = false"></loginmodal>
    <div class="navbar-shell">
        <div class="school-logo"></div>
        <div class="navbar-subshell">
          <div class="nav-top">
              <p class="school-name">University of Greater Ontario</p>
              <div class="nav-top-side">
                <div class="button" @click="scollToRegister()">Register</div>
                <div class="button" @click="loginModalOpen = true">Login</div>
              </div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import './../../sass/navbar.scss'
import loginmodal from './LoginModal'
export default {
  name: "navbar",
  components: {
      loginmodal
  },
  data: function() {
    return {
      loginModalOpen: false,
    };
  },
  methods: {
    scollToRegister() {
      document.getElementById("registration-form").scrollIntoView()
    }
  }
};
</script>