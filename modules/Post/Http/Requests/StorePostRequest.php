<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "slug" => "|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:posts,slug|max:100",
            "category_id" => "required|exists:post_categories,id",
            "desc_sort" => "nullable",
            "desc" => "nullable",
            "is_active" => "nullable|boolean",
            "image" => "nullable|file|image",
        ];
    }

    public function attributes()
    {
        return [
            "category_id" => "Danh mục bài viết",
            "image" => "Hình ảnh"
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
