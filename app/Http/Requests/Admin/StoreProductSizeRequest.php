<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductSizeRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
            'product_color_id' => 'required|integer',
            'size_id' => 'required|integer',
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
            'quantity.required' => "Please enter the quantity", // Vui lòng nhập số lượng
            'product_color_id.required' => "Please select a color for the product", // Vui lòng chọn màu sắc cho sản phẩm
            'size_id.required' => "Please select a size for the product", // Vui lòng chọn kích thước cho sản phẩm

        ];
    }
}
