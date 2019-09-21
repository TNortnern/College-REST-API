<template>
  <div>
    <div class="navbar-shell">
        <div class="school-logo"></div>
        <div class="navbar-subshell">
          <div class="nav-top">
              <p class="school-name">University of Greater Ontario</p>
              <p class="user-name" v-if="users[0]">Welcome back {{users[0].StudentFirstName}} {{users[0].StudentLastName}}</p>
              <div class="nav-top-side">
                <router-link to="/courses"><div class="button">Enroll</div></router-link>
                <div class="button" @click="logout()">Logout</div>
              </div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import './../../sass/navbar.scss'
export default {
  name: "studentNavbar",
  data: function() {
    return {
      users: [],
      userid: window.sessionStorage.userId,
    };
  },
  methods: {
    logout() {
      $("#page-loader").show();
      axios
        .post("/signout", {})
        .then(res => {
          window.location.href = "/";
        })
        .catch(err => {
          alert(err);
        });
    },
    fetchUser() {
      axios
        .post("/getuser", {
          userid: this.userid,
          admin: this.admin
        })
        .then(res => {
          this.users = res.data;
        })
        .catch(err => {
          alert(err);
        });
    },
  },
  created() {
    this.fetchUser();
  }
};
</script>