<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    public function login()
    {
       // dd(Hash::make(123456));

       if(!empty(Auth::check()))
       {
            if(Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
       }

       return view('auth.login');
    }

    public function Authlogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
            
        }
        else {
            return redirect()->back()->with('error', 'Wrong Credentials');
        }
         
    }

    public function forgotpassword()
    {
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if(!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Please check your email and reset your password");

        } else {
            return redirect()->back()->with('error', "Email not forund in the system");
        }
    }

   /* public function reset($token) {
        dd($token);
    } */

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
