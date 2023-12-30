<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\EmailVerificationCode;
use App\Models\ForgotPasswordCode;
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
    
    public function forgotPassword($data){
        $email = $data->email;

        $user = User::where('email',$email)->first();

        if($user){
            $forgot_password_code = ForgotPasswordCode::create([
                "code" => "123456",
                "email" => $data->email,
                "expire_at" => Carbon::now()->addDays(7),
                "status" => true
            ]);

            if($forgot_password_code){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return true;
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

    public function verifyPasswordCode($data){
        $email = $data->email;
        $code = $data->code;
        $today = Carbon::now();

        $forgot_password = ForgotPasswordCode::where('email',$email)->where('code',$code)->where('status',true)->where('expire_at','>=',$today)->first();

        if($forgot_password != null){
            $forgot_password->update([
                'status' => false
            ]);

            User::where('email',$email)->update([
                'password' => Hash::make($data->new_password)
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

    public function logout(){
        $user = Auth::user();

        // Revoke the user's access token
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return true;
    }

    public function getProfile(){
        return Auth::user();
    }

    public function updateProfile($data){
        $name = $data->name;

        $user = Auth::user();
        $user = User::find($user->id);
        $user->name = $name;
        if($user->save()){
            return true;
        }
        else{
            return false;
        }
    }

    public function changePassword($data){
        $old_password = $data->old_password;
        $new_password = $data->new_password;

        $user = Auth::user();
        $user = User::find($user->id);

        if(Hash::check($old_password,$user->password)){
            $user->password = Hash::make($new_password);
            $user->save();
            return true;
        }
        else{
            return false;
        }
    }
}