<?php

namespace Modules\Coupon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Coupon\Enums\CouponDiscountTypeEnum;

class StoreCouponRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        // "Y-m-d\TH:i:s";
        if(!isset($this->date_start)){
            $dateStart = now()->format("Y-m-d\TH:i:s");
            $this->merge([
                "date_start" => $dateStart
            ]);
        }
    }

    public function rules()
    {
        return [
            "name" => "required",
            "code" => "required",
            "discount_type" => "required",
            "discount_value" => "required",
            "discount_max" => "required_if:discount_type,{CouponDiscountTypeEnum::PERCENT}|numeric|min:1000",
            "budget" => "nullable|numeric",
            "is_active" => "required",
            "date_start" => "required|date|after_or_equal:now",
            "date_end" => "required|date|after:date_start",
            "quantity" => "required|numeric",
            "limit_per_user" => "nullable|numeric",
            "desc" => "nullable"
        ];
    }

    public function attributes()
    {
        return [
            "code" => "mã",
            "discount_type" => "kiểu giảm giá",
            "discount_value" => "giá trị giảm giá",
            "discount_max" => "giá trị tối đa",
            "budget" => "ngân sách",
            "date_start" => "ngày bắt đầu",
            "date_end" => "ngày kết thúc",
            "quantity" => "số lượng",
            "limit_per_user" => "giới hạn số lần người dùng sử dụng"
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
