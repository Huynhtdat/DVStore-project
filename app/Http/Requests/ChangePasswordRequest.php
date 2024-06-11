<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'max:24',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'confirm_password' => 'required_with:new_password|same:new_password',
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
            'confirm_password.same' => __('validation.same', ['attribute' => 'mật khẩu']),
            'current_password.required' => __('validation.required', ['attribute' => 'mật khẩu hiện tại']),
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->matchCurrentPassword($this->input('current_password'))) {
                $validator->errors()->add('current_password', __('auth.password'));
            }
        });
    }

    /**
     * Check current password.
     *
     * @param string $currentPassword
     * @return bool
     */
    private function matchCurrentPassword(string $currentPassword): bool
    {
        return Hash::check($currentPassword, Auth::user()->password);
    }
}
