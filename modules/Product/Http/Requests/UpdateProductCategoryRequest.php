<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|max:50",
            "slug" => "required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:product_categories,slug, $this->category|max:50",
            "category_id" => "nullable|exists:product_categories,id",
            "description" => "nullable",
            "image" => "nullable|file|image"
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
