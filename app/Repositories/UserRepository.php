<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository implements UserRepositoryInterface{
    public function registerNewUser($data){
        $user = User::create([
            "name" => $data->name,
            "email" => $data->email,
            "password" => Hash::make($data->password),
        ]);

        if($user){
            return true;
        }
        else{
            return false;
        }
    }
}