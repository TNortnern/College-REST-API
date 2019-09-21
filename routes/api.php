<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth::routes();

Route::get('students/', 'StudentController@index');

 Route::get('students/', 'StudentController@index');

  Route::get('instructors/', 'InstructorController@index');

  Route::get('courses/', 'CourseController@index');

  Route::get('courses/search', 'CourseController@search');

  Route::get('programs/', 'ProgramController@index');

  Route::resource('students', 'StudentController', [
    'except' => 'index'
]);

Route::resource('instructors', 'InstructorController', [
    'except' => 'index'
]);

Route::resource('courses', 'CourseController', [
    'except' => 'index'
]);

Route::post("checklogin", 'UserController@checklogin');
Route::post('checkadmin', 'UserController@checkIfAdmin');

 Route::post('courses', 'CourseController@store');

 Route::post('getTaughtCourses', 'InstructorController@getTaughtCourses');
 Route::post('getStudentsInEachCourse', 'InstructorController@getStudentsInEachCourse');

Route::get('home', 'HomeController@index')->name('home');
Route::post('enroll', 'CourseController@enroll');
Route::post('checkenrolled', 'CourseController@checkEnrolled');
Route::post('dropcourse', 'CourseController@dropCourse');
Route::post('courses/search', 'CourseController@search');
Route::post('getcourse', 'CourseController@getCourse');
Route::post('searchByName', 'CourseController@searchByName');

Route::post('signup', 'Auth\RegisterController@make');
Route::post('signin', 'Auth\LoginController@signin');
Route::post('signout', 'Auth\LoginController@signout');
// Auth::routes();

Route::post('getuser', 'UserController@getUserInfo');
Route::post('getusercourses', 'UserController@getUserCourses');



