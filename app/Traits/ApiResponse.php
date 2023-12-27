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
}