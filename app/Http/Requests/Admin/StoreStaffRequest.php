<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
            'phone_number' => 'required|min:11|max:12',
            'city' => 'required|integer',
            'district' => 'required|integer',
            'ward' => 'required|integer',
            'apartment_number' => 'required|string|min:1|max:100',
            'role_id' => 'required|integer|in:' . Role::ROLE['admin'] . ',' . Role::ROLE['staff'],
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
            'name.required' => 'Please enter your full name', // Vui lòng nhập họ và tên
            'name.max' => 'The full name must not exceed 24 characters', // Họ và tên không được dài quá 24 ký tự
            'name.min' => 'The full name must have at least 1 character', // Họ và tên phải có ít nhất 1 ký tự
            'phone_number.required' => 'Please enter your phone number', // Vui lòng nhập số điện thoại
            'phone_number.min' => 'The phone number must have at least 9 characters', // Số điện thoại phải có ít nhất 9 ký tự
            'phone_number.max' => 'The phone number must not exceed 11 characters', // Số điện thoại không được dài quá 11 ký tự
            'city.required' => 'Please enter the city', // Vui lòng nhập tỉnh, thành phố
            'district.required' => 'Please enter the district', // Vui lòng nhập quận, huyện
            'ward.required' => 'Please enter the ward', // Vui lòng nhập phường, xã
            'apartment_number.required' => 'Please enter the apartment number', // Vui lòng nhập số nhà
            'password.required' => 'Please enter a password', // Vui lòng nhập mật khẩu
            'password.min' => 'The password must have at least 8 characters', // Mật khẩu phải có ít nhất 8 ký tự
            'password.max' => 'The password must not exceed 24 characters', // Mật khẩu không được dài quá 24 ký tự
            'password.regex' => 'The password must be 8-24 characters long, including at least one uppercase letter,
             one lowercase letter, one number, and one special character (%, #, @, _, \\, -)', // Mật khẩu bao gồm từ 8 - 24 ký tự, ít nhất một chữ cái in hoa, một chữ cái in thường, một số và một ký tự đặc biệt (%, #, @, _, \\, -)
            'email.unique' => 'This email is already in use', // Email này đã được sử dụng
            'email.email' => 'Invalid email address', // Địa chỉ email không hợp lệ

        ];
    }
}
