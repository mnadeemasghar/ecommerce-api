<?php
namespace App\Repositories;

interface UserRepositoryInterface{
    public function registerNewUser($data);
    public function forgotPassword($data);
    public function verifyEmail($data);
    public function verifyPasswordCode($data);
    public function login($data);
    public function logout();
    public function getProfile();
    public function updateProfile($data);
    public function changePassword($data);
}