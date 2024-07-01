<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users,email,NULL,id,deleted_at,NULL'],
            'password' => [
                'required', 'string', 'min:8', 'max:24',
                'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/',
            ],
            'password_confirm' => 'required_with:password|same:password',
            'phone_number' => ['required', 'string', 'min:10', 'max:11'],
            'city' => 'required|string|max:50',
            'district' => 'required|string|max:50',
            'ward' => 'required|string|max:50',
            'apartment_number' => ['required', 'string', 'min:1', 'max:100'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('message.required', ['attribute' => 'họ và tên']),
            'name.max' => __('message.max', ['attribute' => 'họ và tên']),
            'name.min' => __('message.min', ['attribute' => 'họ và tên']),
            'phone_number.required' => __('message.required', ['attribute' => 'số điện thoại']),
            'phone_number.min' => __('message.min', ['attribute' => 'số điện thoại']),
            'phone_number.max' => __('message.min_max_length', ['attribute' => 'số điện thoại']),
            'city.required' => __('message.required', ['attribute' => 'tỉnh, thành phố']),
            'district.required' => __('message.required', ['attribute' => 'quận, huyện']),
            'ward.required' => __('message.required', ['attribute' => 'phường, xã']),
            'apartment_number.required' => __('message.required', ['attribute' => 'số nhà']),
            'password.required' => __('message.required', ['attribute' => 'mật khẩu']),
            'password.min' => __('message.password_invalidator', ['attribute' => 'mật khẩu']),
            'password.max' => __('message.password_invalidator', ['attribute' => 'mật khẩu']),
            'password.regex' => __('message.password_invalidator', ['attribute' => 'mật khẩu']),
            'email.unique' => __('message.unique', ['attribute' => 'email']),
            'email.email' => __('message.email'),
            'password_confirm.same' => __('validation.same', ['attribute' => 'mật khẩu']),
            'email.max' => 'Email không được quá 30 ký tự',
        ];
    }
}
