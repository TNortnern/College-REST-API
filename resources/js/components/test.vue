<template>
  <div>
    <div class="alert-alert-success display-none" id="successmsg"></div>
    <div v-for="(course, key) in courses" :key="key">
      <div class="card text-center">
        <div class="card-header">{{ course.CourseName + '-' + course.CourseNumber }}</div>
        <div class="card-body">
          <h5
            class="card-title"
            v-if="course.InstructorFirstName != null"
          >Instructor: {{ course.InstructorFirstName + ' ' + course.InstructorLastName }}</h5>
          <h5 class="card-title" v-if="course.InstructorFirstName == null">Instructor: TBA</h5>
          <p class="card-text">{{ course.Description }}</p>
          <button v-if="course.CourseID != 14" href="#" class="btn btn-primary">Assign a instructor</button>
          <button
            @click="enroll(course.CourseID, course.InstructorID)"
            v-if="userid != 'false'"
            href="#"
            class="btn btn-primary"
          >Enroll</button>
          <button href="#" class="btn btn-primary">More Details</button>
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
    </div>hellowoeld
  </div>
</template>


<script>
export default {
  data() {
    return {
      courses: "",
      userid: "",
      successmsg: "",
      checker: ""
    };
  },
  methods: {
    enroll(courseid, instructorid) {
      axios
        .post("/enroll/", {
          courseid: courseid,
          instructorid: instructorid,
          userid: this.userid
        })
        .then(res => {
          console.log(res.data);
          this.successmsg = "Succesfully Enrolled!";
          $("#successmsg")
            .fadeIn()
            .delay(4000)
            .fadeOut();
          this.courses = "";
          this.fetchCourses();
        })
        .catch(err => {
          alert(err);
        });
    },
    isLoggedIn() {
      axios
        .post("/checklogin/")
        .then(res => {
          console.log(res.data);
          this.userid = res.data;
        })
        .catch(err => {
          alert(err);
        });
    },
    checkIfEnrolled(courseid, instructorid) {
      axios
        .post("/checkenrolled", {
          courseid: courseid,
          instructorid: instructorid,
          userid: 5
        })
        .then(res => {
          console.log(res.data);
        })
        .catch(err => {
          console.log(err);
        });
    },
    fetchCourses() {
      axios
        .get("/api/courses/")
        .then(res => {
          console.log(res.data);
          this.courses = res.data;
        })
        .catch(err => {
          alert(err);
        });
    }
  }
};
</script>


<style>
.display-none {
  display: none;
}
</style>