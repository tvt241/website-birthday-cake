<?php

namespace Modules\User\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "email" => "required|unique:users,email,$this->email,email",
            "phone" => "required|unique:users,phone,$this->phone,phone",
            "image" => "nullable|file|image",
            "password" => "nullable",
            "role_id" => "required|exists:roles,id",
            "is_active" => "nullable",
        ];
    }

    public function attributes()
    {
        return [
            "name" => "tên",
            "phone" => "số điện thoại",
            "image" => "ảnh",
            "role_id" => "mã quyền",
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
