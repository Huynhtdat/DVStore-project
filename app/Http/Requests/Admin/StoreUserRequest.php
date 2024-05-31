<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:30',
            'email' => 'required|string|email|unique:users,email,NULL,id,deleted_at,"NULL"',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:24',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'phone_number' => 'required|min:10|max:11',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'apartment_number' => 'required|string|min:1|max:100',
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
        'name.required' => 'Vui lòng nhập họ và tên',
        'name.max' => 'Họ và tên không được dài quá 24 ký tự',
        'name.min' => 'Họ và tên phải có ít nhất 1 ký tự',
        'phone_number.required' => 'Vui lòng nhập số điện thoại',
        'phone_number.min' => 'Số điện thoại phải có ít nhất 10 ký tự',
        'phone_number.max' => 'Số điện thoại không được dài quá 10 ký tự',
        'city.required' => 'Vui lòng nhập tỉnh, thành phố',
        'district.required' => 'Vui lòng nhập quận, huyện',
        'ward.required' => 'Vui lòng nhập phường, xã',
        'apartment_number.required' => 'Vui lòng nhập số nhà',
        'password.required' => 'Vui lòng nhập mật khẩu',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        'password.max' => 'Mật khẩu không được dài quá 24 ký tự',
        'password.regex' => 'Mật khẩu bao gồm từ 8 - 24 ký tự, ít nhất một chữ cái in hoa, một chữ cái in thường, một số và một ký tự đặc biệt (%, #, @, _, \\, -)',
        'email.unique' => 'Email này đã được sử dụng',
        'email.email' => 'Địa chỉ email không hợp lệ',
    ];
}

}
