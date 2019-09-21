<template>
  <div>
  <div class="text-center">
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#studentModal">Your Overview</button>
  </div>
    <div class="modal fade" id="studentModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Student Overview</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body d-flex justify-content-center flex-wrap">
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Program</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(user, key) in users" :key=key>

      <td>
      {{user.StudentFirstName}}
     
      
      </td>
      <td>
       {{user.StudentLastName}}
      </td>
      <td>
      {{user.Program}}
      </td>


    </tr>
  </tbody>
</table>
          <div v-for="(course, key) in courses" :key=key class="card  mb-3 mr-4" style="width: 35%;">
            <div class="card-header bg-light ">{{course.CourseName}}</div>
              <div class="card-body bg-light">
                <h5 class="card-title">{{ course.InstructorFirstName }}</h5>
                <p class="card-text">{{course.Description}}</p>
            </div>
          <div  class="card-footer bg-light text-center"><button @click="dropCourse(course.CourseID,course.InstructorID, key)" class="btn btn-primary">Drop</button></div>
        </div>

        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
</template>


<script>
import $ from "jquery";

window.axios = require("axios");
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
      userid: this.$route.params.userid,
      courseid: this.$route.params.courseid,
      admin: this.$route.params.admin,
      courses: [],
      users: []
    };
  },

  methods: {
     dropCourse(courseid, instructorid,key) {
      //  alert("working?")
      $("#page-loader").show();
      axios
        .post("/dropcourse", {
          courseid: courseid,
          instructorid: instructorid,
          userid: this.userid
        })
        .then(res => {
          this.courses.splice(key, 1);
          this.courses = "";
          this.fetchUserCourses();
          this.$parent.fetchCourses();
           $("#studentModal").modal("show");
        })
        .catch(err => {
          alert("the request failed!");
          $("#page-loader").hide();
        });
    },
    checkIfAdmin() {
      axios
        .post("/checkadmin/")
        .then(res => {
          this.admin = res.data;
        })
        .catch(err => {
          alert(err);
        });
    },
    isLoggedIn() {
      axios
        .post("/checklogin/")
        .then(res => {
          this.userid = res.data;
          this.fetchUser();
          this.fetchUserCourses();
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
    fetchUserCourses() {
      axios
        .post("/getusercourses", {
          userid: this.userid
        })
        .then(res => {
          console.log(res.data)
          $("#page-loader").hide();

          this.courses = res.data;
        })
        .catch(err => { 
        });
    }
  },
  created() {
    $("#page-loader").show();
    this.isLoggedIn();
    this.checkIfAdmin();
  },

};
</script>


<style>

</style>
