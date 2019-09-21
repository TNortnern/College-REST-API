<template>
  <div>
    <div>
      <div id="new-instructor" class="alert alert-success">{{ newinstructor }} is now an instructor.</div>
      <h2>List of Instructors</h2>
      <div v-for="(instructor,key) in instructors" :key="key">
        <h4>{{key + ". " + instructor.InstructorFirstName }} {{ instructor.InstructorLastName }} Email: {{instructor.InstructorEmail}} </h4>
      </div>
    </div>
    <form @submit.prevent="create">
      <h2>Create An Instructor</h2>
      <cinput
        inptype="text"
        v-model="firstname"
        inputname="firstname"
        label="First Name"
        placeholder="Enter Instructor's First Name"
      ></cinput>
      <cinput
        inptype="text"
        v-model="lastname"
        inputname="lastname"
        label="Last Name"
        placeholder="Enter Instructor's Last Name"
      ></cinput>
      <cinput
        inptype="email"
        v-model="email"
        inputname="email"
        label="E-mail"
        placeholder="Enter Instructor's E-mail"
      ></cinput>
      <cinput
        inptype="tel"
        v-model="pnum"
        inputname="pnum"
        label="Phone Number"
        placeholder="Enter Instructor's Phone Number"
      ></cinput>
      <cinput
        inptype="text"
        v-model="earned"
        inputname="earned"
        label="Degree Earned"
        placeholder="Enter Instructor's Degree School"
        errorclass="earned-error"
      ></cinput>
      <cinput
        inptype="text"
        v-model="school"
        inputname="school"
        label="Degree School"
        placeholder="Enter Instructor's Degree School"
      ></cinput>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          v-model="description"
          name="description"
          placeholder="Describe This Instructor"
          class="form-control"
          id="desc"
          rows="3"
        ></textarea>
      </div>
      <div class="form-group">
        <label for="admin">Admin Instructor?</label>
        <select v-model="admin" class="form-control" name="admin" id="admin">
          <option selected="selected">0</option>
          <option>1</option>
        </select>
      </div>
      <br />
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>
</template>


<script>
import cinput from "./Input.vue";
import $ from "jquery";
export default {
  // custom input
  components: { cinput },
  data() {
    return {
      instructors: [],
      firstname: "",
      lastname: "",
      email: "",
      pnum: "",
      earned: "",
      school: "",
      newinstructor: "",
      description: "",
      admin: 0
    };
  },
  methods: {
    fetchInstructors() {
      axios
        .get("/api/instructors")
        .then(res => {
          this.instructors = res.data;
          $("#page-loader").hide();
        })
        .catch(err => {
          alert(err);
        });
    },
    create() {
      $("#page-loader").show();
      this.newinstructor = this.firstname + " " + this.lastname;
      axios
        .post("/instructors/", {
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          pnum: this.pnum,
          earned: this.earned,
          school: this.school,
          description: this.description,
          admin: this.admin
        })
        .then(res => {
          this.instructors.unshift(res.data);
          //set variable for component so jquery can access it
          let app = this;
          console.log(res);
          $("#new-instructor")
            .fadeIn(function() {
              app.firstname = "";
              app.lastname = "";
              app.email = "";
              app.pnum = "";
              app.earned = "";
              app.school = "";
              app.description = "";
              app.admin = 0;
            })
            .delay(3000)
            .fadeOut();

          $("#page-loader").hide();
        })
        .catch(err => {
          $("#page-loader").hide();
        });
    }
  },
  created() {
    this.fetchInstructors();
  }
};
</script>

<style>
#new-instructor {
  display: none;
}
</style>