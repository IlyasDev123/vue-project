<?php

namespace App\Http\Requests\User;

use App\Utlities\Constants;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'id' => 'required|integer',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$this->request->get('id'),
            'type' => 'required|integer',
            'phone_no' => 'nullable',
            'company_name' => 'nullable|required_if:type, ==,' . Constants::USER_TYPE_COMPANY . '|string',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'User id is required.',
            'id.integer' => 'User id must be integer.',
            'first_name.required' => 'First name is required.',
            'first_name.max' => 'First name allowed length is 50 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.max' => 'Last name allowed length is 50 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email already exists.',
            'type.required' => 'User type is required.',
            'type.integer' => 'User type must be integer value.',
            'company_name.required_if' => 'Please provide company name.'
        ];
    }
}
