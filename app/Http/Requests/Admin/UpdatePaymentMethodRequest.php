<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentMethodRequest extends FormRequest
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
            'status' => 'required',
            'img' => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Vui lòng nhập tên phương thức thanh toán",
            'status.required' => "Vui lòng chọn trang thái cho phương thức thanh toán này",
        ];
    }
}
