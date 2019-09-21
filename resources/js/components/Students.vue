<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Students</div>

          <div class="card-body">
            <h2>List of Students</h2>
            <div v-for="(student,key) in students" :key="key">
              <hr />
              <h4>{{(key+1) + '. ' + student.StudentFirstName + ' ' + student.StudentLastName }}</h4>
              <!-- Button trigger modal -->
              <button
                @click="getStudentDetails(student, key)"
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#editModal"
              >Edit</button>
              <button @click="remove(student, key)" class="btn btn-danger">Delete</button>
              <hr />
            </div>
            <form @submit.prevent="create" method="POST">
              <h1>Create a Student</h1>
              <div class="form-group">
                <label for="fname">First Name</label>
                <input
                  v-model="FName"
                  type="text"
                  class="form-control"
                  name="fname"
                  id="fname"
                  placeholder="Enter First Name"
                />
              </div>
              <div class="form-group">
                <label for="lname">Last Name</label>
                <input
                  v-model="LName"
                  type="text"
                  class="form-control"
                  name="lname"
                  placeholder="Enter Last Name"
                />
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  v-model="Email"
                  type="email"
                  class="form-control"
                  name="email"
                  placeholder="Enter Email"
                />
              </div>
              <div class="form-group">
                <label for="phonenum">Phone Number</label>
                <input
                  v-model="PNum"
                  type="tel"
                  class="form-control"
                  name="phonenum"
                  placeholder="Enter Phone Number"
                />
              </div>
              <div class="form-group">
                <label for="home">Homestate</label>
                <input
                  v-model="Home"
                  type="text"
                  class="form-control"
                  name="home"
                  placeholder="Enter Home State"
                />
              </div>
              <!-- <div class="form-group">
                <label for="date">Birth Date</label>
                <input
                  v-model="Date"
                  type="date"
                  class="form-control"
                  name="date"
                  placeholder="Enter Birth Date"
                />
              </div>-->
              <div class="form-group">
                <label for="gender">Gender</label>
                <input
                  v-model="Gender"
                  type="text"
                  class="form-control"
                  name="gender"
                  placeholder="Enter Gender"
                />
              </div>
              <button id="create-student" class="btn btn-primary">Create Student</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="editModalTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="update" action method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="fname">First Name</label>
                <input
                  v-model="FName"
                  type="text"
                  class="form-control"
                  name="fname"
                  id="fname"
                  placeholder="Enter First Name"
                />
              </div>
              <div class="form-group">
                <label for="lname">Last Name</label>
                <input
                  v-model="LName"
                  type="text"
                  class="form-control"
                  name="lname"
                  placeholder="Enter Last Name"
                />
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  v-model="Email"
                  type="email"
                  class="form-control"
                  name="email"
                  placeholder="Enter Email"
                />
              </div>
              <div class="form-group">
                <label for="phonenum">Phone Number</label>
                <input
                  v-model="PNum"
                  type="tel"
                  class="form-control"
                  name="phonenum"
                  placeholder="Enter Phone Number"
                />
              </div>
              <div class="form-group">
                <label for="home">Homestate</label>
                <input
                  v-model="Home"
                  type="text"
                  class="form-control"
                  name="home"
                  placeholder="Enter Home State"
                />
              </div>
              <!-- <div class="form-group">
                <label for="date">Birth Date</label>
                <input
                  v-model="Date"
                  type="date"
                  class="form-control"
                  name="date"
                  placeholder="Enter Birth Date"
                />
              </div>-->
              <div class="form-group">
                <label for="gender">Gender</label>
                <input
                  v-model="Gender"
                  type="text"
                  class="form-control"
                  name="gender"
                  placeholder="Enter Gender"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button id="save-changes" type="submit" class="btn btn-primary">Save Changes</button>
              <button
                id="close-editor"
                @click="closeEdit"
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
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
      students: [],
      ID: "",
      FName: "",
      LName: "",
      Email: "",
      PNum: "",
      Home: "",
      Date: "",
      Gender: "",
      Key: ""
    };
  },
  methods: {
    clearForm() {
      this.FName = "";
      this.LName = "";
      this.Email = "";
      this.PNum = "";
      this.Home = "";
      this.Gender = "";
    },
    openEdit() {},
    closeEdit() {
      this.clearForm();
      $("#editModal").modal("hide");
      $("#save-changes").attr("disabled", false);
      $("#close-editor").attr("disabled", false);
    },
    getStudentDetails(student, key) {
      this.ID = student.StudentID;
      this.FName = student.StudentFirstName;
      this.LName = student.StudentLastName;
      this.Email = student.StudentEmail;
      this.PNum = student.StudentPhoneNumber;
      this.Home = student.HomeState;
      this.Gender = student.Gender;
      this.Key = key;
    },
    fetchStudents() {
      $("#page-loader").show();
      axios
        .get("api/students")
        .then(res => {
          $("#page-loader").hide();
          this.students = res.data;
        })
        .catch(err => {
          alert(err);
        });
    },
    create() {
      $("#page-loader").show();
      $("#create-student").attr("disabled", true);
      axios
        .post("/students/", {
          FName: this.FName,
          LName: this.LName,
          Email: this.Email,
          PNum: this.PNum,
          Home: this.Home,
          Gender: this.Gender
        })
        .then(res => {
          $("#page-loader").hide();
          $("#create-student").attr("disabled", false);
          this.students.unshift(res.data);
          this.clearForm();
        })
        .catch(err => {
          alert(err);
          $("#create-student").attr("disabled", false);
        });
    },
    update() {
      $("#page-loader").show();
      $("#save-changes").attr("disabled", true);
      $("#close-editor").attr("disabled", true);
      axios
        .put(`/students/${this.ID}`, {
          FName: this.FName,
          LName: this.LName,
          Email: this.Email,
          PNum: this.PNum,
          Home: this.Home,
          Gender: this.Gender
        })
        .then(res => {
          $("#page-loader").hide();
          // Update array async
          this.students[this.Key].StudentFirstName = this.FName;
          this.students[this.Key].StudentLastName = this.LName;
          this.students[this.Key].StudentEmail = this.Email;
          this.students[this.Key].StudentPhoneNumber = this.PNum;
          this.students[this.Key].HomeState = this.Home;
          this.students[this.Key].Gender = this.Gender;
          this.closeEdit();
        })
        .catch(err => {
          alert(err);
          $("#save-changes").attr("disabled", false);
          $("#close-editor").attr("disabled", false);
        });
    },
    remove(student, key) {
      $("#page-loader").show();
      axios
        .delete(`/students/${student.StudentID}`)
        .then(res => {
          $("#page-loader").hide();
          this.students.splice(key, 1);
        })
        .catch(err => {
          alert(err);
        });
    }
  },
  created() {
    this.fetchStudents();
    //set component to call from jquery fuction
    let app = this;
    $(document).on("hidden.bs.modal", "#editModal", function() {
      app.clearForm();
    });
  }
};
</script>
