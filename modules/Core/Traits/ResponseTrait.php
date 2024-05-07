<?php

namespace Modules\Core\Traits;

trait ResponseTrait
{
    public function SuccessResponse($data = [], $message = "success", $status_code = 200){
        return response([
            "status_code" => $status_code,
            "data" => $data,
            "message" => __($message)
        ], $status_code);
    }

    public function ErrorResponse($message = "error", $status_code = 400, $data = [], $is_reload = false){
        return response([
            "status_code" => $status_code,
            "data" => $data,
            "message" => __($message),
            "is_reload" => $is_reload
        ], $status_code);
    }
}
