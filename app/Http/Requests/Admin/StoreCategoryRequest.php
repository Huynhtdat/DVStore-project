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
            'name.required' => "Vui lòng nhập tên danh mục",
            'name.max' => "Tên danh mục có tối đa 100 ký tự",
            'name.min' => "Tên danh mục có tối thiểu 1 ký tự",
        ];
    }
}
