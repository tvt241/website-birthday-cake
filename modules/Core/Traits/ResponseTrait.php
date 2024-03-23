<?php

namespace Modules\Core\Traits;

trait ResponseTrait
{
    public function SuccessResponse($data = [], $message = "Thành công", $status_code = 200){
        return response([
            "data" => $data,
            "message" => $message
        ], $status_code);
    }

    public function ErrorResponse($data = [], $message = "Thất bại", $status_code = 400){
        return response([
            "data" => $data,
            "message" => $message
        ], $status_code);
    }
}
