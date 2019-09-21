<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{vue_capture?}', function() {
   return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');

Route::resource('students', 'StudentController', [
    'except' => 'index'
]);

Route::resource('instructors', 'InstructorController', [
    'except' => 'index'
]);

Route::resource('courses', 'CourseController', [
    'except' => 'index'
]);

Route::post("/checklogin", 'UserController@checklogin');
Route::post('checkadmin', 'UserController@checkIfAdmin');

 Route::post('courses/', 'CourseController@store');

 Route::post('getTaughtCourses', 'InstructorController@getTaughtCourses');
 Route::post('getStudentsInEachCourse', 'InstructorController@getStudentsInEachCourse');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('enroll', 'CourseController@enroll');
Route::post('checkenrolled', 'CourseController@checkEnrolled');
Route::post('dropcourse', 'CourseController@dropCourse');
Route::post('courses/search', 'CourseController@search');
Route::post('getcourse', 'CourseController@getCourse');
Route::post('searchByName', 'CourseController@searchByName');

Route::post('/register', 'Auth\RegisterController@make');
Route::post('/signin', 'Auth\LoginController@signin');
Route::post('/signout', 'Auth\LoginController@signout');
// Auth::routes();

Route::post('/getuser', 'UserController@getUserInfo');
Route::post('/getusercourses', 'UserController@getUserCourses');
