<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username" => "nullable|unique:customers,username",
            "email" => "nullable",
            "phone" => "nullable",
            "gender" => "nullable",
            "birthday" => "nullable",
            "password" => "nullable",
            "image" => "nullable|file|image",
            "is_active" => "nullable"
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
