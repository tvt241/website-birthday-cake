<?php

namespace Modules\Coupon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Coupon\Enums\CouponDiscountTypeEnum;

class UseCouponRequest extends FormRequest
{
    public function rules()
    {
        return [
            "amount" => "required",
            "code" => "required",
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
