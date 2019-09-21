<template>
    
<div class="console">
	<div class="h-100 w-100 align-loader-center">
		<div id="main-spinner" v-if="courses.length == 0 && !nocourses" style="position:absolute;top:50%" class="spinner-border text-info" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	<instructorNavbar></instructorNavbar>
	<div class="console-background">
		<div class="container text-center" style="padding:11%">
			<h1>Courses you teach</h1>
			<h2 v-if="nocourses" style="color:black;font-weight:bold">You don't teach any courses</h2>
			<div>
				<div class="accordion" id="accordion">
					<div v-for="(course,key) in courses" :key=key class="card">
						<div class="card-header" id="headingOne">
							<h2 class="mb-0">
								<button @click="getStudentsInEachCourse(course.CourseID)" class="btn btn-link" type="button" data-toggle="collapse" :data-target="'#' + course.CourseName" aria-expanded="true" :aria-controls="course.CourseName">
            {{ course.CourseName }}-{{ course.ProgramCode }}-{{ course.Section }}
            </button>
							</h2>
						</div>
						<div :id="course.CourseName" class="collapse" :aria-labelledby="'heading' + key " data-parent="#accordion">
							<div class="card-body">
								<h4>Students Enrolled</h4>
								<p class="students" v-for="(student, key) in students">
                {{ student.StudentFirstName }} {{ student.StudentLastName }}

                
									<div v-if="!students" class="spinner-border text-primary" role="status">
										<span class="sr-only">Loading...</span>
									</div>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
    import './../../sass/console.scss';
    import instructorNavbar from './InstructorNavbar';
    import $ from 'jquery';

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
        data(){
            return{
                instructorid: '',
                courses: [],
                courseid: '',
                students: [],
                nocourses: '',
                userid: window.sessionStorage.userId,
            }
        },
        components: {
            instructorNavbar,
        },
        methods:{
            getID(){
                axios.post('checkadmin')
                .then(res => {
                    this.instructorid = res.data;
                    this.getTaughtCourses();
                }).catch(err => {
                    console.log(err)
                })
            },
            getTaughtCourses(){
                axios
                .post('getTaughtCourses', 
                {
                    instructorid:this.instructorid
                }).then(res => {
                    
                    if(res.data.length){
                    this.courses = res.data;
                    }
                    else{
                      this.nocourses = 'none'
                    }
                }).catch(err => {
                    console.log(err)
                })
            },

            getStudentsInEachCourse(courseid){
                this.students = "";
                axios.post('getStudentsInEachCourse',
                {
                    courseid: courseid
                })
                .then(res => {
                    this.students = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
            }
        },
        mounted() {
            console.log($("meta[name=login-status]").attr("content"));
            this.getID();
        }
    }
</script>


<style>
.h-100{
    height:100%
}

.align-loader-center{
    display:flex;
    justify-content:center;
    align-items:center
}
@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

.students{
     -webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 2s; /* Firefox < 16 */
        -ms-animation: fadein 2s; /* Internet Explorer */
         -o-animation: fadein 2s; /* Opera < 12.1 */
            animation: fadein 2s;
}
</style>