<?php

namespace App\Http\Controllers\Api\Traits;

trait ApiResponseTrait
{
    public function apiResponse($data = null , $message = null , $status = null ){

        $data = [
            'data' => $data ,
            'message' => $message ,
            'status' => $status
        ];

        return response($data , $status );
    }
}
