<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            // 'img' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Please enter the product name", // Vui lòng nhập tên sản phẩm
            'price_import.required' => "Please enter the import price of the product", // Vui lòng nhập giá nhập của sản phẩm
            'price_sell.required' => "Please enter the selling price of the product", // Vui lòng nhập giá bán của sản phẩm
            'brand_id.required' => "Please select the brand of the product", // Vui lòng chọn thương hiệu của sản phẩm
            'category.required' => "Please select the category of the product", // Vui lòng chọn danh mục của sản phẩm
            'description.required' => "Please enter a description for the product", // Vui lòng nhập mô tả cho sản phẩm
            //'img.required' => "Please add a representative image for the product", // Vui lòng thêm hình ảnh đại diện cho sản phẩm
        ];
    }
}
