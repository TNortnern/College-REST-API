<template>
  <div class="container">
  <h1 class="text-center">Courses</h1>
  <div v-if="admin == 'regular' || admin == 'false'">
  <profile ref="prof"/>
  </div>
    
    <div id="successmsg" class="alert alert-success display-none">{{ successmsg }}</div>
    <form @submit.prevent="searchByName" class="form-inline my-2 my-lg-0 d-flex justify-content-center">
      <input
        class="form-control mr-sm-2"
        type="search"
        placeholder="Search"
        aria-label="Search"
        v-model="searchterm"
      />
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button><br><a v-if="searched" style="font-size:1.2em" @click.prevent="fetchCourses" href="">Clear Search</a>
    </form>
    <form @submit.prevent="searchCourses" action class="d-flex justify-content-center flex-wrap">
      <label class="w-100 text-center" for="filter">Filter By:</label>
      <br />
      <select v-model="filter" name="filter">
        <option>Alphabetically</option>
        <option>Program</option>
        <option>Semester</option>
        <option>Credit Hours</option>
        <!-- <option>Instructors</option> -->
      </select>
      <select v-model="order">
        <option>ASC</option>
        <option>DESC</option>
      </select>
      <button class="btn btn-primary">Go</button>
    </form>
    <div id="courses">
      <div v-for="(course, key) in courses" :key="key">
        <div class="card text-center">
          <div
            class="card-header"
          >
          Course: {{ course.CourseName + '-' + course.CourseNumber }}({{course.CreditHours}} Credits)</div>
          <div class="text-center">
           <div v-if="!enrolleditems && admin == 'regular'" class="spinner-border text-primary" role="status">
										<span class="sr-only">Loading...</span>
									</div>
          </div>
          <div v-if="enrolleditems || admin != 'regular'" class="card-body">
         
            <h5
              class="card-title"
              v-if="course.InstructorFirstName != null"
            >Instructor: {{ course.InstructorFirstName + ' ' + course.InstructorLastName }}</h5>
            <h5 class="card-title" v-if="course.InstructorFirstName == null">Instructor: TBA</h5>
            <p>Program: {{ course.ProgramName }}</p>
            <p class="card-text">{{ course.Description }}</p>
            <p
              v-if="course.SemesterTaught != '' || course.SemesterTaught != 'Both' || course.SemesterTaught != 'Online'"
            >Offered in {{ course.SemesterTaught }} Semester</p>
            <button
              @click="enroll(course.CourseID, course.InstructorID)"
              v-if="admin == 'regular' && userid != 'false' && checker(course.CourseID, key) != true"
              href="#"
              class="btn btn-primary"
              id="enroll-button"
            >Enroll</button>
            <button 
            @click="dropCourse(course.CourseID, course.InstructorID)"
             v-if="userid != 'false' && checker(course.CourseID, key) == true"
             class="btn btn-primary">
             Drop</button>
             <button v-if="admin != 'false' && admin != 'regular'" class="btn btn-primary">Modify</button>
             <button v-if="admin != 'false' && admin != 'regular'" class="btn btn-secondary">Delete</button>
          </div>
          <div
            v-if="course.StudentsInClass == 0 || course.StudentsInClass > 1"
            class="card-footer text-muted"
          >{{ course.StudentsInClass }} students enrolled.</div>
          <div
            v-if="course.StudentsInClass == 1"
            class="card-footer text-muted"
          >{{ course.StudentsInClass }} student enrolled.</div>
        </div>
      </div>
    </div>
    <form v-if="admin != 'regular' && admin != 'false'" @submit.prevent="create" action>
      <h2>Create a Course</h2>
      <cinput
        label="Course Name"
        inputname="coursename"
        placeholder="Course Name"
        errorclass
        error
        inptype="text"
        v-model="course"
      ></cinput>
      <div class="form-group">
        <label for="program">Program</label>
        <select @change="getProgramID($event)" class="form-control" name="program" id>
          <option v-for="(program, key) in programs" :key="key">
            {{ program.ProgramName }} for {{ program.College }}
            ID:
            <p class="program-id">{{ program.ProgramID }}</p>
          </option>
        </select>
        <input v-model="program" hidden />
      </div>
      <cinput
        label="Program Code"
        inputname="code"
        placeholder="Program Code"
        errorclass
        error
        inptype="text"
        v-model="code"
      ></cinput>
      <cinput
        label="Course Number"
        inputname="number"
        placeholder="Course Number"
        errorclass
        error
        inptype="text"
        v-model="coursenum"
      ></cinput>
      <cinput
        label="Section"
        inputname="section"
        placeholder="Section"
        errorclass
        error
        inptype="text"
        v-model="section"
      ></cinput>
      <cinput
        label="Credit Hours"
        inputname="credithours"
        placeholder="Credit Hours"
        errorclass
        error
        inptype="text"
        v-model="credithours"
      ></cinput>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          v-model="description"
          placeholder="Description"
          class="form-control"
          name="description"
          id
          rows="3"
        ></textarea>
      </div>

      <div class="form-group">
        <label for="enrolled">Enroll This Course?</label>
        <select v-model="prompt" class="form-control" name="enrolled" id="enroll-prompt">
          <option>Yes</option>
          <option>No</option>
        </select>
      </div>

      <div v-if="prompt == 'Yes'" id="enroll">
        <div class="form-group">
          <label for="instructor">Instructor</label>
          <select @change="getInstructorID($event)" class="form-control" name="instructor" id>
            <option v-for="(instructor, key) in instructors" :key="key">
              {{ instructor.InstructorFirstName }} {{ instructor.InstructorLastName }}(Degree:{{ instructor.DegreeEarned }})
              ID:
              <p class="instructor-id">{{ instructor.InstructorID }}</p>
            </option>
          </select>
          <input v-model="instructor" hidden />
        </div>
        <div class="form-group">
          <label for="day1" v-if="day1 != 'Everyday' && day1 != 'Online'">Day 1</label>
          <label for="day1" v-if="day1 == 'Everyday' || day1 == 'Online'">Course Days</label>
          <select v-model="day1" class="form-control" name="day1" id="day1">
            <option>None</option>
            <option>Monday</option>
            <option>Tuesday</option>
            <option>Wednesday</option>
            <option>Thursday</option>
            <option>Friday</option>
            <option>Everyday</option>
            <option>Online</option>
          </select>
        </div>
        <div v-if="day1 != 'Everyday' && day1 != 'Online'" class="form-group">
          <label for="day2">Day 2</label>
          <select v-model="day2" class="form-control" name="day2" id="day2">
            <option>None</option>
            <option v-if="day1 != 'Everyday' && day1 != 'Online'">Monday</option>
            <option v-if="day1 != 'Everyday' && day1 != 'Online'">Tuesday</option>
            <option v-if="day1 != 'Everyday' && day1 != 'Online'">Wednesday</option>
            <option v-if="day1 != 'Everyday' && day1 != 'Online'">Thursday</option>
            <option v-if="day1 != 'Everyday' && day1 != 'Online'">Friday</option>
          </select>
        </div>
        <cinput
          label="Start Date"
          inputname="startdate"
          placeholder="Start Date"
          errorclass
          error
          inptype="date"
          v-model="start"
        ></cinput>
        <cinput
          label="End Date"
          inputname="enddate"
          placeholder="End Date"
          errorclass
          error
          inptype="date"
          v-model="end"
        ></cinput>
        <cinput
          label="Class Time"
          inputname="time"
          placeholder="Class Time"
          errorclass
          error
          inptype="time"
          v-model="classtime"
        ></cinput>
        <div class="form-group">
          <label for="semester">Semester</label>
          <select v-model="semester" class="form-control" name="semester" id="semester">
            <option>Fall</option>
            <option>Spring</option>
            <option>Both</option>
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>
</template>
<script>
import cinput from "./Input.vue";
import $ from "jquery";
import profile from './MyProfile.vue';
import { setInterval } from "timers";



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
      courses: [],
      instructors: [],
      programs: [],
      enrolleditems: "",
      instructor: "",
      program: "",
      course: "",
      code: "",
      coursenum: "",
      section: "",
      description: "",
      credithours: "",
      prompt: "Yes",
      day1: "Monday",
      day2: "None",
      start: "",
      end: "",
      classtime: "",
      semester: "",
      userid: "false",
      successmsg: "",
      admin: "",
      searchterm: "",
      order: "ASC",
      filter: "Alphabetically",
      action: false,
      searched: false
    };
  },
  methods: {
    searchByName(){
      this.searched = true;
      $("#page-loader").show();
      axios.post('searchByName', {
        searchterm: this.searchterm
      })
      .then(res => {
        $("#page-loader").hide();
         $("#courses")
            .fadeOut("fast")
            .delay(100)
            .fadeIn("fast");
        this.courses = res.data;
      })
      .catch(err => {
        this.searched = false;
        console.log(err);
      })
    },
    searchCourses(filter) {
      switch (this.filter) {
        case "Alphabetically":
          filter = "courses.CourseName";
          break;

        case "Program":
          filter = "ProgramName";
          break;
        case "Semester":
          filter = "SemesterTaught";
          break;
        case "Credit Hours":
          filter = "CreditHours";
          break;
        // case "Instructors":
        //   filter = "instructors.InstructorFirstName";
        //   break;

        default:
          filter = "courses.CourseName";
          break;
      }
      axios
        .post("courses/search", {
          searchterm: this.searchterm,
          filter: filter,
          order: this.order
        })
        .then(res => {
          $("#courses")
            .fadeOut("fast")
            .delay(100)
            .fadeIn("fast");
          this.courses = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    isLoggedIn() {
      axios
        .post("/checklogin/")
        .then(res => {
          this.userid = res.data;
          if(this.admin == "false" || this.admin == "regular"){
          this.checkIfEnrolled();
          }
        })
        .catch(err => {
          console.log(err);
        });
    },
    checkIfAdmin() {
      axios
        .post("/checkadmin/")
        .then(res => {
          this.admin = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    checker(id) {
       if(this.admin == "false" || this.admin == "regular"){
      for (let i = 0; i < this.enrolleditems.length; i++) {
        if (id == this.enrolleditems[i].CourseID) {
          return true;
        }
      }
       }
    },
    enroll(courseid, instructorid) {
      $("#page-loader").show();
      axios
        .post("/enroll/", {
          courseid: courseid,
          instructorid: instructorid,
          userid: this.userid
        })
        .then(res => {
         
          this.successmsg = "Succesfully Enrolled!";
          $("#successmsg")
            .fadeIn()
            .delay(4000)
            .fadeOut();
          this.$refs.prof.courses.push(res.data);
          this.courses = "";
          this.fetchCourses();
           $("#studentModal").modal("show");
          
        })
        .catch(err => {
          console.log(err);
          $("#page-loader").hide();
        });
    },
    dropCourse(courseid, instructorid) {
      $("#page-loader").show();
      axios
        .post("/dropcourse", {
          courseid: courseid,
          instructorid: instructorid,
          userid: this.userid
        })
        .then(res => {
          this.courses = "";
          this.fetchCourses();
           $("#studentModal").modal("show");
        })
        .catch(err => {
          alert("the request failed!");
          $("#page-loader").hide();
        });
    },
    checkIfEnrolled() {
      axios
        .post("/checkenrolled", {
          userid: this.userid
        })
        .then(res => {
          if(this.admin == "false" || this.admin == "regular"){
          this.enrolleditems = res.data;
          }
        })
        .catch(err => {
          console.log(err);
        });
    },
    clearForm() {
      this.instructor = "";
      this.program = "";
      this.course = "";
      this.code = "";
      this.coursenum = "";
      this.section = "";
      this.description = "";
      this.credithours = "";
      this.day1 = "Monday";
      this.day2 = "None";
      this.start = "";
      this.end = "";
      this.classtime = "";
      this.semester = "";
    },
    // these functions handles creation of the id's to create courses
    getInstructorID(e) {
      let temp = e.target.value;
      let instructor = temp[temp.length - 1];
      this.instructor = instructor;
    },
    getProgramID(e) {
      let temp = e.target.value;
      let program = temp[temp.length - 1];
      this.program = program;
    },
    fetchCourses() {
      this.searched = false;
      this.searchterm = "";
      $("#page-loader").show();
      let app = this;
     
        axios
          .get("/api/courses/")
          .then(res => {
            // call child usercourses
             if(this.admin == "false" || this.admin == "regular"){
            this.$refs.prof.fetchUserCourses();
             app.checkIfEnrolled();
             }
             app.courses = res.data;
            $("#page-loader").hide();
          })
          .catch(err => {
            console.log(err);
            $("#page-loader").hide();
          });

    },

    fetchInstructors() {
      let app = this;
      axios
        .get("/api/instructors")
        .then(res => {
          this.instructors = res.data;
          $(".instructor-id").ready(function() {
            app.instructor = $(".instructor-id").html();
          });
        })
        .catch(err => {
          console.log(err);
        });
    },
    fetchPrograms() {
      let app = this;
      axios
        .get("/api/programs")
        .then(res => {
          this.programs = res.data;
          $(".program-id").ready(function() {
            app.program = $(".program-id").html();
          });
        })
        .catch(err => {
          console.log(err);
        });
    },
    create() {
      $("#page-loader").show();
      axios
        .post("/courses/", {
          instructor: this.instructor,
          program: this.program,
          course: this.course,
          code: this.code,
          coursenum: this.coursenum,
          section: this.section,
          description: this.description,
          credithours: this.credithours,
          prompt: this.prompt,
          day1: this.day1,
          day2: this.day2,
          start: this.start,
          end: this.end,
          classtime: this.classtime,
          semester: this.semester
        })
        .then(res => {
          $("#page-loader").hide();

          this.courses.unshift(res.data);
          this.clearForm();
        })
        .catch(err => {
          console.log(err);
        });
    }
  },

  components: {
    cinput, profile
  },

  mounted() {
    this.isLoggedIn();
    this.checkIfAdmin();
    this.fetchCourses();
    this.fetchInstructors();
    this.fetchPrograms();
  }
};
</script>

<style>
.display-none {
  visibility: hidden;
}
</style>