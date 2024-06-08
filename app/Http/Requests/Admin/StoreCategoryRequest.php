<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:100',
            'parent_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Please enter the category name", // Vui lòng nhập tên danh mục
            'name.max' => "The category name can have a maximum of 100 characters", // Tên danh mục có tối đa 100 ký tự
            'name.min' => "The category name must have at least 1 character", // Tên danh mục ít nhất có 1 ký tự

        ];
    }
}
