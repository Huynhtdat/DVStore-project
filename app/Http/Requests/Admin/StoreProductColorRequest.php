<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductColorRequest extends FormRequest
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
            'color_id' => 'required|integer',
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
            'color_id.required' => 'Please select a product color', // Vui lòng chọn màu sản phẩm
            'product_id.required' => 'Please provide complete information', // Vui lòng điền đầy đủ thông tin
            'color_id.integer' => 'Invalid color', // Màu không hợp lệ
        ];
    }
}
