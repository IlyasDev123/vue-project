<?php

namespace App\Http\Requests\User;

use App\Utlities\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'email|unique:users,email,'.Auth::id(),
            'password' => 'nullable|min:8|max:16|string|confirmed',
            'company_name' => 'required_if:type, ==,' . Constants::USER_TYPE_COMPANY . '|string',
            'phone_no' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.email' => 'Please provide a valid email.',
            'email.unique' => 'This email already exists.',
            'password.min' => 'Password must be 8 to 16 characters.',
            'password.max' => 'Password must be 8 to 16 characters.',
            'password.confirmed' => 'Password and confirm password does not match.',
            'phone_no' => 'nullable',
        ];
    }
}
