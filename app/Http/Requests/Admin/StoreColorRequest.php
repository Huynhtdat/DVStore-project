<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
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


    public function messages()
    {
        return [
            'name.required' => "Please enter the color name", // Vui lòng nhập tên màu
            'name.max' => "The color name can have a maximum of 100 characters", // Tên màu có tối đa 100 ký tự
            'name.min' => "The color name must have at least 1 character", // Tên màu ít nhất có 1 ký tự

        ];
    }

}
