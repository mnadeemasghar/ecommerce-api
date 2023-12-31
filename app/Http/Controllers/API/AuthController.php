<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ChangePasswordRequest;
use App\Http\Requests\API\ForgotPasswordRequest;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Requests\API\UpdateProfileRequest;
use App\Http\Requests\API\VerifyEmailRequest;
use App\Http\Requests\API\VerifyPasswordCodeRequest;
use App\Repositories\UserRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use stdClass;

class AuthController extends Controller
{
    use ApiResponse;

    private $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }
    
    public function register(RegisterRequest $request){
        $user = $this->userRepository->registerNewUser($request);
        if($user){
            return $this->success_respoonse(new stdClass,"Register successful please check your email to verify!"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Something went wrong, please try again!");
        }
    }
    
    public function forgotPassword(ForgotPasswordRequest $request){
        $user = $this->userRepository->forgotPassword($request);
        if($user){
            return $this->success_respoonse(new stdClass,"OTP sent, check your email to verify!"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Something went wrong, please try again!");
        }
    }
    
    public function verify_email(VerifyEmailRequest $request){
        $result = $this->userRepository->verifyEmail($request);
        if($result){
            return $this->success_respoonse(new stdClass,"Email Verified"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Please try again!");
        }
    }
    
    public function verifyPasswordCode(VerifyPasswordCodeRequest $request){
        $result = $this->userRepository->verifyPasswordCode($request);
        if($result){
            return $this->success_respoonse(new stdClass,"Password changed!"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Please try again!");
        }
    }
    
    public function login(LoginRequest $request){
        $result = $this->userRepository->login($request);
        if($result){
            return $this->success_respoonse($result,"Login Successfull"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Please try again!");
        }
    }
    
    public function logout(){
        $result = $this->userRepository->logout();
        if($result){
            return $this->success_respoonse(new stdClass,"Logout Successfull"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Please try again!");
        }
    }
    
    public function getProfile(){
        $result = $this->userRepository->getProfile();
        if($result){
            return $this->success_respoonse($result,"User Profile"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Please try again!");
        }
    }
    
    public function updateProfile(UpdateProfileRequest $request){
        $result = $this->userRepository->updateProfile($request);
        if($result){
            return $this->success_respoonse($result,"User Profile Updated"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Please try again!");
        }
    }
    
    public function changePassword(ChangePasswordRequest $request){
        $result = $this->userRepository->changePassword($request);
        if($result){
            return $this->success_respoonse($result,"Password Updated"); 
        }
        else{
            return $this->error_respoonse(new stdClass, "Please try again!");
        }
    }
}
