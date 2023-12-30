<?php
namespace App\Repositories;

interface UserRepositoryInterface{
    public function registerNewUser($data);
    public function verifyEmail($data);
}