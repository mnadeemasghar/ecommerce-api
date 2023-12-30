<?php
namespace App\Traits;

trait ApiResponse{
    public function success_respoonse($data,$message){
        return response([
            "status" => "true",
            "data" => $data,
            "message" => $message
        ],200);
    }
    public function error_respoonse($data,$message){
        return response([
            "status" => "false",
            "data" => $data,
            "message" => $message
        ],200);
    }
}