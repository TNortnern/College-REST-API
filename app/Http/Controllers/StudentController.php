<?php

namespace App\Http\Controllers;
use App\User;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        
        return Student::latest()->get();
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $firstname = $request->FName;
        $lastname = $request->LName;
        $email = $request->Email;
        $student = new Student();
        $student->StudentFirstName = $firstname;
        $student->StudentLastName = $lastname;
        $student->StudentEmail = $email;
        $student->StudentPhoneNumber = $request->PNum;
        $student->HomeState = $request->Home;
        // $student->BirthDate = $request->Date;
        $student->Gender = $request->Gender;
        $student->save();
        // create a user
        User::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => Hash::make(12345678)
        ]);
        return $student;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->StudentFirstName = $request->FName;
        $student->StudentLastName = $request->LName;
        $student->StudentEmail = $request->Email;
        $student->StudentPhoneNumber = $request->PNum;
        $student->HomeState = $request->Home;
        // $student->BirthDate = $request->Date;
        $student->Gender = $request->Gender;
        $student->update();
        return $student;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return 204;
    }
}
