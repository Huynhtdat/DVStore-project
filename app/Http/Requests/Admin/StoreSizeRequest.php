<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSizeRequest extends FormRequest
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
            'name.required' => "Vui lòng nhập tên size",
            'name.max' => "Tên size có tối đa 100 ký tự",
            'name.min' => "Tên size có tối thiểu 1 ký tự",
        ];
    }
}