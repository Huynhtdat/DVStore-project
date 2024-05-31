<?php

namespace App\Http\Requests\Admin;

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
        $user = Auth::guard('admin')->user();
        return [
            'name' => 'required|string|min:1|max:30',
            'email' => 'required|string|email|unique:users,email,' . $user->id . ',id,deleted_at,"NULL"',
            'phone_number' => 'required|min:10|max:10',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'apartment_number' => 'required|string|min:1|max:100',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Vui lòng nhập họ và tên",
            'name.max' => "Họ và tên có tối đa 30 ký tự",
            'name.min' => "Họ và tên có tối thiểu 1 ký tự",
            'phone_number.required' => "Vui lòng nhập số điện thoại",
            'phone_number.min' => "Số điện thoại có tối thiểu 10 ký tự",
            'phone_number.max' => "Số điện thoại có tối đa 10 ký tự",
            'city.required' => "Vui lòng nhập tỉnh, thành phố",
            'district.required' => "Vui lòng nhập quận, huyện",
            'ward.required' => "Vui lòng nhập phường, xã",
            'apartment_number.required' => "Vui lòng nhập số nhà",
            'email.unique' => "Địa chỉ email này đã được sử dụng",
            'email.email' => "Địa chỉ emial này không hợp lệ",
        ];
    }
}
