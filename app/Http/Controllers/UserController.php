<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getUserInfo(Request $request){
       
            $info = DB::table('students')->where('StudentID', $request->userid)->get();
    
          

        return $info;
       
    }

    public function getUserCourses(Request $request){
 

            $info = DB::table('instructors')
            ->join(DB::raw("(SELECT DISTINCT CourseID, StudentID, InstructorID From enrolleds WHERE StudentID = $request->userid) AS Enrolled"), "instructors.InstructorID", '=', "Enrolled.InstructorID")
            ->join('courses', 'Enrolled.CourseID', '=', 'courses.CourseID')
            ->join(DB::raw('(SELECT DISTINCT CourseID, Semestertaught, ClassTime FROM Class_Times) AS class_times'), 'courses.CourseID', '=', 'class_times.CourseID')
            ->get();
  

        return $info;
    }
    public function checklogin(){
       
        if(Auth::check()){
           $user = Auth::user();
           $email = Auth::user()->email;
           $userid = DB::table('students')->where('StudentEmail', $email)->value('StudentID');
            return response()->json($userid, 200);
        }else{
            return response()->json('false', 200);
        }
    }

    public function checkIfAdmin(){
        if(Auth::check()){

           $user = Auth::user();
           $check = $user->administrator == 1;
           if($check){
               $find = DB::table('instructors')
               ->where('InstructorEmail', $user->email)
               ->value('InstructorID');
            return response()->json($find, 200);
           }else{
               return response()->json('regular', 200);
           }
        }else{
            return response()->json('false', 200);
        }
    }
}
