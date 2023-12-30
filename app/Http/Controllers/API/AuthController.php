<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\RegisterRequest;
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
}
