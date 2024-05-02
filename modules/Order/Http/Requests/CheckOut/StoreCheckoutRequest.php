<?php

namespace Modules\Order\Http\Requests\CheckOut;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "phone" => "required|numeric",
            "email" => "nullable",
            "province_name" => "required",
            "district_name" => "required",
            "ward_name" => "required",
            "address2" => "required",
            "note" => "nullable",
            "coupon_code" => "nullable",
            "method_payment" => "required"
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
