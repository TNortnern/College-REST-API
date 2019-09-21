<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(Request $data)
    // {
    //     $data->validate([
    //         'firstname' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:2', 'confirmed'],
    //     ]);
    // }

    //  protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'firstname' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:2', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
    // $user = User::create([
    //         'firstname' => $data['firstname'],
    //         'lastname' => $data['lastname'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    //    $student = Student::create([
    //         'StudentFirstName' => $data['firstname'],
    //         'StudentLastName' => $data['firstname'],
    //         'StudentEmail' => $data['firstname'],
    //     ]);

    //     return $user;
    // }

    // public function create(Request $data)
    // {
    // $user = User::create([
    //         'firstname' => $data->firstname,
    //         'lastname' => $data->lastname,
    //         'email' => $data->email,
    //         'password' => Hash::make($data->password),
    //     ]);
    //    $student = Student::create([
    //         'StudentFirstName' => $data->firstname,
    //         'StudentLastName' => $data->lastname,
    //         'StudentEmail' => $data->email,
    //     ]);

    //     return $user;
    // }

    public function make(Request $data)
    {
        $data->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phonenumber' => 'required',
            'email' => 'email',
            'password' => 'min: 2',
            'confirm' => 'min:2 | same:password'
        ]);
    $user = User::create([
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
       $student = Student::create([
            'StudentFirstName' => $data->firstname,
            'StudentLastName' => $data->lastname,
            'StudentEmail' => $data->email,
            'StudentPhoneNumber' => $data->phonenumber
        ]);

        Auth::login($user);

        return $user;
    }
}
