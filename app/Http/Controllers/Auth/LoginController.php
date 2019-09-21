<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        // $this->middleware('guest')->except('logout');
    }

    public function typeOfUser($email){
        $student = DB::table('students')
                    ->where('StudentEmail', '=', $email)->first();
        $instructor = DB::table('instructors')
                    ->where('InstructorEmail', '=', $email)->first();
        if($student){
            return "s";
        }else{
            return "i";
        }

    }
    public function signin(Request $request){
        $request->validate([
            'email' => 'email | required',
            'password' => 'min: 2'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        $check = $this->typeOfUser($request->email);
        if($user){
             $data = Hash::check($request->password, $user->password);
        $userid = $user->id;
        if($data == true){
            Auth::login($user);
            // Session::flash('message', 'Logged in as'); 
            return response()->json($check . ' ' . $userid, 200); 
           
        }else{
           return response()->json($data, 200);
        }
        }
       

    }

    

    public function signout(){
        Auth::logout();
        return redirect('/');
    }

    
}
