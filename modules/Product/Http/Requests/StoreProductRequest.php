<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|max:100",
            "slug" => "|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:products,slug|max:100",
            "category_id" => "exists:product_categories,id",
            "desc_sort" => "nullable",
            "desc" => "nullable",
            "is_active" => "nullable|boolean",
            "image" => "nullable|file|image",
            "items" => "required",
            "items.*.price_import" => "required",
            "items.*.price" => "required",
            "items.*.quantity" => "required|numeric|min:1",
            "variations" => "nullable"
        ];
    }

    public function attributes()
    {
        return [
            "items.*.price_import" => "giá nhập",
            "items.*.price" => "giá bán",
            "items.*.quantity" => "số lương",
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
