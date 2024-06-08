<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => "Please enter the brand name", // Vui lòng nhập tên thương hiệu
            'name.max' => "The brand name can have a maximum of 100 characters", // Tên thương hiệu có tối đa 100 ký tự
            'name.min' => "The brand name must have at least 1 character", // Tên thương hiệu ít nhất có 1 ký tự
        ];
    }
}
