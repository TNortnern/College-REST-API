<?php

namespace App\Http\Controllers;

use App\User;
use App\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return Instructor::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $admin = $request->admin;
        $instructor = Instructor::create([
            'InstructorFirstName' => $firstname,
            'InstructorLastName' => $lastname,
            'InstructorEmail' => $email,
            'InstructorPhone' => $request->pnum,
            'DegreeEarned' => $request->earned,
            'DegreeSchool' => $request->school,
            'Description' => $request->description,
            'Admin' => $admin
        ]);

        User::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => Hash::make(12345678),
            'student' => 0,
            'instructor' => 1,
            'administrator' => $admin
        ]);
        
        return $instructor;
    }

    public function getTaughtCourses(Request $request){
        $courses = DB::table('class_times')
        ->select('CourseName', 'InstructorFirstName', 'InstructorLastName', 'Section', 'ProgramCode', 'courses.CourseID', 'instructors.InstructorID', 'SemesterTaught', 'ClassTime', 'CreditHours', 'Program')
        ->from(DB::raw('(SELECT DISTINCT CourseID, ClassTime, SemesterTaught FROM class_times) AS class_times'))
        ->join('courses', 'class_times.CourseID', '=', 'courses.CourseID')
        ->join('instructors', 'courses.InstructorID', '=', 'instructors.InstructorID')
        ->join(DB::raw('(SELECT DISTINCT InstructorID FROM enrolleds) AS enrolleds'), 'instructors.InstructorID', '=', 'enrolleds.InstructorID')
        ->where('instructors.InstructorID', '=', $request->instructorid) // change
        ->get();
        
        return $courses;
        }

    public function getStudentsInEachCourse(Request $request){
        $students = DB::table('students')
        ->select('CourseID', 'StudentFirstName', 'StudentLastName', 'GPA')
        ->join('enrolleds',  'students.StudentID', '=', 'enrolleds.StudentID')
        ->where('CourseID', '=', $request->courseid)->distinct()->get();  // change   

        return $students;
        }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        //
    }
}
