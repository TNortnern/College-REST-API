<template>
  <div>
    <div class="navbar-shell">
        <div class="school-logo"></div>
        <div class="navbar-subshell">
          <div class="nav-top">
              <p class="school-name">University of Greater Ontario</p>
              <p class="user-name" v-if="instructors[0]">Welcome back Professor {{instructors[0].InstructorFirstName}} {{instructors[0].InstructorLastName}}</p>
              <div class="nav-top-side">
                <router-link to="/students"><div class="button">Students</div></router-link>
                <router-link to="/courses"><div class="button">Courses</div></router-link>
                <router-link to="/instructors"><div class="button">Instructors</div></router-link>
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
  name: "instructorNavbar",
  data: function() {
    return {
      loginModalOpen: false,
      users: [],
      instructors: [],
      admin: []
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
    fetchInstructors() {
      axios
        .get("/api/instructors")
        .then(res => {
          this.instructors = res.data;
        })
        .catch(err => {
          alert(err);
        });
    }
  },
  created() {
    this.fetchInstructors();
  }
};
</script>