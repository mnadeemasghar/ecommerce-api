<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\EmailVerificationCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository implements UserRepositoryInterface{
    public function registerNewUser($data){
        $user = User::create([
            "name" => $data->name,
            "email" => $data->email,
            "password" => Hash::make($data->password),
        ]);

        EmailVerificationCode::create([
            "code" => "123456",
            "email" => $data->email,
            "expire_at" => Carbon::now()->addDays(7),
            "status" => true
        ]);

        if($user){
            return true;
        }
        else{
            return false;
        }
    }

    public function verifyEmail($data){
        $email = $data->email;
        $code = $data->code;
        $today = Carbon::now();

        $email_verified = EmailVerificationCode::where('email',$email)->where('code',$code)->where('status',true)->where('expire_at','>=',$today)->first();

        if($email_verified != null){
            $email_verified->update([
                'status' => false
            ]);

            User::where('email',$email)->update([
                'email_verified_at' => Carbon::now()
            ]);

            return true;
        }
        else{
            return false;
        }
    }

    public function login($data){
        
        if(Auth::attempt(['email' => $data->email, 'password' => $data->password])){
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return ["user" => $user, "token" => $token];
        }
        else{
            return false;
        }
    }
}