<?php

namespace Modules\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Order\Enums\OrderTypeEnum;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // "user_id" => "nullable|exists:customers,id",
            // "status" => "required",
            // "payment_method" => "required",
            // "payment_status" => "required",
            
            "name" => "required",
            "phone" => "required",
            "email" => "nullable",
            "address" => "required",
            "address2" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "address2" => "địa chỉ cụ thể"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
