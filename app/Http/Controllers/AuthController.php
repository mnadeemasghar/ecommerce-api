<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function login_attempt(Request $request){
        if(Auth::attempt(['email' => $request->email, "password" => $request->password])){
            $user = User::where('email',$request->email)->first();
            Auth::login($user);
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('error',"Login attempt fail!");
        }
    }

    public function logout(){
        if(Auth::logout()){
            return redirect()->back()->with('success',"Logout Successful!");
            
        }
        else{
            return redirect()->back()->with('error',"Somthing went wrong");
        }
    }
}
