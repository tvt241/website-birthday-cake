<?php

namespace Modules\Order\Http\Requests\CheckOut;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Order\Enums\OrderTypeEnum;

class StoreOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $orderTypeBooking = OrderTypeEnum::BOOKING->value;
        return [
            "user_id" => "required_if:order_type, $orderTypeBooking",
            "order_type" => "required",
            "coupon_code" => "nullable",
            "payment_method" => "required",
            "products" => "required",
            "address2" => "required_if:order_type, $orderTypeBooking",
            "note" => "nullable",
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
