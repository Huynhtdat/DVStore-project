<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;

class UpdateAdminRequest extends FormRequest
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
            'email' => 'required|string|email',
            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:24',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'phone_number' => 'required|min:11|max:12',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'apartment_number' => 'required|string|min:1|max:100',
            'role_id' => 'required|integer|in:' . Role::ROLE['admin'] . ',' . Role::ROLE['staff'],
            'active' => 'required|integer|in:' . Role::STATUS[0]['value'] . ',' . Role::STATUS[1]['value'],
            'disable_reason' => 'nullable|string',
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

        ];
    }
}
