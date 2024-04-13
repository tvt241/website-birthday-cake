<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostCategoryRequest extends FormRequest
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
            "slug" => [
                "required",
                "regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
                "max:50",
                // Rule::unique("post_categories", "slug")->ignore($this->category),
                "unique:post_categories,slug," . $this->category
            ],
            "description" => "nullable",
            "is_active" => "nullable|boolean"
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
