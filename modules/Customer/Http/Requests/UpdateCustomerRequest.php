<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $time = now()->addYears(- 15);
        $customer_id = auth()->id();
        return [
            "username" => "required|unique:customers,username, $customer_id",
            "email" => "nullable",
            "phone" => "nullable",
            "name" => "nullable",
            "gender" => "nullable",
            "birthday" => "nullable|before:$time",
            "password" => "nullable",
            "image" => "nullable|file|image",
            "is_active" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            "birthday.before" => "Bạn chưa đủ 15 tuổi ?"
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
