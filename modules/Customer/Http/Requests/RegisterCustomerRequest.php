<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username" => "required|unique:customers,username",
            "password" => "required|min:6",
            "re-password" => "required|same:password",
        ];
    }

    public function messages()
    {
        return [
            "unique" => ":attribute đã được sử dụng"
        ];
    }

    public function attributes()
    {
        return [
            "password" => "mật khẩu",
            "re-password" => "mật khẩu nhập lại",
            "username" => "tên đăng nhập",
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
