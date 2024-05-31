<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required',
            'price_import' => 'required|integer',
            'price_sell' => 'required|integer',
            'brand_id' => 'required|integer',
            'category_id' => 'required|integer',
            'description' => 'required',
            'img' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Vui lòng nhập tên sản phẩm",
            'price_import.required' => "Vui lòng nhập giá nhập của sản phẩm",
            'price_sell.required' => "Vui lòng nhập giá bán của sản phẩm",
            'brand_id.required' => "Vui lòng chọn thương hiệu của sản phẩm",
            'category.required' => "Vui lòng chọn danh mục của sản phẩm",
            'description.required' => "Vui lòng nhập mô tả cho sản phẩm",
            'img.required' => "Vui lòng thêm hình ảnh đại diện cho sản phẩm",
        ];

    }
}
