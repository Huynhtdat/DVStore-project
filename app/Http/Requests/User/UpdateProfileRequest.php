<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'name' => 'required|string|min:1|max:30',
            'email' => 'required|string|email|unique:users,email,' . $user->id . ',id,deleted_at,"NULL"',
            'phone_number' => 'required',
            'city' => 'required|string|max:50',
            'district' => 'required|string|max:50',
            'ward' => 'required|string|max:50',
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
            'name.required' => "Please enter your full name", // Vui lòng nhập họ và tên
            'name.max' => "The full name can have a maximum of 30 characters", // Họ và tên có tối đa 30 ký tự
            'name.min' => "The full name must have at least 1 character", // Họ và tên có tối thiểu 1 ký tự
            'phone_number.required' => "Please enter your phone number", // Vui lòng nhập số điện thoại
            'phone_number.min' => "The phone number must have at least 10 characters", // Số điện thoại có tối thiểu 10 ký tự
            'phone_number.max' => "The phone number can have a maximum of 10 characters", // Số điện thoại có tối đa 10 ký tự
            'city.required' => "Please enter the city", // Vui lòng nhập tỉnh, thành phố
            'district.required' => "Please enter the district", // Vui lòng nhập quận, huyện
            'ward.required' => "Please enter the ward", // Vui lòng nhập phường, xã
            'apartment_number.required' => "Please enter the apartment number", // Vui lòng nhập số nhà
            'email.unique' => "This email address has already been used", // Địa chỉ email này đã được sử dụng
            'email.email' => "This email address is invalid", // Địa chỉ email này không hợp lệ
        ];
    }
}
